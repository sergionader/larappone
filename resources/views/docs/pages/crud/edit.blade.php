@extends('layouts.master') 
<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Page</h1>
            <p>It allows the user to edit records as described below.
            </p>
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Called from the <a href="{{route('docs.pages.list.index')}}" class="doc-link">List, Search, Edit & Delete</a></h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                <div class="box-body"> 
                    <img class="img-responsive" src="/img/crud/edit_visit.png" alt="edit visit">               
                    <ul class="list-group">
                            <li class="list-group-item"><strong>1 - Unit</strong>: the store code.</li>
                            <li class="list-group-item"><strong>2 - Date</strong>: the date of the visit. Auto-filled with the current date, but can be changed. It uses the <a href="{{route('docs.pages.crud.daterange')}}" class="doc-link">Date Range Picker</a> control.</li>
                            <li class="list-group-item"><strong>3 - Time</strong>: the time of the visit. Auto-filled with the current time, but can be changed.</li>
                            <li class="list-group-item"><strong>4 - Profile</strong>: basically gender and age, For instance, <i>young lady</i> or <i>middle age gentleman</i>.</li>
                            <li class="list-group-item"><strong>5 - Origin</strong>: the business runs in a place with many tourists, so the origin regards the original country or ethnic group the visitor belongs to.</li>
                            <li class="list-group-item"><strong>6 - Product</strong>: the product or products the visitor bought or asked for.</li>
                            <li class="list-group-item"><strong>7 - Qtd</strong>: the quantity of the products.</li>
                            <li class="list-group-item"><strong>8 - Amount</strong>: the price paid for the product. If the customer didn't buy anything, then qtd and amount should be left zeroed.</li>
                            <li class="list-group-item"><strong>9 - Weather fields</strong>: Time to time the minimum, average, and maximum temperatures are imported to the system as well as the precipitation volume of the store region -- all with the purpose of future machine learning analysis. This fields will default to zero if no value is entered by the user.</li>
                            <li class="list-group-item"><strong>10 - Comments</strong>: any additional information about the visits/products</li>
                            <li class="list-group-item">
                                @include('partials.cool-feature')  You can use the buttons above the field "created by" to navigate to the next record without having to get back to the grid!
                                </div>
                            </li>
                        </ul>
                        <p>Buttons</p> 
                        <ul class="list-group">
                            <li class="list-group-item"><strong>List</strong>: it loads the "List, Search, Edit, Delete & Add)" page. If the record was not saved, it will be lost.</li>
                            <li class="list-group-item"><strong>Add</strong>: it loads the <a href="{{route('app.create')}}" class="doc-link">Add Visit</a> page</li>
                            <li class="list-group-item"><strong>Update</strong>: it updates the visit and its products.</li>
                            <li class="list-group-item"><strong>Delete</strong>: it asks the user if the record should be deleted and then deletes it if the user confirms the action. It only shows on the edit page.</li>
                        </ul>  
                </div>
     
        </div>

        <div id="add_delete" class="box box-primary">
            <div class="box-header with-border">
                <h2  class="box-title">Adding and Removing Products</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <div class="box-body">
                <ul class="list-group">
                    <li class="list-group-item">The edit page allows the user to add and remove as many products are needed. </li>
                    <li class="list-group-item">When deleting a product from a visit, the product is removed even if the save button is not pressed.
                        </li>
                    <li class="list-group-item">It is possible to remove several products at once.</li>
                    <li class="list-group-item">When adding a product, it is necessary to save the visit to effectively add it to the database. As soon
                        as the clicks the plus sign to add a product, a message in the product row will indicate it is not
                        saved yet. </li>
                    <li class="list-group-item">Once a product is added, it is possible to edit its quantity and amount, but not its name. To change
                        its name, it is necessary to remove the product and add it again.</li>
                    <li class="list-group-item">If the user tries to add a product that is already attached to that visit, the system will consider only
                        the first occurrence of the product. </li>
                </ul>
            </div>
        </div>

        
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

