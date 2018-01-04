@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- Main box -->
                <div class="box-header with-border">
                    <h3 class="box-title shorter">List, Search, Edit, Delete & Add:  showing <b>{{1+(10 * ((!$page ? 1 : $page)-1))}} to {{ (10 * (!$page ? 1 : $page))>
                        $records_shown ? $records_shown : (10 * (!$page? 1 : $page))}} of {{$records_shown}} records</b></h3>
                    <div class="box-tools pull-right">
                        <div class="btn-group" role="group">
                            <a href="{{route('app.create')}}" class="btn btn-outline-primary" type="button">Add...</a>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group row">
                        <div class="form-group">
                            {{ Form::open(['route' => 'app.index', 'method' => 'GET'] )}}
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <!-- <label class="control-label sr-only">Username</label> -->
                                    <input type="text" id="index" name="query" class="form-control" placeholder="Search...." value="{{request('query')}}" />
                                    <i class="form-control-feedback glyphicon glyphicon-search"></i>
                                </div>
                            </div>
                            <div class="col-md-2"> 
                                {!! Form::checkbox(('fuzzy'), 1) !!}
                                <small>Fuzzy search</small>
                            </div>
                            <div class="col-md-4">
                                <small>
                                    <strong>Tips</strong>: 
                                        1) To search for a month/year, just type mmmyyyy as in jan2017. 
                                        2) The fuzzy search retrieves 'france' if searched as 'franxe'. 
                                        3) Searches are case insensitive.
                                        4) It searches only one word. United States will also bring United Arab Emirates.
                                </small>
                            </div>
                            {{ csrf_field() }} {!! Form::close() !!}
                        </div>
                        <!-- </div>  -->
                        <!-- ./pull-right -->
                    </div>
                        <table id="visitsDataGrid" class="table responsive">
                            <thead>  
                            <tr>
                                @foreach($aliases as $alias)
                                <th>
                                    <table>
                                        <tr>
                                            <th rowspan=2 class="table-header-text ">
                                                <!-- Plus sign    -->
                                            </th>
                                            <th rowspan=2 class="table-header-text ">
                                                {{$alias['name']}}
                                            </th>
                                    @if($alias['sortable'] )
                                            <th class="table-header-sort-icon-up">
                                                <a href="{{route('app.index')}}?sort_column={{$alias['field']}}&sort_az_za=asc&query={{$query}}&page={{$page}}">
                                                    <i class="fa fa-chevron-up"></i>
                                                </a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="table-header-sort-icon-down">
                                                <a href="{{route('app.index')}}?sort_column={{$alias['field']}}&sort_az_za=desc&query={{$query}}&page={{$page}}">
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    @endif
                                    </table>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($visits as $visit)
                        <tbody>
                            <tr id="{{$visit->id}}" data-title="ID" class="visit-id-header">
                                <td>
                                    <i data-toggle="collapse" data-flag="plus" data-target="{{'.' . $visit->id . '-td'}}" id="{{$visit->id . '-font-icon'}}"
                                        aria-expanded="false" class="glyphicon glyphicon-plus table-products-icon"></i>
                                        <span class="visit-id">
                                            {{$visit->id}}
                                        </span>
                                </td>
                                <td data-title="Date"> {{date("M-d-Y", strtotime($visit->dt)) }}</td>
                                <td data-title="Time"> {{$visit->tm }}</td>
                                <td data-title="Profile"> {{($query_type=='all'? $visit->profile_name : $visit->profile->name) }}</td>
                                <td data-title="Origin"> {{($query_type=='all'? $visit->origin_name : $visit->origin->name) }}</td>
                                <!-- <td data-title=""> {{($query_type=='all'? $visit->origin_name : $visit->origin->name) }}</td> -->
                                <td data-title="User"> {{($query_type=='all'? $visit->user_name : $visit->user->name) }}</td>
                                <td class="td-dummy align-baseline table-td-comments" data-title="Comment">
                                    <span>{{ $visit->comment }}</span>
                                </td>
                                <!-- <td data-title="Amount"> @{{ $visit->amount }}</td> -->
                                <td class="align-baseline">
                                    <a href="{{ route('app.edit', ['id' => $visit->id]) }}&page={{$page}}&query={{request('query')}}&sort_column={{request('sort_column')}}&sort_az_za={{request('sort_az_za')}}"
                                        class="btn btn btn-primary pull-right info glyphicon glyphicon-pencil                                        
                                {{ (Auth::user()->id == $visit->user_id ? null : 'disabled not-allowed')  }}" role="button">
                                    </a>
                                </td>
                            </tr>
                            <tr class="collapse {{$visit->id . '-td'}}">
                                <!-- ***** Collapsable product -->
                                <!-- <td id="{{$visit->id . '-td'}}"  -->
                                <td colspan="9" data-title="Product">
                                    <table id="{{$visit->id . '-table'}}" class="table table-hover table-products">
                                        <thead id="{{$visit->id . '-header'}}">
                                        </thead>
                                        <tbody id="{{$visit->id . '-body'}}">
                                        </tbody>
                                        <tfoot id="{{$visit->id . '-footer'}}">
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            
                <!-- ./box body> -->
                <div class="box-footer text-center">
                    {{ $visits->appends(Request::except('page'))->links() }}
                </div>
            </div>
            <!-- ./box -->
        </div>
        <!-- md12 -->
    </div>
    <!-- row -->
