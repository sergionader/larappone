<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Product;
use App\Profile;
use App\Origin;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Gate;
use Carbon\Carbon;
use Log;

class ProductVisitWeb extends Controller
{
    /**
     * get the date for the appHome method and handles it to the datatables scritp.
     *
     * @return \Illuminate\Http\Response
     */
    public function appHome()
    {
        return view('visits.app.indexdatatables');
    }

    /**
     * Show list of the visits, edit links and the new button.
     * Elasticsearch search
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sort_column = Input::get('sort_column');
        $sort_az_za = Input::get('sort_az_za');

        if (!$sort_column) {
            $sort_column = 'id';
        }
        if (!$sort_az_za) {
            $sort_az_za = 'asc';
        }
        $columns = [
                'visits.id as id', 'visits.tm as tm',
                'visits.dt as dt', 'profiles.name as profile_name',
                'origins.name as origin_name', 'users.id as user_id',
                'users.name as user_name', 'comment',
            ];
        $aliases = [
                [
                    'name' => 'ID',
                    'field' => 'id',
                    'sortable' => 1
                ],
                [
                    'name' => 'Date',
                    'field' => 'dt_unix',
                    'sortable' => 1
                ],
                [
                    'name' => 'Time',
                    'field' => 'tm_unix',
                    'sortable' => 1
                    ],
                [
                    'name' => 'Profile',
                    'field' => 'profile.sort_order',
                    'sortable' => 1
                ],
                [
                    'name' => 'Origin',
                    'field' => 'origin.sort_order',
                    'sortable' => 1
                ],
                [
                    'name' => 'User',
                    'field' => 'user_name',
                    'field' => 'user.sort_order',
                    'sortable' => 1
                ],
                [
                    'name' => 'Comment',
                    'field' => 'comment',
                    'sortable' => 0
                ],
        ];
        $query = Input::get('query');
        if (strpos($sort_column, '.') && !$query) {
            // handles the name using for sorting
            $left_sort = strstr($sort_column, '.', true);
            $right_sort = strstr($sort_column, '.');
            $sort_column = $left_sort . 's' . $right_sort;
        }
        $search = Input::get('query');
        $fuziness = env('APP_SEARCH_FUZINESS');
        $fuzzy = Input::get('fuzzy');
        if (!$fuzzy) {
            $fuziness = 0;
        }
        $search = preg_replace('/[^a-zA-Z0-9]/', '', $search); //only allow letters and numbers:
        Log::info('Search term: | ' . $search);
        if ($search) {
            $visits = Visit::
            search($search, function ($engine, $query, $options) use ($search, $fuziness) {
                $options['body']['query'] =
                    [
                        'multi_match' => [
                            'query' => "\"$search\"",
                            'fields' => [
                                'month_year',
                                'profile.name',
                                'origin.name',
                                'user.name',
                                'comment',
                                'products.name',
                            ],
                            'fuzziness' => $fuziness,
                        ]
                    ];
                Log::info('SEARCH OPTIONS: ' . json_encode($options));
                return $engine->search($options);
            })
            ->orderby($sort_column, $sort_az_za)
            ->paginate(10);
            $records_shown = Visit::search($search)->count();
            $query_type = 'search';
        } else { // this is important because the field names in the index not necessaraly has the same name as of the database.
            $visits = DB::table('visits')
            // ->join('product_visit', 'product_visit.visit_id', 'visits.id')
            ->join('profiles', 'profiles.id', '=', 'visits.profile_id')
            ->join('origins', 'origins.id', 'visits.origin_id')
            ->join('users', 'users.id', 'visits.user_id')
            // ->sum('product_visit.amount')
            ->orderby($sort_column, $sort_az_za)
            ->select($columns)
            ->paginate(10);
            $records_shown = Visit::count();
            $query_type = 'all';
        }
        $visits->appends([
            'sort_column' => $sort_column,
            'sort_az_za' => $sort_az_za,
        ]);
        $page = Input::get('page');
        // DB::listen(function ($visits) {
        //     Log::info('SQL query: | ' . json_encode($visits));
        // });
        // Log::info('json_encode($visits) | ' . json_encode($visits));
        return view('visits.app.index', [
            'visits' => $visits,
            'aliases' => $aliases,
            'sort_column' => $sort_column,
            'sort_az_za' => $sort_az_za,
            'query' => $search,
            'page' => $page,
            'records_shown' => $records_shown,
            'query_type' => $query_type,
        ]);
    }

    public function getVisits()
    {
        //****  DATATABLES
        $start = intval($_REQUEST['start']);
        $length = intval($_REQUEST['length']);

        $current_date = Carbon::now('America/New_York')->format('Y-m-d');
        $current_time = Carbon::now('America/New_York')->toTimeString();
        $visits = Visit::orderBy('id', 'asc')
            //   orderBy('dt', 'desc')
            // ->orderBy('tm', 'desc')
            // ->where(function($query) use ($current_date,$current_time){$query
            //     ->where('dt','<=',$current_date)
            //     ->orWhere('tm','<=',$current_time);
            // })
            ->with(['profile' => function ($query) {$query->select('id', 'name');}])
            ->with(['origin' => function ($query) {$query->select('id', 'name');}])
            ->with(['user' => function ($query) {$query->select('id', 'name');}])
            ->skip($start)->take($length)->get(
                // ->get(
            [
                'id',
                'unit',
                'dt',
                'tm',
                'profile_id',
                'origin_id',
                'avg',
                'max',
                'min',
                'prec',
                'comment',
                'user_id'
            ]
        );
        foreach ($visits as $visit) {
            $productAmountSum = DB::table('product_visit')
            ->where('visit_id', $visit->id)->sum('amount');
            $visit->productAmountSum = $productAmountSum;

            $productQtdSum = DB::table('product_visit')
            ->where('visit_id', $visit->id)->sum('qtd');
            $visit->productQtdSum = $productQtdSum;
            $visit->comment = substr($visit->comment, 0, 13) . '...';
        }

        $result = datatables()
            ->of($visits)
            ->addColumn('action', function ($visit) {
                $loggedUser = Auth::user();
                $editButton = '';
                if ($loggedUser->id == $visit->user_id) {
                    $editButton = "<a href='/app/edit/" . $visit->id . "' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-pencil'></i></a>";
                }
                return $editButton;
            })
            ->rawColumns(['action', 'actiond'])
            ->toJson();
        return  $result;
    }

    /**
     * Show the form for creating a new resource.
     * No API like response, as it is meant only for the web
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profiles = Profile::orderBy('name')->pluck('name', 'id');
        $origins = Origin::orderBy('name')->pluck('name', 'id');
        $products = Product::orderBy('name')->pluck('name', 'id');
        return view('visits.app.formVisitNew', [
            'profiles' => $profiles,
            'origins' => $origins,
            'products' => $products,
            'currentDate' => Carbon::now('America/New_York')->format('M/d/Y'),
            'currentTime' => Carbon::now('America/New_York')->toTimeString()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $isnew = ['value', 0];
        // to know if this is new
        // if the comes for the new url, then it's new
        if (preg_match('/new/', request()->headers->get('referer'))) {
            $isnew = ['value', 1];
        }
        if (!$visit = Visit::find($id)) {
            return redirect()->route('app.index')->with('info-danger', 'ID not found.');
        }
        $loggedUser = Auth::user();
        if ($loggedUser->id != $visit->user_id) {
            return redirect()->route('app.index')->with('info-warning', 'You do not have permission for this record, visit ID ' . $visit->id . '.');
        }

        $productsPivot = $visit->products()->get();
        $thisUser = User::where('id', '=', $visit->user_id)->first();
        $previous = Visit::where('id', '<', $visit->id)->max('id');
        $next = Visit::where('id', '>', $visit->id)->min('id');
        $profiles = Profile::orderBy('name')->pluck('name', 'id');
        $origins = Origin::orderBy('name')->pluck('name', 'id');
        $products = Product::orderBy('name')->pluck('name', 'id');

        return view('visits.app.formVisitEdit', [
            'id' => $visit->id,
            'visit' => $visit,
            'profiles' => $profiles,
            'origins' => $origins,
            'products' => $products,
            'productsPivot' => $productsPivot,
            'isnew' => $isnew,
            'previous' => $previous,
            'next' => $next,
            'this_user' => $thisUser,
            'page' => 0,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * If called as an API (heeader=>Accept=>application/json)
     * it will only only the json($response, code)
     * Otherwise, it will show the appropriate view
     * Uses transactions to keep the db integrity in case of error
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $log_prefix = 'PVWC_store';
        $prof_id_not = $env = env('APP_PROFILE_ID');
        $orig_id_not = $env = env('APP_ORIGIN_ID');
        $prod_id_not = $env = env('APP_PRODUCT_ID');
        $isnew = ['value', 0];
        // to know if this is new
        // if the comes for the new url, then it's new
        if (preg_match('/create/', request()->headers->get('referer'))) {
            $isnew = ['value', 1];
        }
        $rules = [
            // the other fields in the form can be handled by the 'required' parameter in the <<Forms::>>
            'profile_id' => 'required|not_in:' . $prof_id_not,
            'origin_id' => 'required|not_in:' . $orig_id_not,
            'products.0' => 'required|not_in:' . $prod_id_not,
            'products.1' => 'required|min:0',
            'products.2' => 'required|min:0',
        ];
        $profile_message = 'Please choose the visitor\'s profile from the "Profile" list';
        $origin_message = 'Please choose the origin of the visitor from the "Origin" list';
        $product_message = 'Please choose the product from the "Product" list.';
        $customMessages = [
            'profile_id.required' => $profile_message,
            'profile_id.not_in' => $profile_message,
            'origin_id.required' => $origin_message,
            'origin_id.not_in' => $origin_message,
            'products.0.required' => $product_message,
            'products.0.not_in' => $product_message,
        ];
        $this->validate($request, $rules, $customMessages);
        // Once it's validated let's get the value of the fields
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('fail', 'You do not have permission for this action.');
        }
        $dt = trim($request->input('dt'));
        $dt = trim(date('Y-m-d', strtotime($dt)));
        $tm = date('G:i:s', strtotime($request->input('tm')));
        $productsArray = ($request->input('products'));
        $product_id = ($productsArray[0]);
        $qtd = ($productsArray[1]);
        $amount = ($productsArray[2]);
        $dt_trim = trim($request->input('dt'));
        Log::info($log_prefix . 'dt_trim: ' . $dt_trim);
        Log::info($log_prefix . ' date((dt_trim): ' . date('M', strtotime($dt_trim)));
        $month_year = date('M', strtotime($dt_trim)) . date('Y', strtotime($dt_trim));
        Log::info($log_prefix . 'input dt: ' . $month_year);
        $visit = new Visit([
            'unit' => $request->input('unit'),
            'dt' => $dt,
            'dt_unix' => strtotime(json_encode($dt)),
            'month_year' => $month_year,
            'tm' => $tm,
            'tm_unix' => strtotime($tm),
            'profile_id' => $request->input('profile_id'),
            'origin_id' => $request->input('origin_id'),
            'avg' => $request->input('avg'),
            'max' => $request->input('max'),
            'min' => $request->input('min'),
            'prec' => $request->input('prec'),
            'comment' => $request->input('comment'),
        ]);
        // it's time to save it in a transaction
        // try{
        DB::beginTransaction();
        if ($user->visits()->save($visit)) {
            $visit->products()->attach([$product_id], ['qtd' => $qtd, 'amount' => $amount]);
            DB::commit();
            return redirect()->route('app.edit', ['id' => $visit->id])->with('info-success', 'Data saved!');
        }
        // }
        // catch(\Exception $e){
        DB::rollback();
        return redirect()->route('app.index', ['id' => $visit->id])->with('info-danger', 'Error: could not save!');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $prof_id_not = $env = env('APP_PROFILE_ID');
        $orig_id_not = $env = env('APP_ORIGIN_ID');
        $rules = [
            // the other fields in the form can be handled by the 'required' parameter in the <<Forms::>>
            'profile_id' => 'required|not_in:' . $prof_id_not,
            'origin_id' => 'required|not_in:' . $orig_id_not
        ];
        $profile_message = 'Please choose the type of visitor from the "Profile" list';
        $origin_message = 'Please choose the origin of the visitor from the "Origin" list';
        $customMessages = [
            'profile_id.required' => $profile_message,
            'profile_id.not_in' => $profile_message,
            'origin_id.required' => $origin_message,
            'origin_id.not_in' => $origin_message
        ];

        $this->validate($request, $rules, $customMessages);

        $visit_id = (int)$request->input('id');
        if (!$visit = Visit::find($visit_id)) {
            return redirect()->route('app.index')->with('info-danger', 'ID not found.');
        }

        $newRecord = 3; // for each 3 elements of the $productsArray we have a new record.
        $productsArray = [$request->input('products')];
        $countProductsArray = count($productsArray, COUNT_RECURSIVE) - 2;

        // ************************
        // **** UPDATE THE VISIT **
        // ************************
        $dt = date('Y-m-d', strtotime($request->input('dt')));
        $tm = date('H:i:s', strtotime($request->input('tm')));
        $dt_trim = trim($request->input('dt'));
        $month_year = date('M', strtotime($dt_trim)) . date('Y', strtotime($dt_trim));
        $visit->update([
                'unit' => $request->input('unit'),
                'dt' => $dt,
                'dt_unix' => strtotime(json_encode($dt)),
                'month_year' => $month_year,
                'tm' => $tm,
                'tm_unix' => strtotime($tm),
                'profile_id' => $request->input('profile_id'),
                'origin_id' => $request->input('origin_id'),
                'avg' => $request->input('avg'),
                'max' => $request->input('max'),
                'min' => $request->input('min'),
                'prec' => $request->input('prec'),
                'comment' => $request->input('comment')
            ]);
        // Let's loop through the array of products of this visit
        foreach ($productsArray as &$thisProduct) {
            // Let's then loop through the elements of the array
            // Note: remember that this array has only one row
            for ($i = 0; $i < $countProductsArray; $i++) {
                // **** Remainder ****
                // now we look for end of each block of three elements
                // for 0 to 2 -- thus add 0 (implicit), 1 and 2 to $i)
                // if the remainder of i divided by the newRecord = 0, then it's
                // time to start a new group
                if (($i % $newRecord) == 0) {       // that means a new "side record" has started
                    $product_id = (int)$thisProduct[$i];
                    $qtd = (int)$thisProduct[$i + 1];
                    $amount = (double)$thisProduct[$i + 2];
                    $productCount = $visit->products()
                                                ->wherePivot('product_id', '=', $product_id)
                                                ->count();
                    // check if exists on the dataset. If yes, update, if not add.
                    if ($productCount == 0) {// this is a new product
                        if ($product_id != 31) { //36 = please choose will not be added
                            $visit->find($visit_id)
                                   ->products()
                                   ->attach([$product_id], ['qtd' => $qtd, 'amount' => $amount]);
                        }
                    }
                    if ($productCount == 1) { // product already exists on the product_visit table. Let's update it.
                        $visit->find($visit_id)
                                ->products()
                                ->syncWithoutDetaching([$product_id => ['qtd' => $qtd, 'amount' => $amount]]);
                    }
                } //if
            } // for
        } //for each

        return redirect()->route('app.edit', ['id' => $visit_id])->with('info-success', 'Data updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request, $id)
    public function destroy($id)
    {
        $visit = Visit::find($id);
        if (!$visit) {
            return response()->json(['success-danger' => 'Visit ID ' . $id . ' not found.'], 404);
        };
        if (Gate::denies('visit-update-delete', $visit)) {
            Log::info('wrong user delete action');
            // return redirect()->back()->with('fail', 'You do not have permission for deleting the visit '.$id. '.');
            return redirect()->route('app.edit', ['id' => $visit->id])->with('info-warning', 'You do not have permission for deleting the visit ID ' . $id . '.');
        }
        $products = $visit->products; // get the product in case we need to attach them again
        $visit->products()->detach();
        if (!$visit->delete()) {
            //id the visit cannot be delete, retach the products
            foreach ($products as $product) {
                $visit->users()->attach($product);
            }
            return redirect()->route('app.index')->with('info-success', 'Data deleted!');
        }
        //if error
        return redirect()->route('app.edit', ['id' => $visit->id])->with('info-warning', 'Error: data could not be deleted!');
    }

    public function destroyProductVisit(Request $request, $id)
    {
        $visit = Visit::find($id);
        if (Gate::denies('visit-update-delete', $visit)) {
            Log::info('wrong user delete action');
            return redirect()->route('app.edit', ['id' => $visit->id])->with('info-warning', 'You do not have permission for deleting the visit ID ' . $id . '.');
        }
        if (!$visit) {
            return response()->json(['info-danger' => 'Visit ID ' . $id . ' not found.'], 404);
        };
        $product_id_array = $request->product_id;
        Log::info('product_id: ' . json_encode($product_id_array));
        Log::info('request: ' . json_encode($request));
        Log::info('id: ' . json_encode($id));

        foreach ($product_id_array as $this_product) {
            Log::info('this_product: ' . $this_product);
            if (!$visit->products()->wherePivot('product_id', $this_product)->detach()) {
                Log::info('error: ' . 'Could not delete the product ID ' . $this_product . '.');
                // return redirect()->route('app.edit', ['id'=>$visit->id])->with('info-warning', 'Could not delete the product ID ' . $this_product . '.');
            }
        }
    }
}
