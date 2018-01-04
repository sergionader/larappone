<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Product;
use App\ProductVisit;
use App\Profile;
use App\Origin;
use App\Type;
use App\Subtype;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker;
use Artisan;
use Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class DbController extends Controller
{
    public function createRecords(Faker\Generator $faker, Request $request)
    {
        $log_prefix = 'DB_CR';
        $error_txt = 'Try first populating the auxiliary tables.';
        if (!User::find(1)) {
            return redirect($request->url)->with('info-danger', 'Table "Users" cannot be empty!  ' . $error_txt);
        }
        if (!Profile::first()) {
            return redirect($request->url)->with('info-danger', 'Table "Profiles" cannot be empty! ' . $error_txt);
        }
        if (!Origin::first()) {
            return redirect($request->url)->with('info-danger', 'Table "Origins" cannot be empty! ' . $error_txt);
        }
        if (!Product::first()) {
            return redirect($request->url)->with('info-danger', 'Table "Products" cannot be empty! ' . $error_txt);
        }
        if (!Type::first()) {
            return redirect($request->url)->with('info-danger', 'Table "Types" cannot be empty!. $error_txt' . $error_txt);
        }
        if (!Subtype::first()) {
            return redirect($request->url)->with('info-danger', 'Table "Subtypes" cannot be empty! ' . $error_txt);
        }

        // Log::info($log_prefix . ' zero sale field: ' . intval($request->input('zero_sales_only')));
        $zero_sales_only = intval($request->input('zero_sales_only'));
        $records = $request->input('records');
        $dt_start = date('Y-m-d', strtotime($request->input('dt_start')));
        $dt_end = date('Y-m-d', strtotime($request->input('dt_end')));
        // Log::info($log_prefix . 'start and end dates: ' . $dt_start . ' ' . $dt_end);
        // Log::info($log_prefix . 'Records: ' . $records);
        $prof_not_to_use = env('APP_PROFILE_ID');
        $prod_not_to_use = env('APP_PRODUCT_ID');
        $orig_not_to_use = env('APP_ORIGIN_ID');

        $product_distribution = [
            [1, 13, 10],
            [14, 15, 15],    // mj, mk
            [16, 16, 15],    // nys
            [17, 17, 15],    // oakley
            [18, 20, 5],
            [21, 21, 25],    // rayban
            [22, 24, 5],
            [26, 30, 10],    // suncloud
        ];
        $origins_distribution = [
            [1, 1, 7],   // AUS
            [2, 2, 20],  // BRA
            [3, 3, 3],   // CHI
            [4, 4, 12],  // ENG
            [5, 5, 3],  // Puerto Rico
            [6, 6, 8],  // CAN
            [7, 7, 3],   // IND
            [8, 8, 2],   // JAP
            [9, 9, 25],  // US
            [11, 23, 17] // others
        ];
        if (!$zero_sales_only) {
            // Log::info($log_prefix . ' NOT ZERO SALES ONLY');
            for ($record = 0; $record < $records ; $record++) {
                $maxProduct = rand(1, 5);
                $user_id = rand(1, 4);
                $profile_id = Profile::inRandomOrder()->first()->id;
                if ($profile_id == $prof_not_to_use) {
                    $profile_id = rand(1, ($prof_not_to_use - 1));
                }
                $origin_id = $this->biasedRandomizer($origins_distribution);
                if ($origin_id == $orig_not_to_use) {
                    $origin_id = rand(($origin_id + 1), 34);
                }
                // Log::info($log_prefix . ' NOT ZERO SALES ONLY - Origin = ' . $origin_id);
                $dt = $faker->dateTimeBetween($startDate = $dt_start, $endDate = $dt_end, $timezone = date_default_timezone_get());
                $dt_ymd = $this->dtToString($dt);
                $tm = $this->randomTime();
                $tm_unix = strtotime($tm);
                $visit = new Visit(
                    [
                        'unit' => 'UN',
                        'dt' => $dt,
                        'dt_unix' => $this->dtToUnix($dt),
                        'month_year' => $this->dtToMonthYear($dt),
                        'tm' => $tm,
                        'tm_unix' => $tm_unix,
                        'profile_id' => $profile_id,
                        'origin_id' => $origin_id,
                        'avg' => $faker->biasedNumberBetween($min = 60, $max = 100),
                        'min' => $faker->biasedNumberBetween($min = 60, $max = 100),
                        'max' => $faker->biasedNumberBetween($min = 60, $max = 100),
                        'prec' => ($faker->biasedNumberBetween($min = 1, $max = 100)) / 100,
                        'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                        // 'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                        'user_id' => $user_id
                        ]
                );
                if ($visit->save()) {
                    for ($product = 0; $product < $maxProduct ; $product++) {
                        $qtd = rand(1, 6);
                        $amount = rand(0, 500);
                        if ($qtd == 0) {
                            $amount = 0;
                        }
                        $product_id = $this->biasedRandomizer($product_distribution);
                        $visit->products()->attach([$product_id], ['qtd' => $qtd, 'amount' => $amount]);
                        Cache::flush();
                    }
                } else {
                    return redirect($request->url)->with('info-danger', 'There was a problem creating the records!');
                }
            }
        }
        // create some zero-sales
        $zero_sales = rand(($records * .15), $records * 5);
        if ($zero_sales_only) {
            $zero_sales = $records;
            // Log::info('zero_sales under 0: ' . $zero_sales);
        }
        for ($i = 0; $i < $zero_sales ; $i++) {
            $maxProduct = rand(1, 5);
            // $maxProduct = 1;
            $user_id = rand(1, 2);
            $profile_id = Profile::inRandomOrder()->first()->id;
            if ($profile_id == $prof_not_to_use) {
                $profile_id = rand(1, ($prof_not_to_use - 1));
            }
            $origin_id = $this->biasedRandomizer($origins_distribution);
            if ($origin_id == $orig_not_to_use) {
                $origin_id = rand(($origin_id + 1), 34);
            }
            // Log::info($log_prefix . ' ZERO SALES ONLY - Origin = ' . $origin_id);
            $tm = $this->randomTime();
            $tm_unix = strtotime($tm);
            $dt = $faker->dateTimeBetween($startDate = $dt_start, $endDate = $dt_end, $timezone = date_default_timezone_get());
            $dt_strotime = strtotime(json_encode($dt));
            $visit = new Visit(
                [
                'unit' => 'UN',
                'dt' => $dt,
                'dt_unix' => $this->dtToUnix($dt),
                'month_year' => $this->dtToMonthYear($dt),
                'tm' => $tm,
                'tm_unix' => $tm_unix,
                'profile_id' => $profile_id,
                'origin_id' => $origin_id,
                'avg' => $faker->biasedNumberBetween($min = 60, $max = 100),
                'min' => $faker->biasedNumberBetween($min = 60, $max = 100),
                'max' => $faker->biasedNumberBetween($min = 60, $max = 100),
                'prec' => ($faker->biasedNumberBetween($min = 1, $max = 100)) / 100,
                'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'user_id' => $user_id
                ]
            );
            if ($visit->save()) {
                for ($product = 0; $product < $maxProduct ; $product++) {
                    $qtd = 0;
                    $amount = 0;
                    $product_id = $this->biasedRandomizer($product_distribution);
                    $visit->products()->attach([$product_id], ['qtd' => $qtd, 'amount' => $amount]);
                    Cache::flush();
                }
            } else {
                return redirect($request->url)->with('info-danger', 'There was a problem creating the records!');
            }
        }
        return redirect($request->url)->with('info-success', 'Records created!');
    }

    public function dtToUnix($dt)
    {
        foreach ($dt as $key => $value) {
            if ($key == 'date') {
                return strtotime($value);
            }
        }
    }

    public function dtToString($dt)
    {
        foreach ($dt as $key => $value) {
            if ($key == 'date') {
                return ($value);
            }
        }
    }

    public function dtToMonthYear($dt)
    {
        foreach ($dt as $key => $value) {
            if ($key == 'date') {
                return (date('M', strtotime($value)) . date('Y', strtotime($value)));
            }
        }
    }

    public function orderTest()
    {
        $visits = Visit::orderBy('dt', 'desc')->orderBy('tm', 'desc')
        ->get();
        //    ->where('dt', '2017-10-30')
        return $visits;
    }

    public function test()
    {
        $visits = Visit::orderBy('id', 'desc')->with(['type', 'profile', 'user'])->take(10)->get();
        dump($visits);
        dump('***************************************');
        dump('***************************************');
        $test = Visit::orderBy('id', 'desc')
        ->with(['type' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['profile' => function ($query) {
            $query->select('id', 'name');
        }])
        ->with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }])
        ->take(2)->get();
        // ->get(['id', 'profile_id', 'origin_id', 'user_id',  'unit', 'dt', 'tm', 'avg', 'max', 'max', 'prec', 'comment']);
        dd($test);
        return $test;
    }

    /**
     * For testing the datable performance
     *
     * @return void
     */
    public function getUsers()
    {
        $users = User::orderBy('id')->get();
        return datatables()->of($users)->toJson();
    }

    public function randomTime()
    {
        $random_hour = rand(9, 18);
        $random_minute = rand(0, 59);
        $random_second = rand(0, 59);
        $random_time = date('G:i:s', mktime($random_hour, $random_minute, $random_second, 0, 0, 0));
        return $random_time;
    }

    public function biasedRandomizer($ranges)
    {
        $sel = rand(0, 99);
        do {
            $pick = array_shift($ranges);
            $sel -= $pick[2];
        } while ($pick && $sel >= 0);
        $random = rand($pick[0], $pick[1]);
        return $random;
    }

    public function migrateDB(Request $request)
    {
        $product_visits = ProductVisit::all();
        foreach ($product_visits as $product_visit) {
            $product_visit->delete(); // needed to update ES indices
        }

        $visits = Visit::all();
        foreach ($visits as $visit) {
            $visit->delete(); // needed to update ES indices
        }

        Artisan::call('migrate:refresh');
        Artisan::call('scout:flush');
        $sql_users = DB::insert(
            "INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
            (1, 'Admin', 'admin@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', 'iJZDmNmvR2bAmqVvcWSacJJzvJwZsgLLs8t1NXm6FLSOK7QS3cUByrJiqd0D', '2017-11-02 16:20:20', '2017-11-02 16:20:20'),
            (2, 'John', 'user1@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', NULL, '2017-11-02 16:20:52', '2017-11-02 16:20:52'),
            (3, 'Mary', 'user2@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', NULL, '2017-11-02 16:20:52', '2017-11-02 16:20:52'),
            (4, 'Peter', 'user3@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', NULL, '2017-11-02 16:20:52', '2017-11-02 16:20:52');"
        );
        Cache::flush();
        return redirect($request->url)->with('info-success', 'All data has been removed!');
    }

    public function populateDB(Request $request)
    {
        // populates the auxiliar tables
        $visits = Visit::all();
        foreach ($visits as $visit) {
            $visit->delete(); // needed to update ES indices
        }

        $product_visits = ProductVisit::all();
        foreach ($product_visits as $product_visit) {
            $product_visit->delete(); // needed to update ES indices
        }

        Artisan::call('migrate:refresh');
        $sql_origins = DB::insert(
            "INSERT INTO `origins` (`id`, `name`, `created_at`, `updated_at`) VALUES
                (1, 'Australia', '2017-11-27 09:30:00', NULL),
                (2, 'Brazil', '2017-11-27 09:30:00', NULL),
                (3, 'China', '2017-11-27 09:30:00', NULL),
                (4, 'England', '2017-11-27 09:30:00', NULL),
                (5, 'Canada', '2017-11-27 09:30:00', NULL),
                (6, 'Puerto Rico', '2017-11-27 09:30:00', NULL),
                (7, 'India', '2017-11-27 09:30:00', NULL),
                (8, 'Japan', '2017-11-27 09:30:00', NULL),
                (9, 'United States', '2017-11-27 09:30:00', NULL),
                (10, ' Please choose', '2017-11-27 09:30:00', NULL),
                (11, 'Argentina', '2017-11-27 09:30:00', NULL),
                (12, 'Bahamas', '2017-11-27 09:30:00', NULL),
                (13, 'Chile', '2017-11-27 09:30:00', NULL),
                (14, 'Costa Rica', '2017-11-27 09:30:00', NULL),
                (15, 'France', '2017-11-27 09:30:00', NULL),
                (16, 'Spain', '2017-11-27 09:30:00', NULL),
                (17, 'Germany', '2017-11-27 09:30:00', NULL),
                (18, 'Israel', '2017-11-27 09:30:00', NULL),
                (19, 'Italy', '2017-11-27 09:30:00', NULL),
                (20, 'Mexico', '2017-11-27 09:30:00', NULL),
                (21, 'Sweden', '2017-11-27 09:30:00', NULL),
                (22, 'Turkey', '2017-11-27 09:30:00', NULL),
                (23, 'United Arab Emirates', '2017-11-27 09:30:00', NULL),
                (24, 'Portugal', '2017-11-27 09:30:00', NULL),            
                (25, 'Denmark', '2017-11-27 09:30:00', NULL),
                (26, 'Egypt', '2017-11-27 09:30:00', NULL),
                (27, 'Haiti', '2017-11-27 09:30:00', NULL),
                (28, 'Iceland', '2017-11-27 09:30:00', NULL),
                (29, 'Netherlands', '2017-11-27 09:30:00', NULL),
                (30, 'Norway', '2017-11-27 09:30:00', NULL),
                (31, 'Peru', '2017-11-27 09:30:00', NULL),
                (32, 'Switzerland', '2017-11-27 09:30:00', NULL),
                (33, 'Venezuela', '2017-11-27 09:30:00', NULL),
                (34, 'Jamaica', '2017-11-27 09:30:00', NULL)
                ;"
            );
        $sql_products = DB::insert(
            "INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
                (1, 'Bolle', '2017-11-27 09:30:00', NULL),
                (2, 'Bulgari', '2017-11-27 09:30:00', NULL),
                (3, 'Carrera', '2017-11-27 09:30:00', NULL),
                (4, 'Case', '2017-11-27 09:30:00', NULL),
                (5, 'Cleaning Kit', '2017-11-27 09:30:00', NULL),
                (6, 'Coach', '2017-11-27 09:30:00', NULL),
                (7, 'Costa', '2017-11-27 09:30:00', NULL),
                (8, 'Croake', '2017-11-27 09:30:00', NULL),
                (9, 'Dior', '2017-11-27 09:30:00', NULL),
                (10, 'Emporio Armani', '2017-11-27 09:30:00', NULL),
                (11, 'Gucci', '2017-11-27 09:30:00', NULL),
                (12, 'Guess', '2017-11-27 09:30:00', NULL),
                (13, 'Jimmy Choo', '2017-11-27 09:30:00', NULL),
                (14, 'Maui Jim', '2017-11-27 09:30:00', NULL),
                (15, 'Michael Kors', '2017-11-27 09:30:00', NULL),
                (16, 'New York Shades', '2017-11-27 09:30:00', NULL),
                (17, 'Oakley', '2017-11-27 09:30:00', NULL),
                (18, 'Polaroid', '2017-11-27 09:30:00', NULL),
                (19, 'Prada', '2017-11-27 09:30:00', NULL),
                (20, 'Ralph Lauren', '2017-11-27 09:30:00', NULL),
                (21, 'Ray Ban', '2017-11-27 09:30:00', NULL),
                (22, 'Reading Glasses', '2017-11-27 09:30:00', NULL),
                (23, 'Revo', '2017-11-27 09:30:00', NULL),
                (24, 'Serengetti', '2017-11-27 09:30:00', NULL),
                (25, 'Suncloud', '2017-11-27 09:30:00', NULL),
                (26, 'Tifanny', '2017-11-27 09:30:00', NULL),
                (27, 'Tommy Bahamas', '2017-11-27 09:30:00', NULL),
                (28, 'Tori Burch', '2017-11-27 09:30:00', NULL),
                (29, 'Versace', '2017-11-27 09:30:00', NULL),
                (30, 'Vogue', '2017-11-27 09:30:00', NULL),
                (31, ' Please choose', '2017-11-27 09:30:00', NULL);"
            );
        $sql_subtypes = DB::insert(
            "INSERT INTO `subtypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
                (1, 'Middle Age', '2017-11-27 09:30:00', NULL),
                (2, 'All', '2017-11-27 09:30:00', NULL),
                (3, 'Senior', '2017-11-27 09:30:00', NULL),
                (4, 'Young', '2017-11-27 09:30:00', NULL),
                (5, 'N/A', '2017-11-27 09:30:00', NULL);"
            );
        $sql_types = DB::insert(
            "INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES
                (1, 'Couple', '2017-11-27 09:30:00', NULL),
                (2, 'Family', '2017-11-27 09:30:00', NULL),
                (3, 'Ladies', '2017-11-27 09:30:00', NULL),
                (4, 'Gentlemen', '2017-11-27 09:30:00', NULL),
                (5, 'N/A', '2017-11-27 09:30:00', NULL);"
            );
        $sql_profiles = DB::insert(
            "INSERT INTO `profiles` (`id`, `name`, `type_id`, `subtype_id`, `created_at`, `updated_at`) VALUES
                (1, 'Couple Middle Age', 1, 1, '2017-10-05 16:30:00', NULL),
                (2, 'Couple Young', 1, 4, '2017-10-05 16:31:00', NULL),
                (3, 'Couple Senior', 1, 3, '2017-10-05 16:32:00', NULL),
                (4, 'Family', 2, 2, '2017-10-05 16:33:00', NULL),
                (5, 'Gentleman Middle Age', 4, 1, '2017-10-05 16:34:00', NULL),
                (6, 'Gentleman Young', 4, 4, '2017-10-05 16:35:00', NULL),
                (7, 'Gentlemen Senior', 4, 3, '2017-10-05 16:36:00', NULL),
                (8, 'Lady Middle Age', 3, 1, '2017-10-05 16:37:00', NULL),
                (9, 'Lady Senior', 3, 3, '2017-10-05 16:38:00', NULL),
                (10, 'Lady Young', 3, 4, '2017-10-05 16:39:00', NULL),
                (11, ' Please choose', 5, 5, '2017-10-05 16:39:00', NULL);"
        );
        $sql_users = DB::insert(
            "INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
                (1, 'Admin', 'admin@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', 'iJZDmNmvR2bAmqVvcWSacJJzvJwZsgLLs8t1NXm6FLSOK7QS3cUByrJiqd0D', '2017-11-02 16:20:20', '2017-11-02 16:20:20'),
                (2, 'John', 'user1@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', NULL, '2017-11-02 16:20:52', '2017-11-02 16:20:52'),
                (3, 'Mary', 'user2@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', NULL, '2017-11-02 16:20:52', '2017-11-02 16:20:52'),
                (4, 'Peter', 'user3@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', NULL, '2017-11-02 16:20:52', '2017-11-02 16:20:52');"
            );
        // Set the sort order
        $models = [
            'Origin',
            'Product',
            'Profile',
            'Subtype',
            'Type',
            'User'
        ];
        foreach ($models as $this_model) {
            $this->sortOrder($this_model);
        }
        Cache::flush();
        return redirect($request->url)->with('info-success', 'Auxiliary data created.');
    }

    public function sortOrder($model_name)
    {
        $model_name = 'App\\' . $model_name;
        $model = $model_name::orderBy('name')->get();
        $len = $model_name::count();
        $i = 0;
        foreach ($model as $this_model) {
            $this_model->sort_order = $i;
            $this_model->save();
            $i++;
        }
    }

    public function cacheTest()
    {
        // Cache::put('idade', '50', 3);
        // Redis::set('idade', 151);
        // $value = Cache::get('idade');
        // return ($value);
    }

    public function listTables()
    {
        $tables = DB::select('SHOW TABLES'); // returns an array of stdObjects
        $result = [];
        foreach ($tables as $table) {
            dump(json_encode($table));
            $columns = DB::select('show columns from ' . $table->Tables_in_productvisit);
            foreach ($columns as $value) {
                // dump( "'" . $value->Field . "' => '" . $value->Type . "|" . ( $value->Null == "NO" ? 'required' : '' ) ."', <br/>") ;
                array_push(
                        $result,
                        [
                        'name' => $value->Field,
                        'type' => $value->Type
                    ]
                );
            }
            dump(($result));
            $result = [];
        };
    }

    //* List the relationships - to be ued in the future
    // https://stackoverflow.com/questions/21615656/get-array-of-eloquent-models-relations

    // Expected output

    // [
    //     { key: "Products",
    //       items: [ { name: "ProductID", iskey: true, figure: "Decision", color: yellowgrad },
    //                { name: "ProductName", iskey: false, figure: "Cube1", color: bluegrad },
    //                { name: "SupplierID", iskey: false, figure: "Decision", color: "purple" },
    //                { name: "CategoryID", iskey: false, figure: "Decision", color: "purple" } ] },
    //     { key: "Suppliers",
    //       items: [ { name: "SupplierID", iskey: true, figure: "Decision", color: yellowgrad },
    //                { name: "CompanyName", iskey: false, figure: "Cube1", color: bluegrad },
    //                { name: "ContactName", iskey: false, figure: "Cube1", color: bluegrad },
    //                { name: "Address", iskey: false, figure: "Cube1", color: bluegrad } ] },

    //   ];
    //   var linkDataArray = [
    //     { from: "Products", to: "Suppliers", text: "0..N", toText: "1" },
    //     { from: "Products", to: "Categories", text: "0..N", toText: "1" },
    //     { from: "Order Details", to: "Products", text: "0..N", toText: "1" }
    //   ];
    // }

    public function visits_2018()
    {
        $visits = Visit::where('dt', '=', '2017-12-01')
        ->pluck('id');
        return (json_encode($visits));
    }

    public function getTypes()
    {
        $columns = [
            'types.id as type_id,', 'types.name as type'
        ];
        $types = DB::table('types')->orderby('name', 'asc')
        ->get();
        // ->get( ['types.id as type_id,'
        // ,'types.name as type']);
        // dump($types);
        // foreach ($types as $type) {
        //     dump($type->id);
        // }
        // $visits = Visit::orderBy('id', 'desc')->with(['type','origin', 'products','user'])->get()

        $types1 = DB::select('
        SELECT  
            types.id as type_id,
            types.name as type
            FROM types
            ORDER by types.name
        ');
        dump($types1);
        foreach ($types1 as $type1) {
            dump($type1->type_id);
        }
    }
};
