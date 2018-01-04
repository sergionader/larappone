<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Visit;
use JWTAuth;

class ProductControllerApi extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => ['update', 'store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->view_product = [
                'href' => 'api/v1/visit/' . $product->id,
                'method' => 'GET'
            ];
            $response = [
                'msg' => 'Product fetched. ID: ' . $product->id,
                'data' => $product,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $visit_id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'User not authenticated.'], 404);
        }

        $product_id = $request->product_id;
        if (!$visits = Visit::find($visit_id)) {
            $response = [
                'msg' => 'Could not find the visit ID ' . $visit_id,
            ];
            return response()->json($response, 404);
        }

        if ($visits->products()->WherePivotIn('product_id', $product_id)->detach()) {
            $response = [
                'msg' => 'Product ID: ' . json_encode($product_id) . ' deleted from visit id: ' . $visit_id,
            ];
            return response()->json($response, 200);
        }
        //     // if error
        $response = [
            'msg' => 'Could not delete product ID: ' . json_encode($product_id) . ' from visit id: ' . $visit_id,
        ];
        return response()->json($response, 404);
    }
}