</div>
<!-- container -->
@endsection @push('scripts')
<script>
   
     
    $(function () {
        //Confirm deletion
        $("[data-submit-confirm-text]").click(function (e) {
            var $el = $(this);
            e.preventDefault();
            var confirmText = $el.attr('data-submit-confirm-text');
            bootbox.confirm(confirmText, function (result) {
                if (result) {
                    $el.closest('form').submit();
                }
            });
        });
    })
    $('#visitsDataGrid tr i').click(function (e) {
        // delete????
        if ($("td").hasClass("td-dummy")) {
            // will abort if the user clicks anywhere but the +/- icons
            // return
            console.log('class')
            // return
        } // delete????

        $('#visitsDataGrid tr').addClass('animated bounceOutLeft');
        console.log($("td", this).attr("class"))
        var trId;
        trId = $(this).attr('id'); // table row ID
        if (!trId) // not trId = user didn't press the edit button.
        {
            return;
        }
        tdId = trId + "-td"; // maybe delete
        tdFontIcon = trId + "-font-icon";
        tdFontIconClass = $("#" + tdFontIcon).attr('class');
        tdFontIconData = $("#" + tdFontIcon).data();
        if ($("#" + trId).data("flag") == "minus") {
            // $("#" + tdFontIcon).data("flag", 'plus');  
            $("#" + trId).toggleClass("glyphicon-plus glyphicon-minus");
            return
        }
        $("#" + trId).data("flag", 'minus');
        $("#" + trId).toggleClass("glyphicon-plus glyphicon-minus");
        url = "{{ route('visit.index')}}" + "/" + trId;
        $.ajax({
            url: url,
            method: "GET",
            contentType: "application/json",
            dataType: "json",
            success: function (response) {
                prodLength = response.products.length;
                prodQtdTotal = 0;
                prodAmountTotal = 0;
                tableHeaderContent = "<tr>";
                tableHeaderContent += " <th>Product</th>";
                tableHeaderContent += "     <th class='table-number-header'>Qtd</th>";
                tableHeaderContent += "     <th class='table-number-header'>Amount</th>";
                tableHeaderContent += "</tr>";
                tableHeaderContent += "</thead>";
                $("#" + response.data.id + "-header").append(tableHeaderContent);
                for (i = 0; i < prodLength; i++) {
                    tableBodyContent = "<tr> ";
                    tableBodyContent += "    <td>" + response.products[i].name + "</td>";
                    tableBodyContent += "    <td class='table-number-body'>" + response.products[i]
                        .pivot.qtd + "</td>";
                    tableBodyContent += "    <td class='table-number-body'>" + parseInt(response.products[
                        i].pivot.amount) + "</td>";
                    tableBodyContent += "</tr>";
                    $("#" + response.data.id + "-body").append(tableBodyContent);
                    prodQtdTotal += response.products[i].pivot.qtd;
                    prodAmountTotal = prodAmountTotal + parseFloat(response.products[i].pivot.amount);
                }
                tableFooterContent = "<tr>";
                tableFooterContent += "     <td class='table-text-footer'>Total: </td>";
                tableFooterContent += "     <td class='table-number-footer'>" + prodQtdTotal +
                    "</td>";
                tableFooterContent += "     <td class='table-number-footer'>" + prodAmountTotal +
                    "</td>";
                tableFooterContent += "</tr>";;
                $("#" + response.data.id + "-footer").append(tableFooterContent);
            },
            error: function (response) {}
        });
    });
</script>
@endpush