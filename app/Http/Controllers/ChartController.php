<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subtype;
use App\Type;
use App\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Log;
use Cache;

class ChartController extends Controller
{
    public function chartLoader()
    {
        $chart_list = [
            'Number of Visits vs. Sales - Area',
            'USD Sales by Regions - Map',
            'USD Monthly Sales by Type (only from Jan to Dec) - Stacked',
            'USD Sales %  by Type and Subtype - Donut'
        ];
        return view('visits.charts.chartloader', [
            'chart_list' => $chart_list
            ]);
    }

    public function PostAllTypesSubtypes(Request $request)
    { // DONUT
        $result = [];
        $type = [];
        $subtype = [];
        $dt_start = date('Y-m-d', strtotime($request->input('dt_start')));
        $dt_end = date('Y-m-d', strtotime($request->input('dt_end')));
        $sql_type_sum = DB::select("
            SELECT sum(product_visit.amount) as type_total
            FROM
            product_visit, visits, profiles, types
            WHERE visits.id = product_visit.visit_id
            AND profiles.id = visits.profile_id
            AND types.id = profiles.type_id
            AND (visits.dt between '$dt_start' and '$dt_end')  
        ");
        $sql_type = DB::select("
        SELECT  
            types.id as type_id,
            types.name as type,
            sum(product_visit.amount) AS y
        FROM 
            visits, product_visit, profiles, types
        WHERE 
            visits.id = product_visit.visit_id
            AND profiles.id = visits.profile_id
            AND types.id = profiles.type_id
            AND product_visit.amount>0
            AND (visits.dt between '$dt_start' and '$dt_end')  
        GROUP BY types.id, types.name
        ORDER BY types.name
        ");
        $sql_type_subtype = DB::select("
            SELECT  
                types.id as type_id,
                subtypes.id as subtype_id,
                types.name as type, 
                subtypes.name as subtype,
                sum(product_visit.amount) AS y
            FROM 
                visits, product_visit, profiles, types, subtypes
            WHERE 
                visits.id = product_visit.visit_id
                AND profiles.id = visits.profile_id
                AND types.id = profiles.type_id
                AND subtypes.id = profiles.subtype_id
                AND product_visit.amount>0
                AND (visits.dt between '$dt_start' and '$dt_end')  
            GROUP BY types.id, subtypes.id, types.name, subtypes.name
            ORDER BY type, subtype
        ");
        $type_total = $sql_type_sum[0]->type_total;
        foreach ($sql_type as $sql_type_item) {
            $y_us = ($sql_type_item->y);
            $y = ($y_us / $type_total);
            $type_id = $sql_type_item->type_id;
            $type_name = $sql_type_item->type;
            $type = array_prepend(
                $type,
            [
                'id' => $type_id,
                'name' => $type_name,
                'y' => $y,
                // 'color' => $type_id,
            ]
            );
            foreach ($sql_type_subtype as $sql_type_subtype_item) {
                if ($sql_type_item->type_id == $sql_type_subtype_item->type_id) {
                    $subtype = array_prepend($subtype, [
                        'type_id' => $sql_type_subtype_item->type_id,
                        'type' => $sql_type_subtype_item->type,
                        'subtype_id' => $sql_type_subtype_item->subtype_id,
                        'name' => $sql_type_subtype_item->subtype,
                        'y' => $sql_type_subtype_item->y / $type_total,
                        'y_us' => $sql_type_subtype_item->y,
                        'color' => (int)($type_id)
                    ]);
                }
            }
        }
        $type = array_sort_recursive($type);
        $subtype = array_sort_recursive($subtype);
        $result = [
            'type' => $type,
            'subtype' => $subtype,
        ];
        return $result;
    }

    public function PostSubTypeProductByType(Request $request)
    {
        $type_id = ($request->input('type_id'));
        $result = [];
        $subtype = [];
        $subtype_prod = [];
        $dt_start = date('Y-m-d', strtotime($request->input('dt_start')));
        $dt_end = date('Y-m-d', strtotime($request->input('dt_end')));
        $sql_product_sum = DB::select("
            SELECT sum(amount) as product_total,
            types.name as name
            FROM
            product_visit, visits, profiles, types
            WHERE visits.id = product_visit.visit_id
            AND profiles.id = visits.profile_id
            AND types.id = profiles.type_id
            AND types.id = $type_id
            AND (visits.dt between '$dt_start' and '$dt_end')  
            GROUP BY types.name
        ");
        $sql_type_subtype_sum = DB::select("
            SELECT  
            types.id as type_id,
            types.name as type, 
            sum(product_visit.amount) AS y_total
            FROM visits, product_visit, profiles, types
            WHERE visits.id = product_visit.visit_id
            AND profiles.id = visits.profile_id
            AND types.id = profiles.type_id
            AND types.id =  $type_id
            AND product_visit.amount>0   
            AND (visits.dt between '$dt_start' and '$dt_end')           
            GROUP BY   types.id, types.name
        ");
        $sql_type_subtype = DB::select("
            SELECT  
            types.id as type_id,
            subtypes.id as subtype_id,
            types.name as type, 
            subtypes.name as subtype,
            sum(product_visit.amount) AS y
            FROM visits, product_visit, profiles, types, subtypes
            WHERE visits.id = product_visit.visit_id
            AND profiles.id = visits.profile_id
            AND types.id = profiles.type_id
            AND subtypes.id = profiles.subtype_id
            AND types.id = $type_id
            AND product_visit.amount>0
            AND (visits.dt between '$dt_start' and '$dt_end')  
            GROUP BY   types.id, subtypes.id, types.name, subtypes.name
            ORDER BY type, subtype
        ");
        $sql_type_subtype_prod = DB::select("
            SELECT  
                types.id as type_id,   
                subtypes.id as subtype_id,  
                types.name as type, 
                subtypes.name as subtype,
                products.id as product_id,
                products.name as product,
                sum(product_visit.amount) AS y
            FROM 
                visits, product_visit, products, profiles
                ,types, subtypes
            WHERE 
                visits.id = product_visit.visit_id
                AND products.id = product_visit.product_id
                AND profiles.id = visits.profile_id
                AND types.id = profiles.type_id
                AND subtypes.id = profiles.subtype_id
                AND types.id = $type_id
                AND product_visit.amount>0
                AND (visits.dt between '$dt_start' and '$dt_end')  
            GROUP BY types.id, subtypes.id, types.name, subtypes.name, products.id, products.name
            ORDER BY types.id, subtypes.id, products.name
            ");
        $y_total = $sql_type_subtype_sum[0]->y_total;
        $product_total = $sql_product_sum[0]->product_total;
        $chart_title = $sql_product_sum[0]->name;
        foreach ($sql_type_subtype as $sql_type_subtype_item) {
            $y = ($sql_type_subtype_item->y / $y_total);
            $y_us = ($sql_type_subtype_item->y);
            $subtype_id = $sql_type_subtype_item->subtype_id;
            $subtype_name = $sql_type_subtype_item->subtype;
            $subtype = array_prepend(
                $subtype,
            [
                'id' => $subtype_id,
                'name' => $subtype_name,
                'y' => $y,
            ]
            );
            foreach ($sql_type_subtype_prod as $sql_type_subtype_prod_item) {
                if ($sql_type_subtype_item->subtype_id == $sql_type_subtype_prod_item->subtype_id) {
                    $subtype_prod = array_prepend($subtype_prod, [
                        'subtype_id' => $sql_type_subtype_prod_item->subtype_id,
                        'id' => $sql_type_subtype_prod_item->product_id,
                        'type' => $sql_type_subtype_prod_item->subtype,
                        'name' => $sql_type_subtype_prod_item->product,
                        'y' => $sql_type_subtype_prod_item->y / $product_total,
                        'y_us' => $sql_type_subtype_prod_item->y,
                        'color' => (int)($subtype_id)
                    ]);
                }
            }
        }
        $subtype = array_sort_recursive($subtype);
        usort($subtype_prod, function ($a, $b) { return strnatcmp($a['subtype_id'], $b['subtype_id']); });
        $result = [
            'subtype' => $subtype,
            'subtype_prod' => $subtype_prod,
            'chart' => ['title' => $chart_title]
        ];
        return $result;
    }

    public function PostSalesByMonth(Request $request)
    {
        $months = [];
        $y = [];
        $result = [];
        $dt_start = date('Y-m-d', strtotime($request->input('dt_start')));
        $dt_end = date('Y-m-d', strtotime($request->input('dt_end')));
        $sql_sales_by_month = DB::select("
        SELECT
            DATE_FORMAT(visits.dt, '%m') AS month_idx,
            DATE_FORMAT(visits.dt, '%b') AS month,
            DATE_FORMAT(visits.dt, '%Y') AS year,
            ROUND(sum(product_visit.amount)) AS y
        FROM  visits, product_visit
        WHERE 
            visits.id = product_visit.visit_id
            AND product_visit.amount>0
            AND (visits.dt between '$dt_start' and '$dt_end')
        GROUP BY month_idx, month, year
        ORDER BY year desc, month_idx desc ;
        ");
        // dd($sql_sales_by_month);
        foreach ($sql_sales_by_month as $sql_sales_by_month_item) {
            $chart_date = $sql_sales_by_month_item->month . '-' . $sql_sales_by_month_item->year;
            $months = array_prepend($months, [
                $chart_date
            ]);
            $y = array_prepend($y, [
                (int)$sql_sales_by_month_item->y
            ]);
        };
        $months = array_flatten($months);

        $y = array_flatten($y);

        $result = [
            'categories' => $months,
            'data' => $y
            ];

        return json_encode($result);
    }

    public function PostSalesByMonthByType(Request $request)
    {
        // column stacked
        $months = [];
        $m = [1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 12];
        $types = [];
        $y = [];
        $y_final = [];
        $data = [];
        $result = [];
        $dt_start = date('Y-m-d', strtotime($request->input('dt_start')));
        $dt_end = date('Y-m-d', strtotime($request->input('dt_end')));

        // May not be used - REVIEW
        $month_start = intval(date('m', strtotime($dt_start)));
        $month_end = intval(date('m', strtotime($dt_end)));
        // /May not be used - REVIEW

        $sql_types = Cache::remember('types', (15 * 24 * 60), function () {
            return  DB::table('types')
                ->orderby('types.name', 'asc')
                ->select('types.id as type_id', 'types.name as type')
                ->where('types.id', '!=', 5)
                ->get();
        });

        // $sql_types = DB::table('types')
        //         ->orderby('types.name', 'asc')
        //         ->select('types.id as type_id', 'types.name as type')
        //         ->where('types.id', '!=', 5)
        //         ->get();
        // DB::enableQueryLog();
        // Log::info('sql_types: ' . json_encode(DB::getQueryLog()));

        // better not cache
        $sql_sales_by_month = DB::table('visits')
            ->join('product_visit', 'visit_id', '=', 'visits.id')
            ->where('product_visit.amount', '>', 0)
            ->whereBetween('visits.dt', [$dt_start, $dt_end])
            ->groupBy('year', 'month_idx', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month_idx', 'desc')
            ->selectRaw('DATE_FORMAT(visits.dt, \'%m\') AS month_idx')
            ->selectRaw('DATE_FORMAT(visits.dt, \'%b\') AS month')
            ->selectRaw('DATE_FORMAT(visits.dt, \'%Y\') AS year')
            ->selectRaw('ROUND(sum(product_visit.amount)) AS y')
            ->get();
        // DB::enableQueryLog();
        // Log::info('sql_sales_by_month: ' . json_encode(DB::getQueryLog()));

        // better not cache
        $sql_sales_by_month_type = DB::table('visits')
            ->join('product_visit', 'visit_id', '=', 'visits.id')
            ->join('profiles', 'profiles.id', '=', 'visits.profile_id')
            ->join('types', 'types.id', '=', 'profiles.type_id')
            ->where('product_visit.amount', '>', 0)
            ->where('types.id', '!=', 5)
            ->whereBetween('visits.dt', [$dt_start, $dt_end])
            ->groupBy('year', 'month_idx', 'month', 'types.name', 'types.id')
            ->orderBy('year', 'desc')
            ->orderBy('types.name', 'asc')
            ->orderBy('month_idx', 'asc')
            ->selectRaw('types.id as type_id')
            ->selectRaw('types.name as type')
            ->selectRaw('DATE_FORMAT(visits.dt, \'%m\') AS month_idx')
            ->selectRaw('DATE_FORMAT(visits.dt, \'%b\') AS month')
            ->selectRaw('DATE_FORMAT(visits.dt, \'%Y\') AS year')
            ->selectRaw('ROUND(sum(product_visit.amount)) AS y')
            ->get()->toArray();

        // Log::info('sql_sales_by_month_type: ' . json_encode(DB::getQueryLog()));

        $keys = array_keys(array_combine(array_keys($sql_sales_by_month_type), array_column($sql_sales_by_month_type, 'type')), 'Couple');
        foreach ($sql_sales_by_month as $sql_sales_by_month_item) {
            $chart_date = $sql_sales_by_month_item->month . '-' . $sql_sales_by_month_item->year;
            $months = array_prepend($months, [
                $chart_date
            ]);
        }
        $months = array_flatten($months);
        $months_len = count($months);
        ;
        $last_month = 0;
        $last_type = 0;

        //===========
        foreach ($sql_types as $sql_types_item) {
            $this_type = $sql_types_item->type_id;
            foreach ($sql_sales_by_month_type as $sql_sales_by_month_type_item) {
                if ($sql_types_item->type_id == $sql_sales_by_month_type_item->type_id) {
                    $this_month = intval($sql_sales_by_month_type_item->month_idx);
                    $diff_month = $this_month - $last_month;

                    // checks if the first month is missing
                    // if ($last_type != $this_type && $diff_month != (1 - $last_month)) {
                    //     // then adds 0 to it.
                    //     array_push($y, [
                    //         0
                    //     ]);
                    // }
                    // checks if one or more months were skipped in a row
                    // if ($diff_month > 1) {
                    //     // then adds 0 to the position of the skipped month or months.
                    //     for ($d = 0; $d < ($diff_month - 1); $d++) {
                    //         array_push($y, [
                    //             0
                    //         ]);
                    //     }
                    // }

                    array_push($y, [
                        (double)$sql_sales_by_month_type_item->y
                    ]);
                    $last_type = $sql_types_item->type_id;
                }
                $last_month = intval($sql_sales_by_month_type_item->month_idx);
            }
            $y = array_flatten($y);
            array_push($types, [
                        'id' => $sql_types_item->type_id,
                        'name' => $sql_types_item->type,
                        'data' => $y
                        ]);
            $y = [];
        }
        $result = array_prepend($result, [
            'data' => $types,
            'months' => $months
        ]);
        return json_encode($result);
    }

    // Dashboard
    public function PostConversionRatebyDates(Request $request)
    {
        // Chart Controller: CC
        //  This Method: PCRBD
        $logPrefix = 'CC_PCRBD | ';
        $dt_start = date('Y-m-d', strtotime($request->input('dt_start')));
        $dt_end = date('Y-m-d', strtotime($request->input('dt_end')));
        $startMonth = date('m', strtotime($dt_start));
        $dt_first_of_month = Carbon::create()->startOfMonth();
        $dt_last_of_month = Carbon::create()->lastOfMonth();
        /* Today */

        $sql_visits_no_sales = Cache::remember('sql_visits_no_sales', (60), function () use ($dt_start, $dt_end) {
            return  DB::table('visits')
            ->join('product_visit', 'visit_id', '=', 'visits.id')
            ->where('product_visit.amount', '=', 0)
            ->whereBetween('visits.dt', [$dt_start, $dt_end])
            ->selectRaw('count(visits.id) as number_of')
            ->get();
        });

        // $sql_visits_no_sales = DB::select("
        //     SELECT count(visits.id) as number_of
        //     FROM visits, product_visit
        //     WHERE
        //         visits.id = product_visit.visit_id
        //         AND (visits.dt between '$dt_start' and '$dt_end')
        //         AND product_visit.amount=0;
        // ");
        $sql_visits_sales = Cache::remember('sql_visits_sales', (60), function () use ($dt_start, $dt_end) {
            return  DB::table('visits')
            ->join('product_visit', 'visit_id', '=', 'visits.id')
            ->where('product_visit.amount', '>', 0)
            ->whereBetween('visits.dt', [$dt_start, $dt_end])
            ->selectRaw('count(visits.id) as number_of')
            ->get();
        });

        /* This month */
        /* not chached - changes all the time */
        $sql_visits_no_sales_this_month = DB::table('visits')
            ->join('product_visit', 'visit_id', '=', 'visits.id')
            ->where('product_visit.amount', '=', 0)
            ->whereBetween('visits.dt', [$dt_first_of_month, $dt_last_of_month])
            ->selectRaw('count(visits.id) as number_of')
            ->get();

        $sql_visits_sales_this_month = DB::table('visits')
            ->join('product_visit', 'visit_id', '=', 'visits.id')
            ->where('product_visit.amount', '>', 0)
            ->whereBetween('visits.dt', [$dt_first_of_month, $dt_last_of_month])
            ->selectRaw('count(visits.id) as number_of')
            ->get();

        /* Last month */
        /* cached as it should not change at all */
        $dt_first_day_last_month = new Carbon('first day of last month');
        $dt_last_day_last_month = new Carbon('last day of last month');

        $sql_visits_no_sales_last_month = Cache::remember(
            'sql_visits_no_sales_last_month',
            (60),
            function () use ($dt_first_day_last_month, $dt_last_day_last_month) {
                return  DB::table('visits')
                ->join('product_visit', 'visit_id', '=', 'visits.id')
                ->where('product_visit.amount', '=', 0)
                ->whereBetween('visits.dt', [$dt_first_day_last_month, $dt_last_day_last_month])
                ->selectRaw('count(visits.id) as number_of')
                ->get();
            }
        );

        $sql_visits_sales_last_month = Cache::remember(
            'sql_visits_sales_last_month',
            (60),
            function () use ($dt_first_day_last_month, $dt_last_day_last_month) {
                return  DB::table('visits')
                ->join('product_visit', 'visit_id', '=', 'visits.id')
                ->where('product_visit.amount', '>', 0)
                ->whereBetween('visits.dt', [$dt_first_day_last_month, $dt_last_day_last_month])
                ->selectRaw('count(visits.id) as number_of')
                ->get();
            }
        );
        /* This Month Last Year */
        /* cached as it should not change at all */
        $dt_first_day_last_month_last_year = $dt_first_day_last_month->subYears(1);
        $dt_last_day_last_month_last_year = $dt_last_day_last_month->subYears(1);

        $sql_visits_no_sales_this_month_last_year = Cache::remember(
            'sql_visits_no_sales_this_month_last_year',
            (60),
            function () use ($dt_first_day_last_month_last_year, $dt_last_day_last_month_last_year) {
                return  DB::table('visits')
                ->join('product_visit', 'visit_id', '=', 'visits.id')
                ->where('product_visit.amount', '=', 0)
                ->whereBetween('visits.dt', [$dt_first_day_last_month_last_year, $dt_last_day_last_month_last_year])
                ->selectRaw('count(visits.id) as number_of')
                ->get();
            }
        );

        $sql_visits_sales_this_month_last_year = Cache::remember(
            'sql_visits_sales_this_month_last_year',
            (60),
            function () use ($dt_first_day_last_month_last_year, $dt_last_day_last_month_last_year) {
                return  DB::table('visits')
                ->join('product_visit', 'visit_id', '=', 'visits.id')
                ->where('product_visit.amount', '>', 0)
                ->whereBetween('visits.dt', [$dt_first_day_last_month_last_year, $dt_last_day_last_month_last_year])
                ->selectRaw('count(visits.id) as number_of')
                ->get();
            }
        );

        // Today
        $visits_total = $sql_visits_sales[0]->number_of + $sql_visits_no_sales[0]->number_of;
        if (!$visits_total) {
            $visits_total = 1;
        }
        $rate = round(($sql_visits_sales[0]->number_of / $visits_total) * 100, 2);
        // This Month
        $visits_total_this_month = $sql_visits_sales_this_month[0]->number_of + $sql_visits_no_sales_this_month[0]->number_of;
        if (!$visits_total_this_month) {
            $visits_total_this_month = 1;
        }
        $rate_this_month = round(($sql_visits_sales_this_month[0]->number_of / $visits_total_this_month) * 100, 2);

        // Last Month
        $visits_total_last_month = $sql_visits_sales_last_month[0]->number_of + $sql_visits_no_sales_last_month[0]->number_of;
        if (!$visits_total_last_month) {
            $visits_total_last_month = 1;
        }

        $rate_last_month = round(($sql_visits_sales_last_month[0]->number_of / $visits_total_last_month) * 100, 2);

        // Last Year
        $visits_total_this_month_last_year = $sql_visits_sales_this_month_last_year[0]->number_of + $sql_visits_no_sales_this_month_last_year[0]->number_of;
        if (!$visits_total_this_month_last_year) {
            $visits_total_this_month_last_year = 1;
        }
        $rate_this_month_last_year = round(($sql_visits_sales_this_month_last_year[0]->number_of / $visits_total_this_month_last_year) * 100, 2);

        $result = [
            'dt_start' => $dt_start,
            'dt_end' => $dt_end,
            'details' => [
                'visits' => $visits_total,
                'sales' => $sql_visits_sales[0]->number_of,
                'rate' => $rate,
                'visits_this_month' => $visits_total_this_month,
                'sales_this_month ' => $sql_visits_sales_this_month[0]->number_of,
                'rate_this_month' => $rate_this_month,
                'visits_last_monht' => $visits_total_last_month,
                'sales_last_month' => $sql_visits_sales_last_month[0]->number_of,
                'rate_last_month' => $rate_last_month,
                'visits_this_month_last_year' => $visits_total_this_month_last_year,
                'sales_this_month_last_year' => $sql_visits_sales_this_month_last_year[0]->number_of,
                'rate_this_month_last_year' => $rate_this_month_last_year,
                ]
        ];
        return json_encode($result);
    }

    public function PostConversationRateComparasionByDate(Request $request)
    {
        //AREA
        $log_prefix = 'CC_ AREA | ';
        $dt_start = date('Y-m-d', strtotime($request->input('dt_start')));
        $dt_end = date('Y-m-d', strtotime($request->input('dt_end')));
        Log::info($log_prefix . ' start and end dates: ' . $dt_start . ' ' . $dt_end);
        $visits = [];
        $sales = [];
        $dates = [];
        $result = [];
        $days_of_month = [];
        $thisDay;
        $sql = "SELECT  vw_visits.dt, vw_visits.number_of_visits AS visits,
        vw_sales.number_of_sales AS sales,
        (vw_visits.number_of_visits + vw_sales.number_of_sales) AS total,
        vw_sales.number_of_sales/(vw_visits.number_of_visits + vw_sales.number_of_sales) AS rate
    FROM vw_visits, vw_sales
    WHERE vw_visits.dt = vw_sales.dt
    AND (vw_visits.dt between '$dt_start' and '$dt_end')";

        $sql_converstion_rates = DB::select("
            SELECT  vw_visits.dt, vw_visits.number_of_visits AS visits,
                vw_sales.number_of_sales AS sales,
                (vw_visits.number_of_visits + vw_sales.number_of_sales) AS total,
                vw_sales.number_of_sales/(vw_visits.number_of_visits + vw_sales.number_of_sales) AS rate
            FROM vw_visits, vw_sales
            WHERE vw_visits.dt = vw_sales.dt
            AND (vw_visits.dt between '$dt_start' and '$dt_end')
        ");
        Log::info($log_prefix . 'sql: ' . json_encode($sql));
        if (!$sql_converstion_rates) {
            return;
        }
        foreach ($sql_converstion_rates as $day) {
            array_push($dates, [
                date('m-d-Y', strtotime($day->dt))
            ]);
            $thisDay = date('d', strtotime($day->dt));
            // For HighCharts, send the numbers as individual arrays.
            // Note the []
            array_push($days_of_month, [
                $thisDay
            ]);

            array_push($visits, [
                $day->visits
            ]);
            array_push($sales, [
                $day->sales
            ]);
        };

        $dates = array_flatten($dates);
        $visits = array_flatten($visits);
        $sales = array_flatten($sales);
        array_push($result, [
            'dates' => $dates,
            'days' => $days_of_month,
            'visits' => $visits,
            'sales' => $sales,
            'max_visits' => max(array_column($sql_converstion_rates, 'visits'))
        ]);
        Log::info($log_prefix . 'result: ' . json_encode($result));
        return json_encode($result);
    }

    public function PostSalesByOriginByDate(Request $request)
    { // map
        $dt_start = date('Y-m-d', strtotime($request->input('dt_start')));
        $dt_end = date('Y-m-d', strtotime($request->input('dt_end')));
        $array_title = [['Country', 'Sales']];
        $array_body = '';
        $result = [];
        $sql_sales_by_origin_by_date = DB::select("
        SELECT  
            origins.name as country, 
            sum(product_visit.amount) AS sales
        FROM visits, product_visit, origins
        WHERE       visits.id = product_visit.visit_id
            AND origins.id = visits.origin_id  
            AND product_visit.amount>0 
            AND (visits.dt between '$dt_start' and '$dt_end')                    
        GROUP BY   origins.name
        ");
        foreach ($sql_sales_by_origin_by_date as $item) {
            array_push(
                $array_title,
                [$item->country,
                (double)$item->sales]
            );
        }
        // $array_body = array_flatten($array_body);
        $result = [
            $array_title,
            $array_body,
        ];
        return $array_title;
    }
}
