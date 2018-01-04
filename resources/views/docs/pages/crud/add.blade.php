@extends('layouts.master') 
<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Add Page</h1>
            <p>It allows the user to add records. When you add a record, it is only possible to add one product. As soon it is saved in the database
                you will be able to add more products. This was intentional once most of the visits will only have one product, there was no reason to show the add/delete products button on this page.
                To learn more about adding more products, visit the <a href="{{route('docs.pages.edit.index')}}#add_delete" class="doc-link" > Edit Page </a>document and look for the "Adding and Removing Product" section. 
            </p>
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Called from the <a href="{{route('docs.pages.list.index')}}" class="doc-link">List, Search, Edit & Delete </a> and from the sidebar menu</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
            <div class="box-body">
                    <img class="img-responsive" src="/img/crud/add_visit.png" alt="Add visit">
                <h4>Fields</h4>
                <ul class="list-group">
                    <li class="list-group-item"><strong>1 - Unit</strong>: the store code.</li>
                    <li class="list-group-item"><strong>2 - Date</strong>: the date of the visit. Auto-filled with the current date, but can be changed. It uses the <a href="{{route('docs.pages.crud.daterange')}}" class="doc-link">Date Range Picker</a> control.</li>
                    <li class="list-group-item"><strong>3 - Time</strong>: the time of the visit. Auto-filled with the current time, but can be changed.</li>
                    <li class="list-group-item"><strong>4 - Profile</strong>: basically gender and age, For instance, <i>young lady</i> or <i>middle age gentleman</i>.</li>
                    <li class="list-group-item"><strong>5 - Origin</strong>: the business runs in a place with many tourists, so the origin regards the original country or ethnic group the visitor belongs to.</li>
                    <li class="list-group-item"><strong>6 - User</strong>: the user who created the visit. This value can't be changed</li>
                    <li class="list-group-item"><strong>7 - Products</strong>: list of the products, quantities, and amounts as well as their selector to allow bulk deletion.</li>
                    <li class="list-group-item"><strong>8 - Add and Remove Buttons</strong>: Buttons to add and remove products.</li>
                    <li class="list-group-item"><strong>9 - Weather fields</strong>: Time to time the minimum, average, and maximum temperatures are imported to the system as well as the precipitation volume of the store region -- all with the purpose of future machine learning analysis. This fields will default to zero if no value is entered by the user.</li>
                    <li class="list-group-item"><strong>10 - Comments</strong>: Any additional information about the visits/products</li>
                </ul>
                <h4>Buttons</h4>
                <ul class="list-group">
                    <li class="list-group-item"><strong>List</strong>: it loads the "List, Search, Edit, Delete & Add)" page. If the record was not saved, it will be lost.</li>
                    <li class="list-group-item"><strong>Save</strong>: it adds the new visit and its products to the database. When adding a visit, it loads the edit page giving the user the opportunity to add more products to that same visit.</li>
                    <li class="list-group-item"><strong>Cancel</strong>: It cleans up the current form without saving the record. It only shows on the Add page.</li>
                </ul>
                @include('partials.cool-feature')
                The operation (save, update, etc) feedback is mostly presented as a collapsable alert as shown below. 
                </div>
                <img class="img-responsive" src="/img/crud/success.png" alt="Add visit">
                
            </div>
            
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

