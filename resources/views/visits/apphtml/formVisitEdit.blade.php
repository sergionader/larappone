{{--  http://www.smarttutorials.net/add-remove-table-rows-jquery/  --}}
@extends('layouts.master') 
@section('content') 
@include('partials.errors')

<div class="row">
    <div class="col-md-12 col-md-offset">
            <div class="panel panel-primary container-fluid">
                    <div class="panel-heading row">
                        <div class="col-md-5"> <strong>Data Edit - ID: {{$visit->id}}</strong></div>
                        <div class="col-md-2 text-right">
                            {!! Form::open(["route" =>["apphtml.edit", $previous], 'method' => 'get']) !!}
                                {!! Form::button('', array('type'=>'submit', 'class'=>'btn btn-records glyphicon glyphicon-triangle-left', 'id'=>'previous', 'style'=>'text-align:right')) !!}       
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::open(["route" =>["apphtml.edit", $next], 'method' => 'get']) !!}
                                {!! Form::button('', array('type'=>'submit', 'class'=>'btn btn-records glyphicon glyphicon-triangle-right', 'id'=>'next')) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
            <div class="panel-body">
                <form action="{{ route('apphtml.update') }}" method="post">
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="title">Unit *</label>
                            <input type="text" class="form-control" id="unit" name="unit" value="{{ $visit->unit}}">
                        </div>
                        <div class="col-md-2">
                            <label for="dt">Date *</label>
                            <input type="text" class="form-control" id="dt" name="dt" placeholder="mmm-dd-yyyy" value="{{$visit->dt}}">
                        </div>
                        <div class="col-md-2">
                            <label for="tm">Time (UTC) *</label>
                            <input type="text" class="form-control" id="tm" name="tm" placeholder="hh-mm" value="{{$visit->tm}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="profile_id">Type *</label>
                            <select id="profile_id" name="profile_id" class="form-control">
                                @foreach($profiles as $profile)
                                    <option value="{{$profile->id}}"
                                        @if ($profile->id == $thisProfile->id)
                                            selected> 
                                            {{ $profile->name }}
                                        @else
                                            >{{ $profile->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="origin_id">Origin *</label>
                            <select id="origin_id" name="origin_id" class="form-control">
                                @foreach($origins as $origin)
                                    <option value="{{$origin->id}}"
                                        @if ($origin->id ==$thisOrigin->id)
                                            selected> 
                                            {{ $origin->name }}
                                        @else
                                            >{{ $origin->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="origin_id">What</label>
                        </div>    
                        <div class="col-md-8 myTable">
                            <table class="table" id="productTable">
                                <thead style="font-size: 13px;">
                                    <tr>
                                        <th><input class='checkAll' type='checkbox'/></th>
                                        <th >Name *</th>
                                        <th >Qtd *</th>
                                        <th >Amount *</th>
                                        <th>                                            
                                            <button id="btnAddNewProduct" type="button" name="add" class="btn btn-primary addProduct">
                                                 <span class="glyphicon glyphicon-plus" ></span>
                                            </button>
                                        </th>
                                        <th> 
                                            <button id="btnRemoveProduct" type="button" name="add" class="btn btn-danger removeProduct {{$visit->$toggle_disable }}">
                                                 <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </th>  
                                    </tr>        
                                </thead>
                                <tbody>     
                                @foreach ($visit->products as $product)
                                    <tr>
                                        <td class="col-md-1"><input type='checkbox' class='case'/></td>
                                        <td class="col-md-5"><div class = "input-group" id="what">                                                                                       
                                            <select id="product_id{{$product->id}}" name="products[]" class="selectpicker loadedSelect form-control" data-width="auto">
                                                @foreach($productList as $productinner)
                                                    <option value="{{$productinner->id}}" 
                                                        @if ($productinner->id == $product->id)
                                                            selected> 
                                                            {{$productinner->name}}         
                                                        @else
                                                            >{{$productinner->name}}
                                                        @endif                                                            
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> </td>
                                        <td class="col-md-2"><input type="text" style="text-align:right;" class="form-control sm" id="qtd" name="products[]" placeholder="0" value="{{$product->pivot->qtd}}"></td>
                                        <td class="col-md-2"><input type="text" style="text-align:right;" class="form-control sm" id="amount" name="products[]" placeholder="0" value="{{$product->pivot->amount}}"></td>                                                                                         
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach                                      
                             </tbody>       
                            </table> 
                        </div> 
                    </div>                            
                    <div class="form-group row ">
                        <div class="col-md-2">
                            <label for="comment">Average *</label>
                            <input type="text" class="form-control" id="avg" name="avg" value="{{$visit->avg}}">
                        </div>
                        <div class="col-md-2">
                            <label for="comment">Max *</label>
                            <input type="text" class="form-control" id="max" name="max" value="{{$visit->max}}">
                        </div>
                        <div class="col-md-2">
                            <label for="comment">Min *</label>
                            <input type="text" class="form-control" id="min" name="min" value="{{$visit->min}}">
                        </div>
                        <div class="col-md-2">
                            <label for="comment">Precip *</label>
                            <input type="text" class="form-control" id="prec" name="prec" value="{{$visit->prec}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="comment">Comment</label>
                            <textarea rows="3" class="form-control" id="comment" name="comment">{{$visit->comment}}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$visit_id}}">      
                    
                </div> {{--  panel body  --}}
                <div class="panel-footer">
                        
                    <a href="{{ route('apphtml.index') }}&page1={{$page}}&query={{request('query')}}&sort_column={{request('sort_column')}}&sort_az_za={{request('sort_az_za')}}" class="btn btn-primary">List</a>                            
                    <button type="submit" name="save" class="btn btn-info ">Save</button>                          
                    <a href="{{ route('apphtml.new') }}" class="btn btn-success">New</a>                          
                    <button type="button" onclick="location.href = '{{ route('apphtml.delete', ['id' => $visit->id]) }}';" 
                        name="delete" class="btn btn-danger ">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $( document ).ready(function() {
            if("{{!! $isnew[1] !!}}"!="{1}"){ //if not a new record, don't let it be changed
                $(".loadedSelect").on('mousedown', function(e){  
                // Block selects to not allow the user to change the product when editing. 
                // If the name is wrong, then delete and add it again
                // the class name "loadedSelect" only occurs for the oaded records from the controler.
                // Thus, it will not affect the new selects until they are saved.
                // Note: disabling the selects won't work, as they will not be passed
                // with the products[] array to the controller                
                    alert("If you need to change the product, delete it and add a new one");                
                    e.preventDefault();
                });
                $(".loadedSelect").on('keydown', function(e){  
                    // See <<$(".loadedSelect").on('mousedown', function(e){>>
                    // this is it prevent selection using the keyboard arrows. 
                    alert("If you need to change the product, delete it and add a new one");
                    if (e.keyCode >= 0  && e.keyCode <= 255) 
                        {
                            e.returnValue=false;
                            e.cancel = true;
                        }
                }) 
            }
            $(".checkAll").change(function(){
                var status = $(this).is(":checked") ? true : false;
                $(".case").prop("checked",status);
            }); 
            $(".removeProduct").on('click', function() {
                // Let's see if there is something to be deleted:
                var isAnyChecked = "";
                $(':checkbox').each(function() {
                    isAnyChecked += this.checked ? "1," : "0,";                   
                });               
                isAnyChecked= isAnyChecked.indexOf('1') !== -1;
                var table = document.getElementById("productTable").tBodies[0];
                var rowCount = table.rows.length;                                           
                if(rowCount==0 || isAnyChecked == false){ // nothing to delete                                       
                    $.blockUI({
                        message:   '<h2>There are no products to delete.</h2>', 
                        css: { 
                            border: 'none', 
                            padding: '10px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff'}                   
                    });
                    setTimeout($.unblockUI, 2000);
                    return
                }
                var areYouSureDelete = confirm("Are you sure? This will be done even if you don't press the save button.");
                if (areYouSureDelete == false) {
                    return;
                }
                $.blockUI({ 
                    message:  '<h2>Deleting. <br>Please wait...</h2>',
                        css: { 
                        border: 'none', 
                        padding: '10px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                        } 
                    }); 

                //  to get the id of the products that will be delete.                
                //  var i=1 to start after header
                for(var i=0; i<rowCount; i++) {
                    var row = table.rows[i];
                    // index of td that contains checkbox is 0; product id is 1
                    var chkbox    = row.cells[0].getElementsByTagName('input')[0];
                    var rowSelect = row.cells[1].getElementsByTagName('select')[0];
                    console.log("--------------------");
                    console.log('i= ' +  i);
                    console.log('productID ' + productID);   
                    console.log("chkbox " + JSON.stringify(chkbox));
                    console.log("rowSelect " + JSON.stringify(rowSelect));
                    console.log ("chkbox.type " + chkbox.type);
                    console.log ("chkbox.checked " + chkbox.type);
                    console.log ("visit id " + {{$visit->id}})
                    productID     = rowSelect.id;
                    if('checkbox' == chkbox.type && true == chkbox.checked) {
                  
                        //table.deleteRow(i);
                        if (productID.indexOf("_")>-1){
                            // if it has _ it's because it has been loaded and therefore
                            // came from the database (otherwise, it's new and can't be deleted
                            // from the database)
                            var productID = productID.substring(10,productID.length).trim();
                            console.log('new productID ' + productID);
                           
                            url = "http://0.0.0.0:3000/apphtml/deleteproduct/";                            
                            $.ajax({
                                type: "get",
                                url: url,
                                data: {
                                    visit_id: {{$visit->id}},
                                    product_id: productID
                                },
                                success: function(response){ // What to do if we succeed
                                    {{--  alert("Product was deleted.");    --}}
                                    $.unblockUI();  
                                },
                                error: function(response){
                                    $.unblockUI();
                                    alert('Error '+JSON.stringify(response));
                                }
                            });
                        
                        }// if('checkbox' == chkbox.type && true == chkbox.checked) {
                    }
                }
	            $('.case:checkbox:checked').parents("tr").remove();
                $('.checkAll').prop("checked", false); 
                $.unblockUI();  
                
               //  $(".removeProduct").on('click', function() {
            });

            var i=0;
            $(".addProduct").on('click',function(){
                //var newSelect =  addDropDownList("product_id", "products[]", [2,3,4], "#newProductID");
                //console.log(newSelect) 
                count=$('table tr').length;
                var data="<tr><td><input type='checkbox' class='case'/></td>";  
                //data +=newSelect;              
                {{--  dd = addDropDownList("products[]", "productid", {{$productList->name}}, "dummy");  --}}
                {{--  console.log("dd " + JSON.stringify(dd));  --}}
                data +="<td><select id='productid' name='products[]'";
                data +="class='selectpicker form-control' data-width='auto'>";
                data +="@foreach($productList as $productinner)";
                data +="    <option value='{{$productinner->id}}'"; 
                data +="            >{{$productinner->name}}";
                data +="   </option>";
                data +="@endforeach";
                data +="</select></td>";
                data +="<td><input type='text' style='text-align:right;' class='form-control sm' id='qtd' name='products[]' placeholder='0' value='0'></td>";
                data +="<td><input type='text' style='text-align:right;' class='form-control sm' id='amount' name='products[]' placeholder='0' value='0'></td>";       
                data +="</tr>";
                $('table').append(data);
                i++;
            });
           // $('th').on('click', 'button', function(e){
             //e.preventDefault();
            //$(".btnAddNewProduct").hide();
             //$(this).remove();
            
            $("#newCheckBox").append("<input type='checkbox' class='case'/>");

            function addDropDownList(name, id, optionList, selector) {
                var combo = $("<select></select>")                
                    .attr("name", name)
                    .attr("id", id)
                    .attr("class",     "selectpicker form-control")
                    .attr("data-width","auto");
                $.each(optionList, function (i, el) {
                    combo.append("<option>" + el + "</option>");
                });
                return combo;
                //$(selector).append(combo);
            }
           
        });        
    </script>
@endpush