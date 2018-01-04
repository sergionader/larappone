@extends('layouts.master') 
@section('content')
<div class="main">

    <div class="row">
        <div class="col-md-12">
            <h1>List, Edit & Delete - Datatables</h1>   
            <p>From here you can add new vists, edit them, sort the columns, perform a global search
             (the search box at the right) and search by columns at the footer of the table.
             <br>It is also possible to expand/collapse every record to see the products under a given visit.
             </p> 
        </div>
    </div>    
     <table class="table table-striped" id="indexTable">
        <thead>
            <tr>
                <th></th>
                <th class="input-filter">ID</th>
                <th class="input-filter">Date</th>
                <th class="input-filter">Time</th>
                <th class="input-filter">Profile</th>
                <th class="input-filter">Origin</th>
                <th class="input-filter">Qtd</th>
                <th class="input-filter">Sales</th>                
                <th class="input-filter">Notes</th>
                <th class="input-filter">User</th>
                <th class="text-right"><a href="{{ route('app.create') }}" class="btn btn-success">Add</a></th>                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="non_searchable"></th>
                <th class="input-filter">ID</th>
                <th class="input-filter">Date</th>
                <th class="input-filter">Time</th>
                <th class="input-filter">Profile</th>
                <th class="input-filter">Origin</th>
                <th class="input-filter">Qtd</th>
                <th class="input-filter">Sales</th>                
                <th class="input-filter">Notes</th>
                <th class="input-filter">User</th>
                <th class="non_searchable"> </th>
            </tr>
        </tfoot>
    </table>
</div>
@stop

@push('scripts')
<script>
$(function() {
    var table = $('#indexTable').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        // buttons: [ 'copy', 'csv', 'excel' ],
        // pageLength: '10',
        
       // fixedHeader: {
       //         header: true,
       //         footer: true
       //     },
        ajax: "{!! url('datatables.visits') !!}",
        deferRender: true,
        columns: [
            {
                className:        'details-control',
                orderable:        false,
                searchable:       false,
                data:             null,
                defaultContent:   ''
            },
            { data: 'id', name: 'id'},
            { data: 'dt', name: 'dt'},
            { data: 'tm', name: 'tm'},
            { data: 'profile.name', name: 'profile.name'},
            { data: 'origin.name', name: 'origin.name'},
            { data: 'productQtdSum', name: 'productQtdSum', className: 'dt-body-right'},
            { data: 'productAmountSum', name: 'productAmountSum', className: 'dt-body-right'},
            { data: 'comment', name: 'comment'},
            { data: 'user.name', name: 'user.name'},
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-body-right'},
           
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var columnClass = column.footer().className;
                shouldShowIt= columnClass.indexOf('non_searchable');

                // console.log ("shouldShowIt  " + shouldShowIt);
		        if (shouldShowIt){
                    var input = document.createElement("input");
                    $(input).attr( 'style', 'text-align: center;width: 100%');
                    $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                }
            });
        },
        // order: [[0, 'desc']]
    });
   
    // <<EXPAND AND COLLAPSE ROWS>>
    // Add event listener for opening and closing details
    $('#indexTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'products-' + row.data().id;
        var thisID = row.data().id; 
        
        // ADDED BY SN
        var source   = $("#details-template").html();
        var template = Handlebars.compile(source);        
        //////////////
    
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row    
            row.child(template(row.data())).show();
            
            //send the id of the product to search for the product itself (/show/{id})
            initTable(tableId, thisID);
            
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

    function initTable(tableId, thisID) {
        // var apiShow = "http://0.0.0.0:3000/api/v1/visit/" + thisID;
        var apiShow = "{{ URL::to('api/v1/visit/') }}/" + thisID;
        console.log("apiShow " + apiShow)
        // url = "" 
        $('#' + tableId).DataTable({
            footerCallback: 
                function ( row, data, start, end, display ) {
                    var api = this.api(), data;
        
                    // Remove the formatting to get integer data for sum
                     var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
 
                    // Total over all pages
                    totalQtd = api
                        .column(1)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    
                    totalAmount= api
                        .column(2)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Total over this page

                    pageTotalQtd = api
                        .column(1, { page: 'current'} )
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    pageTotalAmount = api
                        .column(2, { page: 'current'} )
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column(0 ).footer()).html('Total');
                    $( api.column(1 ).footer()).html(
                        pageTotalQtd +' (of '+ totalQtd +')'
                    );
                    $( api.column(2 ).footer()).html(
                        pageTotalAmount +' (of '+ totalAmount +')'
                    );
                },
            // serverSide: true,
            ordering: false,
            fixedHeader: {
                header: true,
                footer: true
            },
            // processing: true,
            // serverSide: true,
            searching: false,  
            info: false,        
            ajax: {
                url: apiShow,
                dataSrc: 'products',
                deferRender: true
            },
            columns: [
                { data: 'name'},
                { data: 'pivot.qtd', className: 'dt-body-right'},
                { data: 'pivot.amount', className: 'dt-body-right'},
            
            ]
        })
        
    }; //</EXPAND AND COLLAPSE ROWS>
});
</script>
 <script id="details-template" type="text/x-handlebars-template">        
        <table class="table details-table" id="products-@{{id}}">
            <thead>
            <tr>
                <th>Product List</th>
                <th>Qtd</th>
                <th>Amount</th>
            </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>            
                    </tr>
                </tfoot>
        </table>
    </script>
@endpush