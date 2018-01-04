@extends('layouts.master') 
@section('content') 
@include('partials.errors')

<div class="row">
        <div class="panel panel-success">
            <div class="panel-heading"><strong>Data Entry</strong></div>
            <div class="panel-body">
                <form action="{{ route('apphtml.insert') }}" method="post">
                    <div class="form-group row">
                        <div class="col-xs-2">
                            <label for="title">Unit *</label>
                            <input type="text" class="form-control" id="unit" name="unit">
                        </div>
                        <div class="col-xs-2">
                            <label for="dt">Date *</label>
                            <input type="text" class="form-control" id="dt" name="dt" placeholder="yyyy-mm-dd" value ="{{$currentDate}}">
                        </div>
                        <div class="col-xs-2">
                            <label for="tm">Time (UTC) *</label>
                            <input type="text" class="form-control" id="tm" name="tm" placeholder="hh-mm" value ="{{$currentTime}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-2">
                            <label for="profile_id">Type *</label>
                            <select id="profile_id" name="profile_id" class="form-control">
                                @foreach($profiles as $profile)
                                    <option value="{{$profile->id}}"> 
                                        {{ $profile->name }}         
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <label for="origin_id">Origin</label>
                            <select id="origin_id"  name="origin_id" class="form-control">
                                <datalist id="citynames">
                                @foreach($origins as $origin)
                                    <option value="{{$origin->id}}"> 
                                        {{ $origin->name }}         
                                    </option>
                                @endforeach
                                </datalist>
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                    <div class="col-xs-2">
                            <label for="product_id">What *</label>
                            <select id="product_id" name="products[]" class="form-control">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}"  >                          
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                        </select>
                        </div>
                        <div class="col-xs-2">
                            <label for="comment">Qtd *</label>
                            <input type="text" class="form-control" id="qtd" name="products[]" value="0">
                        </div>
                        <div class="col-xs-2">
                            <label for="comment">Amount *</label>
                            <input type="text" class="form-control" id="amount" name="products[]"value="0"> 
                        </div>                    
                    </div>
                    <div class="form-group row ">
                        <div class="col-xs-2">
                            <label for="comment">Average *</label>
                            <input type="text" class="form-control" id="avg" name="avg" value="0">
                        </div>
                        <div class="col-xs-2">
                            <label for="comment">Max *</label>
                            <input type="text" class="form-control" id="max" name="max" value="0">
                        </div>
                        <div class="col-xs-2">
                            <label for="comment">Min *</label>
                            <input type="text" class="form-control" id="min" name="min" value="0">
                        </div>
                        <div class="col-xs-2">
                            <label for="comment">Precip *</label>
                            <input type="text" class="form-control" id="prec" name="prec" value="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-8">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" id="comment" name="comment"></textarea>
                        </div>
                    </div>
                    {{ csrf_field() }} 
            </div>
            <div class="panel-footer">
                <a href="{{ route('apphtml.index') }}" class="btn btn-primary">List</a>                            
                <button type="submit" name="save" class="btn btn-info">Save</button>                         
            </div>            
            </form>
        </div>
    </div>
@endsection
    
@push('scripts')
    <script>
        $( document ).ready(function() {
            $("#btnAddNewProduct" ).click(function() {
                alert();
                var newRow = document.getElementById("newRow");
                var input = document.createElement("input");
                input.type = "text";
                input.name = "products[]";
                newRow.appendChild(input);
            });
            
        });        
    </script>
@endpush