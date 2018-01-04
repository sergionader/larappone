@extends('layouts.master') 
@section('content') 
@include('partials.errors') 
<div class="main">
    <div class="row">
        <div class="col-xs-12">  
            <div class="box box-primary"> <!-- Main box -->
                <div class="box-header with-border">
                    <h3 class="box-title">Data Edit - ID: {{$visit->id}}</h3>
                    <div class="box-tools pull-right">
                        <div class="btn-group" role="group">
                            <a href="{{ route('app.edit',$previous)}}" class="btn btn-outline-primary glyphicon glyphicon-triangle-left" type="button"></a>
                            <a href="{{ route('app.edit',$next)}}" class="btn btn-outline-primary glyphicon glyphicon-triangle-right" type="button"></a>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['route' => ['app.update', 'id'=>"$visit->id"], 'method' => 'post']) !!}
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('Unit *') !!} 
                            {!! Form::text('unit', $visit->unit, ['required', 'class'=>'form-control', 'id'=>'unit', 'placeholder'=>'AB'])!!}                                
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('Date *') !!}
                            {!! Form::text('dt', $visit->dt, array('required', 'id'=>'dt', 'class'=>'form-control', 'placeholder'=>'mm/dd/yyyy'))!!}
                        </div>
                        <div class="col-md-2">                                
                            <div class="input-group bootstrap-timepicker timepicker">  
                                {!! Form::label('Time *') !!}
                                {!! Form::text('tm', $visit->tm, array('required', 'id'=>'tm', 'class'=>'form-control', 'placeholder'=>'hh:mm'))!!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('Profile *') !!}
                            {{Form::select('profile_id', $profiles, $visit->profile_id, array('required',  'id'=>'profile_id', 'class'=>'form-control'))}}
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('Origin *') !!}
                            {{Form::select('origin_id', $origins, $visit->origin_id, array('required',  'id'=>'origin_id', 'class'=>'form-control') )}}
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('Created By') !!} 
                            {!! Form::text('', $this_user->name . " (".$this_user->id. ")", array('required', 'disabled'=> true, 'class'=>'form-control', 'id'=>'unit', 'placeholder'=>'XX')) !!}
                        </div>
                    </div>
                    <div class="box box">
                        <div class="box-header with-border">
                            <div class="col-xs-10">
                                    <h3 class="box-title">Products</h3>
                                </div>
                            <div class="pull-right">
                                <button id="btnAddNewProduct" type="button" name="add" class="btn btn-outline-primary btn-add">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                <button id="btnRemoveProduct" type="button" name="remove" class="btn btn-outline-danger btn-delete">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                </button>
                                <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->   
                            </div> <!-- /pull right -->
                        </div> <!-- /.box-header -->
                        <div class="box-body">  
                            <div class="col-xs-12 myTable">
                                <table class="table" id="productTable">
                                    <thead style="font-size: 13px;">
                                        <tr>
                                            <th style="width: 10%"><input class='checkAll' type='checkbox'/></th>
                                            <th style="width: 50%">Name *</th>
                                            <th style="width: 20%">Qtd *</th>
                                            <th style="width: 20%">Amount *</th>
                                        </tr>        
                                    </thead>
                                    <tbody>                                           
                                        @foreach ($productsPivot as $productPivot)
                                            <tr>  
                                                <td class="col-xs-1"><input type='checkbox' class='case'/></td>
                                                <td>                                            
                                                    {{Form::select('products[]', $products, $productPivot->id, array('required', 'id'=>'productid'.$productPivot->id, 'class'=>'form-control loadedSelect') )}}       
                                                </td>
                                                <td> 
                                                    {!! Form::text('products[]', $productPivot->pivot->qtd, array('required', 'class'=>'form-control', 'placeholder'=>'0', 'style'=>'text-align:right'))
                                                    !!}
                                                </td>
                                                <td>
                                                    {!! Form::text('products[]', $productPivot->pivot->amount, array('required', 'class'=>'form-control', 'placeholder'=>'0.00', 'style'=>'text-align:right'))                                                
                                                    !!}
                                                </td>
                                            </tr>
                                        @endforeach                                                                            
                                    </tbody>       
                                </table> 
                            </div>     <!-- ./ myTable -->      
                        </div>  <!-- /.box-body -->
                    </div> <!-- /.PRODUCT box -->     
                    <div class="form-group row ">
                        <div class="col-md-3 card-temperature">  
                            <div class="card">
                                <h3 class="cart-title">Wheater (&#8457;)</h3>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('Average *') !!} 
                                        {!! Form::text('avg', $visit->avg, array('required', 'class'=>'form-control', 'placeholder'=>'Farenheit Temp'))
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Max *') !!} 
                                        {!! Form::text('max', $visit->max, array('required', 'class'=>'form-control', 'placeholder'=>'0'))
                                        !!}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('Min *') !!} 
                                        {!! Form::text('min', $visit->min, array('required', 'class'=>'form-control', 'placeholder'=>'0'))
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Precip *') !!} 
                                        {!! Form::text('prec', $visit->prec, array('required', 'class'=>'form-control', 'placeholder'=>'0'))
                                        !!}
                                    </div>
                                </div>
                            </div>  <!-- card -->  
                        </div>  <!-- col-md-3 -->  
                        <div class="col-md-8">
                            <div class="form-group">
                                {!! Form::label('Comment') !!} 
                                {!! Form::textarea('comment', $visit->comment, array( 'class'=>'form-control', 'placeholder'=>'Your comments and notes', 'rows' => 5)) !!}
                            </div>
                        </div> 
                    </div>   <!-- /.form-group row  AVG TO COMMENT--> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('app.index')}}?page={{request('page')}}&sort_column={{request('sort_column')}}&sort_az_za={{request('sort_column')}}
                    " class="btn btn-primary">List</a>
                    <a href="{{ route('app.create') }}" class="btn btn-success">Add</a>
                    @if(!Gate::denies('visit-update-delete', $visit))
                        {!! Form::submit('Update', array('class'=>'btn btn-info', 'id'=>'submit-update')) !!}
                    @endif
                    {!! Form::close() !!}
                    @if(!Gate::denies('visit-update-delete', $visit))                               
                            <button id="submit-delete" class='btn btn-danger'>Delete</button>
                    @endif

                </div> <!-- box footer -->
            </div> <!-- /.box - Main Box-->
        </div> <!-- col-xs-12 -->
    </div> <!-- row -->
