<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Product;
use App\Profile;
use App\Origin;
use App\User;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use View;

class ProductVisitApi extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => ['update', 'store', 'destroy']]);
    }

    public function apiHome()
    {
        return view('docs.api.index');
    }

    /**
     * Display a listing of the resource.
     * If called as an API (heeader=>Accept=>application/json)
     * it will only only the json($response, code)
     * Otherwise, it will show the appropriate view
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($visits = Visit::with(['profile', 'origin', 'products', 'user'])->take(100)->get()) {
            foreach ($visits as $visit) {
                $visit->view_visit = [
                    'href' => 'api/v1/visit/' . $visit->id,
                    'method' => 'GET'
                ];
            }
            $response = [
                'msg' => 'List of all visits',
                'visits' => $visits
            ];
            return response()->json($response, 200);
        }
        $response = [
            'msg' => 'Could not list the visits.',
        ];
        return response()->json($response, 201);
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
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'User not authenticated.'], 404);
        }
        $dt = $request->input('dt');
        $dt_unix = strtotime($dt);
        $tm = $request->input('tm');
        $tm_unix = strtotime($tm);
        $dt = date('Y-m-d', strtotime($dt));
        $productsArray = ($request->input('products'));
        $product_id = ($productsArray[0]);
        $qtd = ($productsArray[1]);
        $amount = ($productsArray[2]);
        // dump($request->input('products'));
        // dump($dt);
        $user_id = $user->id;
        $visit = new Visit([
            'unit' => $request->input('unit'),
            'dt' => $dt,
            'dt_unix' => $dt_unix,
            'tm' => $tm,
            'tm_unix' => $tm_unix,
            'profile_id' => $request->input('profile_id'),
            'origin_id' => $request->input('origin_id'),
            'avg' => $request->input('avg'),
            'max' => $request->input('max'),
            'min' => $request->input('min'),
            'prec' => $request->input('prec'),
            'comment' => $request->input('comment'),
            'user_id' => $user_id
            ]);
        // it's time to save it.
        try {
            DB::beginTransaction();
            if ($visit->save()) {
                $visit->products()->attach([$product_id], ['qtd' => $qtd, 'amount' => $amount]);
                $visit->view_visit = [
                    'href' => '/api/v1/visit/' . $visit->id,
                    'method' => 'POST'
                ];
                $products = $visit->find($visit->id)->products()->get();
                $visit->products = $products;
                $response = [
                    'msg' => 'Visit created. ID: ' . $visit->id,
                    'visit' => $visit
                ];
                DB::commit();
                return response()->json($response, 201);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'msg' => 'Error during creation',
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if (!Visit::find($id)) {
            $response = [
                'msg' => 'ID ' . $id . '  not found'
            ];
            return response()->json($response, 404);
        }
        $visit = Visit::find($id);
        $productsPivot = $visit->products()->get();
        if ($visit) {
            $profiles = Profile::orderBy('name')->pluck('name', 'id');
            $origins = Origin::orderBy('name')->pluck('name', 'id');
            $products = Product::orderBy('name')->pluck('name', 'id');
            $visit->view_visit = [
                'href' => 'api/v1/visit/' . $visit->id,
                'method' => 'GET'
            ];
            $response = [
                'title' => 'myAPP',
                'version' => '1.0',
                'msg' => 'Visit fetched. ID: ' . $visit->id,
                'data' => $visit,
                'products' => $productsPivot
            ];
            return response()->json($response, 200);
        }
        //if error
        $response = [
            'msg' => 'ID ' . $id . '  not found'
        ];
        return response()->json($response, 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Moved to ProductVisitWeb@edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'User not authenticated.'], 404);
        }
        $visitID = (int)$id;
        $user_id = $user->id;
        if (!$visit = Visit::find($visitID)) {
            $response = [
                'msg' => 'Visit not found',
                'visit ID' => $visitID
            ];
            return response()->json($response, 404);
        }
        $isnew = ['value', 0];
        // to know if this is new
        // if the comes for the new url, then it's new
        // if (preg_match('/new/',request()->headers->get('referer'))){
        //     $isnew = ['value', 1];
        // }
        $newRecord = 3;
        $productsArray = [$request->input('products')];
        $productsArray = array_collapse($productsArray);
        $countProductsArray = count($productsArray);

        // ************************
        // **** UPDATE THE VISIT ****
        // ************************
        // We need all of the bellow arrays to the edit page when we reload it.
        // $profiles   = Profile::orderBy('name')->get();
        // $thisProfile= Origin::find($visit->profile_id);
        // $origins     = Origin::orderBy('name')->get();
        // $thisOrigin  = Origin::find($visit->origin_id);
        // $productList= Product::orderBy('name')->get();
        // update the visit model
        $visit->update([
                'unit' => $request->input('unit'),
                'dt' => $request->input('dt'),
                'dt_unix' => strtotime($request->input('dt')),
                'tm' => $request->input('tm'),
                'tm_unix' => strtotime($request->input('tm')),
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
            // Note: remenber that this array has only one row
            for ($i = 0; $i < $countProductsArray; $i++) {
                // **** Remainder ****
                // now we check for final of each block of three elements
                // for 0 to 2 -- thus add 0 (implicit), 1 and 2 to $i)
                // if the remainder of i divided by the newRecord = 0, then it's
                // time to start a new group
                if (($i % $newRecord) == 0) {       // that means a new "side record" has started
                    $productID = (int)$thisProduct[$i];
                    $qtd = (int)$thisProduct[$i + 1];
                    $amount = (double)$thisProduct[$i + 2];
                    $productCount = $visit->products()
                                            ->wherePivot('product_id', '=', $productID)
                                            ->count();
                    // check if exists on the dataset. If yes, update, if not add.
                    if ($productCount == 0) {// this is a new product
                        if ($productID != 36) { //36 = please choose
                            $visit->find($visitID)
                                    ->products()
                                    ->attach([$productID], ['qtd' => $qtd, 'amount' => $amount]);
                        }
                    }
                    if ($productCount == 1) {
                        $visit->find($visitID)
                                ->products()
                                ->syncWithoutDetaching([$productID => ['qtd' => $qtd, 'amount' => $amount]]);
                    }
                } //if
            } // for
        } //for each

        $visit->view_visit = [
            'href' => 'api/v1/visit/' . $visit->id,
            'method' => 'GET'
        ];
        $products = $visit->find($visit->id)->products()->get();
        $visit->products = $products;
        $response = [
            'msg' => 'Visit updated',
            'visit' => $visit
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['info-warning' => 'User not authenticated.'], 404);
        }
        $user_id = $user->id;
        $visit = Visit::find($id);
        if (!$visit) {
            return response()->json(['info-danger' => 'Visit ID ' . $id . ' not found.'], 404);
        };
        $products = $visit->products;
        $visit->products()->detach();
        if (!$visit->delete()) {
            foreach ($products as $product) {
                $visit->users()->attach($product);
            }
            return response()->json(['info-warning' => 'Could not find either the visit or the product(s) undes the visit.'], 404);
        }
        $response = [
            'msg' => 'Visit deleted. ID: ' . $id,
            'id' => $id,
            'create' => ['href' => 'api/v1/visits', 'method' => 'POST',
                'params' => [
                    'unit' => 'string(unit - 2 CHAR)',
                    'dt' => 'date(dt - YYYY-MM-DD),tm: time(tm - HH:MM)',
                    'profile_id' => 'integer(profile_id)',
                    'origin_id' => 'integer(origin_id)',
                    'avg' => 'decimal(avg, 5, 2)',
                    'max' => 'decimal(max, 5, 2)',
                    'min' => 'decimal(min, 5, 2)',
                    'prec' => 'decimal(prec, 5, 2)',
                    'comment' => 'text(comment)->nullable(false)',
                    'products' => [
                        '0' => 'integer(product_id)',
                        '1' => 'smallInteger(qtd)',
                        '2' => 'decimal(amount, 7, 2)}'
                    ]
                ]
            ]
        ];
        return response()->json($response, 200);
    }
}
