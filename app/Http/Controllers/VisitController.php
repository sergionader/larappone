<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Product;
use App\Profile;
use App\Origin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class visitController extends Controller
{
    public function homePage()
    {
        return view('visits.index');
    }

    public function getAll()
    //loads the records (html grid)
    {
        $sort_column = 'visits.id';
        $sort_az_za = 'asc';
        if ($_REQUEST) {
            $sort_column = (string)($_REQUEST['sort_column']);
            $sort_az_za = (string)($_REQUEST['sort_az_za']);
        };

        $columns = [
            'visits.id as id', 'visits.dt as dt', 'visits.tm as tm', 'profiles.name as profile', 'origins.name as origin', 'users.id as user_id', 'users.name as user', 'comment'
        ];

        $visits = DB::table('visits')
        ->join('profiles', 'profiles.id', '=', 'visits.profile_id')
        ->join('origins', 'origins.id', 'visits.origin_id')
        ->join('users', 'users.id', 'visits.user_id')
        ->orderby($sort_column, $sort_az_za)
        ->select($columns)

        ->paginate(10);
        $visits->appends([
            'sort_column' => $sort_column,
            'sort_az_za' => $sort_az_za
        ]);

        // $this_user  = User::where('id', '=', $visit->user_id)->first();
        return view('visits.apphtml.index', [
            'visits' => $visits,
            // 'this_user' => $this_user,
            ]);
        // return $visits;
    }

    public function getVisitNew()
    {
        //From: view/visits/apphtml/index.blade.php
        //Calls: this@postVisitInsert
        //       this@postEdit
        //load the models and the create grid page
        $visits = Visit::get();
        $profiles = Profile::orderBy('name')->get();
        $origins = Origin::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        return view('visits.apphtml.formVisitNew', [
            'visits' => $visits,
            'profiles' => $profiles,
            'origins' => $origins,
            'products' => $products,
            'currentDate' => date('Y-m-d'),
            'currentTime' => date('h:i:s'),
            ])->withInput($visits);
    }

    public function postVisitInsert(Request $request)
    {
        //From: view/visits/apphtml/formVisitNew.blade.php
        //Calls:
        //Redirects to: formVisitEdit.blade.php
        // {
        $rules = [
            'unit' => 'required|min:2|max:2',
            'dt' => 'required|min:8',
            'tm' => 'required|min:5',
            'profile_id' => 'required|not_in:14',
            'origin_id' => 'required|not_in:16',
            'products.0' => 'required|not_in:36',
            'products.1' => 'required|min:0',
            'products.2' => 'required|min:0',
        ];
        $profileMessage = 'Please choose the profile of visitor from the "Who" list';
        $originMessage = 'Please choose the origin of the visitor from the "Origin" list';
        $idMessage = 'Please choose the product from the "What" list.';
        $qtdMessage = 'The qtd field has to be >=0.';
        $amountMessage = 'The qtd field has to be >=0.';
        $customMessages = [
            'unit.required' => 'Unit cannot be blank and must have 2 char max',
            'profile_id.required' => $profileMessage,
            'profile_id.not_in' => $profileMessage,
            'origin_id.required' => $originMessage,
            'origin_id.not_in' => $originMessage,
            'products.0.required' => $idMessage,
            'products.0.not_in' => $idMessage,
            'products.1.required' => $qtdMessage,
            'products.1.min' => $qtdMessage,
            'products.2.required' => $amountMessage,
            'products.2.min' => $amountMessage,
        ];
        $this->validate($request, $rules, $customMessages);

        $visit = new Visit([
            'unit' => $request->input('unit'), //->withInput(),
            'dt' => $request->input('dt'),
            'tm' => $request->input('tm'),
            'profile_id' => $request->input('profile_id'),
            'origin_id' => $request->input('origin_id'),
            'avg' => $request->input('avg'),
            'max' => $request->input('max'),
            'min' => $request->input('min'),
            'prec' => $request->input('prec'),
            'comment' => $request->input('comment')
        ]);

        $isnew = $request->input('isnew');

        // We need all of the bellow arrays to send it to the edit page when we load it
        // to allow the user to add more products;
        $profiles = Profile::orderBy('name')->get();
        $thisProfile = Origin::find($visit->profile_id);
        $origins = Origin::orderBy('name')->get();
        $thisOrigin = Origin::find($visit->origin_id);
        $productList = Product::orderBy('name')->get();

        // // save the visit
        $visit->save();
        // save the related products
        // ******************************
        // Though Laravel claims to save data on associated tables (pivot tables),
        // we have to handle the loop of the products, as the user may insert more than
        // on using view/visits/apphtml/fromVisitNew.blade.php
        // Bellow is what the "normal" code should look like:
        // ******************************
        // $visit->products()->attach([
        //     $request->input('product_id'),
        //     $visit->id],
        //    [
        //     'qtd'           => $request->input('qtd'),
        //     'amount'        => $request->input('amount')
        // ]);
        // ******************************
        // Optional code for saving on the product_visit tables

        $productsArray = [$request->input('products')];
        $countProductsArray = count($productsArray, COUNT_RECURSIVE) - 1;
        $newRecord = 3;
        $currentDateTime = date('Y-m-d h:i:s');
        foreach ($productsArray as &$thisProduct) {
            // Let's then loop through the elements of the array
            // Note: remenber that this array has only on row
            for ($i = 0; $i < $countProductsArray; $i++) {
                // now we check for final of each block of three elements
                // for 0 to 2 -- thus add 0 (implicit), 1 and 2 to $i)
                // if the remainder of i divided by the newRecord = 0, then it's
                // time to start a new group
                if (($i % $newRecord) == 0) {
                    $productID = (int) $thisProduct[$i];
                    $qtd = (int)$thisProduct[$i + 1];
                    ;
                    $amount = (int)$thisProduct[$i + 2];
                    ;
                    $currentDateTime = date('Y-m-d h:i:s');
                    $sqlExecute = null;
                    if ($productID != 36) { //36 = please choose
                        // $sqlExecute = "insert into  product_visit (product_id,visit_id,qtd,amount, created_at) Values ( $productID, $visit->id, $qtd, $amount, '$currentDateTime')";
                        $visit->find($visit->id);
                        $visit->products()->attach([$productID], ['qtd' => $qtd, 'amount' => $amount]);
                    }
                    if ($sqlExecute != null) {
                        DB::select($sqlExecute);
                    }
                } //if
            } // for
        } //for each

        return redirect()->route('apphtml.edit', [
            'id' => $visit->id
            ])->with('info-success', "Row inserted: ID: $visit->id .");
    }

    public function getVisitEdit($id)
    {
        //From: view/visits/apphtml/index.blade.php
        //Calls: this@postVisitUpdate
        //load the models and the edit page

        $isnew = ['value', 0];
        // to know if this is new
        // if the comes for the new url, then it's new
        if (preg_match('/new/', request()->headers->get('referer'))) {
            $isnew = ['value', 1];
        }

        $visit = Visit::where('id', '=', $id)->with(['profile', 'origin', 'products'])->firstorfail();
        $profiles = Profile::orderBy('name')->get();
        $thisProfile = Origin::find($visit->profile_id);
        $origins = Origin::orderBy('name')->get();
        $thisOrigin = Origin::find($visit->origin_id);
        $productList = Product::orderBy('name')->get();
        $previous = Visit::where('id', '<', $visit->id)->max('id');
        $next = Visit::where('id', '>', $visit->id)->min('id');

        return view('visits.apphtml.formVisitEdit', [
            'visit_id' => $id,
            'visit' => $visit,
            'profiles' => $profiles,
            'thisProfile' => $thisProfile,
            'origins' => $origins,
            'thisOrigin' => $thisOrigin,
            'productList' => $productList,
            'isnew' => $isnew,
            'previous' => $previous,
            'next' => $next,
            // 'toggle_disable'=> $toggle_disable,
            // 'button_type'   => $button_type,
            ]);
    }

    public function postVisitUpdate(Request $request)
    {
        //From: view/visits/apphtml/formVisitEdit.blade
        //Calls:
        //Redirects to: (apphtml.update) view/visits/apphtml/formVisitEdit.blade in case the user wants to add more products to the visit
        {
        // ************************************
        // **** VALIDATION variables and arrays
        // ************************************

        // Please note that the produc id, qtd and amount are missing.
        // As they belong to an array, products[], we will index it and add the
        // rules and messages dinamicaly to the $rules and $messages arrays.
        $profileMessage = 'Please choose the profile of visitor from the "Who" list';
        $originMessage = 'Please choose the origin of the visitor from the "Origin" list';
        $idMessage = 'Please choose the product from the "What" list.';
        $qtdMessage = 'The qtd field has to be >=0.';
        $amountMessage = 'The amount field has to be >=0.';

        $rules = [
            'unit' => 'required|min:2|max:2',
            'dt' => 'required|min:8',
            'tm' => 'required|min:5',
            'profile_id' => 'required|not_in:14',
            'origin_id' => 'required|not_in:16',
        ];

        $customMessages = [
            'unit.required' => 'Unit cannot be blank and must have 2 char max',
            'profile_id.required' => $profileMessage,
            'profile_id.not_in' => $profileMessage,
            'origin_id.required' => $originMessage,
            'origin_id.not_in' => $originMessage,
        ];
    }

        // ***************
        // **** NOTES ****
        // ***************
        // The vars $newRecord, tells us how many elements a "record" holds.
        // It will used in the same way for updating the pivot table.
        // Also sthe vars $productsArray and $productsArray will be used for updating the pivot table
        // We could do it only once, i.e. loop, create the validation rules and update
        //      but it seemed better for first validate and then, once validade, save the
        //      visit and the associated records on the pivot table.

        // ******************************************************************
        // **** VARS that will also be used for updating the pivot table ****
        // ******************************************************************
        $newRecord = 3;
        $productsArray = [$request->input('products')];
        $countProductsArray = count($productsArray, COUNT_RECURSIVE) - 1; //(-1 because it counts itself)

        // ********************
        // **** Validation ****
        // ********************
        $validatorKey = 'products.';
        $requiredStr = 'required';
        $notInStr = 'not_in';

        // Let's loop through the array of products of this visit;
        foreach ($productsArray as &$key) {
            // Let's then loop through the elements of the array:
            for ($i = 0; $i < $countProductsArray; $i++) {
                // look for the "**** Remainder ****" string for an explanation on how
                // it works.
                if (($i % $newRecord) == 0) {
                    //prod id (0, 3, 6, 9, etc)
                    $rules[$validatorKey . $i] = $requiredStr . '|' . $notInStr . ':36';
                    $customMessages[$validatorKey . $i . '.' . $requiredStr] = $idMessage;
                    $customMessages[$validatorKey . $i . '.' . $notInStr] = $idMessage;
                    //qtd (1, 4, 7, 10, etc)
                    $addedKey = ++$i;
                    $rules[$validatorKey . $addedKey] = $requiredStr;
                    $customMessages[$validatorKey . $addedKey . '.' . $requiredStr] = $qtdMessage;
                    //amount (2, 5, 8, 11, etc)
                    $addedKey = ++$i;
                    $rules[$validatorKey . $addedKey] = $requiredStr;
                    $customMessages[$validatorKey . $addedKey . '.' . $requiredStr] = $amountMessage;
                }//if
            }//for
        }//foraech
    asort($rules);
        asort($customMessages);
        // aplly the validation
        $this->validate($request, $rules, $customMessages);

        // ************************
        // **** SAVE THE VISIT ****
        // ************************
        $visitID = (int)$request->input('id');
        $visit = Visit::where('id', '=', $visitID)->with(['products'])->firstorfail();
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
            'tm' => $request->input('tm'),
            'profile_id' => $request->input('profile_id'),
            'origin_id' => $request->input('origin_id'),
            'avg' => $request->input('avg'),
            'max' => $request->input('max'),
            'min' => $request->input('min'),
            'prec' => $request->input('prec'),
            'comment' => $request->input('comment')
        ]);
        // **************************
        // **** SAVE PIVOT TABLE ****
        // **************************
        // NOTE:
        // Let's get the values stored on the association table for this visit
        // We need to get the visit_id to find the records we'll need to update on the
        // 'table' (model) product_visit
        // Let's get the list of products from <name="products[]"> for each input text control
        // ====> (we did it when started the validation) see <<$productsArray = [$request->input('products')];>>
        // count how many useful (-1 because it counts itself) elements it has
        // ====> we did it when started the validation) see <<$countProductsArray  = count($productsArray, COUNT_RECURSIVE) -1;>>
        //  The $productsArray will bring product_id, qtd and amount.
        //  As they come in a single row, we will need to split it
        //  each three elements (three fields per record: product_id, qtd and amount).
        //      for instance, [["35","2","214.00","2","1","100.00","7","1","159.00"]] is the same of
        //          products(0) = 35  = id     of the 1st product;
        //          products(1) = 2   = qtd    of the 1st product;
        //          products(2) = 214 = amount of the 1st product;
        //        then we will have to start again:
        //          products(4) =  2  = id     of the 2st product;
        //          products(5) =  1  = qtd    of the 2st product;
        //          products(6) = 100 = amount of the 2t product;
        //        and so on.
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
                    // check if exists on the dataset. If yes, update, if not add.
                    $productID = (int)$thisProduct[$i];
                    $qtd = (int)$thisProduct[$i + 1];
                    $amount = (double)$thisProduct[$i + 2];
                    $currentDateTime = date('Y-m-d h:i:s');
                    $productCount = $visit->products()
                                          ->wherePivot('product_id', '=', $productID)
                                          ->count();
                    if ($productCount == 0) { // this is a new product
                        if ($productID != 36) { //36 = please choose
                            $visit->find($visitID)
                                    ->products()
                                    ->attach([$productID], ['qtd' => $qtd, 'amount' => $amount]);
                        }
                    }
                    if ($productCount == 1) {
                        $visit->find($visitID)
                                ->products()
                                ->sync([$productID => ['qtd' => $qtd, 'amount' => $amount]]);
                    }
                } //if
            } // for
        } //for each
        return redirect()->route('apphtml.edit', [
            'visit_id' => $visitID,
            ])->with('info-success', 'Data updated!');
    }

    // postVisitUpdate

    public function getVisitDelete($id)
    {
        $visits = Visit::find($id);
        $visits->products()->detach();
        $visits->delete();
        return redirect()->route('apphtml.index')
            ->with('info-success', 'Data deleted! ID:' . $id);
    }

    public function getVisitProductDelete()
    {
        $visit_id = (int)Request('visit_id');
        $product_id = (int)Request('product_id');

        $visits = Visit::find($visit_id);
        $visits->products()->wherePivot('product_id', '=', $product_id)->detach();
    }
}