</div> <!-- main -->

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
     // ************************************* 
        //      disable previous if first
        //      disable next if last
        // *************************************
        var navPrevious = '{{$previous}}';
        var navNext = '{{$next}}';

        if (!navPrevious) {
            $("#previous").attr('disabled', true);
        } else {
            $("#previous").attr('disabled', false);
        }

        if (!navNext) {
            $("#next").attr('disabled', true);
        } else {
            $("#next").attr('disabled', false);
        }
        // END 
  
        if ("{{!! $isnew[0] !!}}" != "1") { //if not a new record, don't let it be changed
            $(".loadedSelect").on('mousedown', function (e) {
                // Block selects to not allow the user to change the product when editing. 
                // If the name is wrong, then delete and add it again
                // the class name "loadedSelect" only occurs for the records  added from the controler.
                // Thus, it will not affect the new selects until they are saved.
                // Note: disabling the selects won't work, as they will not be passed
                // with the products[] array to the controller                
                BootstrapDialog.show({
                    title: 'Your attention, please',
                    type: BootstrapDialog.TYPE_WARNING,
                    buttons: [{
                        label: 'Close',
                        action: function (dialogRef) {
                            dialogRef.close();
                        }
                    }],
                    message: 'If you need to change the product, delete it and add a new one.'
                });
                e.preventDefault();
            });
            $(".loadedSelect").on('keydown', function (e) {
                // See <<$(".loadedSelect").on('mousedown', function(e){>>
                // this is it prevent selection using the keyboard arrows. 
                BootstrapDialog.show({
                    title: 'Your attention, please',
                    type: BootstrapDialog.TYPE_WARNING,
                    buttons: [{
                        label: 'Close',
                        action: function (dialogRef) {
                            dialogRef.close();
                        }
                    }],
                    message: 'If you need to change the product, delete it and add a new one.'
                });
                if (e.keyCode >= 0 && e.keyCode <= 255) {
                    e.returnValue = false;
                    e.cancel = true;
                }
            })
        }
        $(".checkAll").change(function () {
            var status = $(this).is(":checked") ? true : false;
            $(".case").prop("checked", status);
        }); {
            {
                // --TODELETE--
            }
        }
        $("#submit-updateXXX").on('click', function (e) {
            e.preventDefault()
            var newProductsArray = [];
            var ProductsArray = $("[name='products[]']").map(function () {
                return $(this).val();
            }).get();
            var countProductsArray = ProductsArray.length
            //console.log ('ProductsArray  ' +  ProductsArray)
            //console.log('countProductsArray ' +  typeof(ProductsArray)  +  " "  + countProductsArray)

            newRecord = 3;
            var productID;
            // Let's loop ProductsArray (it is always an array like [x, y, z, etc])
            $.each(ProductsArray, function (i, productID) {
                //console.log( "Index #" + i + ": " + l );
                // if the remainder is 0, the it's multiple od newRecord (3)
                if ((i % newRecord) == 0) {
                    if (productID != fakeProduct_id) { // = 36 = please choose
                        newProductsArray.push(productID);
                    }
                    console.log("productID " + productID);
                }
            });
            console.log('newProductsArray ' + newProductsArray)
            // solution
            const checkDuplicate = list => {
                var hasDuplicate = false;
                list.sort().sort((a, b) => {
                    if (a === b) hasDuplicate = true
                })
                return hasDuplicate
            }
            console.log("checkDuplicate " + checkDuplicate(newProductsArray))
            if (checkDuplicate(newProductsArray)) {
                BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_WARNING,
                    title: 'Your attention, please.',
                    buttons: [{
                        label: 'Close',
                        action: function (dialogRef) {
                            dialogRef.close();
                        }
                    }],
                    message: 'You cannot add the same product more than once. Please replace the duplicated one or remove it by setting it to  "Please choose....".'
                });
                return;
            } //if(checkDuplicate)
            // update
            url = "{{ route('visit.index') . $visit->id }}"
            console.log("url " + url)

            // 
            unit = $("[name='unit'").val();
            dt = $("[name='dt'").val();
            tm = $("[name='tm'").val();
            profile_id = $("[name='profile_id'").val();
            origin_id = $("[name='origin_id'").val();
            products0 = $("[name='products[]'").val();
            products1 = $("[name='products[1]'").val();
            products2 = $("[name='products[2]'").val();
            avg = $("[name='avg'").val();
            min = $("[name='min'").val();
            max = $("[name='max'").val();
            prec = $("[name='prec'").val(); 
            $.ajax({
                url: url,
                method: "PUT",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    "unit": unit,
                    "dt": dt,
                    "tm": tm,
                    "profile_id": profile_id,
                    "origin_id": origin_id,
                    "products": ProductsArray,
                    "avg": avg,
                    "max": max,
                    "min": min,
                    "prec": prec
                }),
                success: function(response){                                    
                    BootstrapDialog.show({
                        title: 'Success', 
                        type: BootstrapDialog.TYPE_SUCCESS,
                        message: 'Updated.',
                        buttons: [{
                            label: 'Close',
                            action: function(dialogRef){                                
                                dialogRef.close();
                                window.location = "{{ route('app.index')}}" + "{{$visit->id}}" + "/edit/"
                                },  
                            }],                                                
                        });
                    }, 
                error: function (response) {
                    BootstrapDialog.show({
                        title: "Your attention, please",
                        type: BootstrapDialog.TYPE_WARNING,
                        buttons: [{
                            label: 'Close',
                            action: function (dialogRef) {
                                dialogRef.close();
                            }
                        }],
                        message: 'There was an error: ' + JSON.stringify(response)
                    });
                }
            }); // ends ajax
        }); // update button
        // To remove one or more products
        $("#btnRemoveProduct").on('click', function () {
            // Let's see if there is something to be deleted:
            var isAnyChecked = "";
            $(':checkbox').each(function () {
                isAnyChecked += this.checked ? "1," : "0,";
            });
            isAnyChecked = isAnyChecked.indexOf('1') !== -1;
            var table = document.getElementById("productTable").tBodies[0];
            var rowCount = table.rows.length;
            //console.log ("rowCount " + rowCount);                                      
            if (rowCount == 0 || isAnyChecked == false) { // nothing to delete                     
                BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_WARNING,
                    title: 'Your attention, please.',
                    buttons: [{
                        label: 'Close',
                        action: function (dialogRef) {
                            dialogRef.close();
                        }
                    }],
                    message: 'Either no product was select or there is no product saved to this visit.'
                });
                return;
            }
            //<<CONFIRM PRODUCT DELETE>>         
            BootstrapDialog.confirm({
                message: 'Once deleted, you will not be able to recover it! Are you sure?',
                type: BootstrapDialog.TYPE_DANGER,
                title: 'Product Delete',
                autospin: true,
                closable: true,
                btnCancelLabel: 'Cancel',
                btnOKLabel: 'Delete',
                callback: function (result) {
                    if (result) {
                        // to get the id of the products that will be delete.                
                        //var i=0 to start after header
                        var args = "";
                        for (var i = 0; i < rowCount; i++) {
                            var row = table.rows[i];
                            // index of td that contains checkbox is 0; product id is 1
                            var chkbox = row.cells[0].getElementsByTagName('input')[0];
                            var rowSelect = row.cells[1].getElementsByTagName('select')[0];
                            productID = rowSelect.id;
                            if ('checkbox' == chkbox.type && true == chkbox.checked) {
                                //table.deleteRow(i);                               
                                if (productID.includes("_") == false) {
                                    // if it has _ it's because it has been add but not save yet and therefore
                                    // came from the database (otherwise, it's new and can't be deleted
                                    // from the database)
                                    var productID = productID.substring(9, productID.length).trim();
                                    args = args + "product_id[]=" + productID + "&";
                                } // if('checkbox' == chkbox.type && true == chkbox.checked) {                            
                                // if no error, then show the success dialog.                                             
                            }
                        }
                        
                    console.log ("args: " + args)
                        route = "{{route('app.product.visit.destroy', ['id'=>$visit->id])}}"
                        url = route + '?'+ args;
                        $.ajax({
                            url: url,
                            method: "get",
                            contentType: 'application/json',
                            success: function (response) { // What to do if we succeed                                                                            
                                BootstrapDialog.show({
                                    title: 'Success',
                                    type: BootstrapDialog.TYPE_SUCCESS,
                                    message: 'Deleted.',
                                    buttons: [{
                                        label: 'Close',
                                        action: function (dialogRef) {
                                            dialogRef.close();
                                        }
                                    }],
                                });
                            },
                            error: function (response) {
                                BootstrapDialog.show({
                                    title: "Your attention, please",
                                    type: BootstrapDialog.TYPE_WARNING,
                                    buttons: [{
                                        label: 'Close',
                                        action: function (dialogRef) {
                                            dialogRef.close();
                                        }
                                    }],
                                    message: 'There was an error: ' + JSON.stringify(response)
                                });
                            }
                        });
                        $('.case:checkbox:checked').parents("tr").remove();
                        $('.checkAll').prop("checked", false);
                    } else {                        
                        // if user cancels the deletion. 
                        return
                           }

                }
            }) // <</CONFIRM PRODUCT DELETE>> 
        }); // END $(".removeProduct").on('click', function() {                  

        var i = 0;
        $("#btnAddNewProduct").on('click', function () {
            var table = document.getElementById("productTable").tBodies[0];
            count = $('table tr').length;
            data = '   <tr>';
            data += '       <td class="col-md-1"><input type="checkbox" class="case"/></td>';
            data += '       <td>';
            data += '           {{Form::select("products[]", $products, "' + fakeProduct_id + '", array("required", "id"=>"product_id", "class"=>"form-control"))}}';
            data += '       </td>';
            data += '       <td>';
            data += '           {{Form::text("products[]", "0", array("required", "id"=>"qtd", "class"=>"form-control", "placeholder"=>"0", "style"=>"text-align:right"))}}';
            data += '       </td>';
            data += '       <td>';
            data += '           {{Form::text("products[]", "0", array("required", "style"=> "text-align:right", "class"=>"form-control", "placeholder"=>"0.00"))}}';
            data += '       </td>';
            data += '       <td></td>';
            data += '       <td class="text-danger"><small>not saved</small></td>';
            data += '  </tr>';
            $(table).append(data);
            i++;
        }); //addProduct



        // Confirm visit deletion. The reason for using an ajax call is to be able to present
        // the confirmation dialog
        // It could be done only by calling ../app/destroy/{id} and then return the message with
        // ->with->info("Deleted!")
        $("#submit-delete").on("click", function (e) {
            e.preventDefault();
            BootstrapDialog.confirm({
                message: 'Once deleted, you will not be able to recover it! Are you sure?',
                type: BootstrapDialog.TYPE_DANGER,
                title: 'Visit Delete',
                autospin: true,
                closable: true,
                btnCancelLabel: 'Cancel',
                btnOKLabel: 'Delete',
                callback: function (result) {
                    if (result) {
                        url = "{{ route('app.destroy', ['id'=>$visit->id])}}"
                        console.log( url)
                        // url = "{{ route('visit.index') . $visit->id }}"
                        // url = visitApiUrl + "{{$visit->id}}";
                        console.log("{{$visit->id}}")
                        console.log("url " + url)
                        $.ajax({
                            url: url,
                            method: 'get',
                            contentType: 'application/json',
                            headers: {
                                'Accept': 'application/json' //prevents from loading the index (what makes it to execute /edit with the DELETE header)
                            },
                            success: function (response) { // What to do if we succeed
                                BootstrapDialog.show({
                                    title: 'Success',
                                    type: BootstrapDialog.TYPE_SUCCESS,
                                    message: 'Visit deleted.',
                                    buttons: [{
                                        label: 'Close',
                                        action: function (dialogRef) {
                                            window.location = "{{ route('app.index')}}";
                                            dialogRef.close();
                                        }
                                    }],
                                });
                                return;
                            },
                            error: function (response) {
                                BootstrapDialog.show({
                                    title: "Your attention, please",
                                    type: BootstrapDialog.TYPE_WARNING,
                                    buttons: [{
                                        label: 'Close',
                                        action: function (dialogRef) {
                                            dialogRef.close();
                                        }
                                    }],
                                    message: 'There was an error: ' + JSON.stringify(response)
                                });
                                // window.location = "{{ route('app.index')}}";
                                return;
                            }
                        });
                    } else {
                        // if user cancels the deletion.                    
                        return;
                    }
                }
            });
        });
    });
</script>
@endpush