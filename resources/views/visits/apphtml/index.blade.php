@extends('layouts.master') 
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>List, Edit & Delete - HTML</h1> 
            
            <!-- <a href="{{route('apphtml.index')}}?sort_column=id&sort_az_za=asc"  role="button"><i class="fa fa-chevron-up"></i>Sort  ASC</a> -->
            <!-- <a href="{{route('apphtml.index')}}?sort_column=id&sort_az_za=desc"  role="button">Sort  DESC</a> -->
            <!-- 
                <p>From here you can add new vists, edit them, sort the columns, perform a global search
             (the search box at the right) and search by columns at the footer of the table.
             <br>It is also possible to expand/collapse every record to see the products under a given visit.
             </p>   
             -->
        </div>
    </div>
    <!-- <div class="row"> -->
        <!-- <div class="col-md-12"> -->
    <table class="table table-striped">    
        <thead class="cf">
            <tr>
                <th>
                    <table>
                        <tr>
                            <th rowspan=2 class="table-header-text ">
                                ID
                            </th>
                            <th class="table-header-sort-icon-up">
                                <a href="{{route('apphtml.index')}}?sort_column=id&sort_az_za=asc"><i class="fa fa-chevron-up"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th class="table-header-sort-icon-down">
                                <a href="{{route('apphtml.index')}}?sort_column=id&sort_az_za=desc"><i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </table>
                </th>
                <th>
                    <table>
                            <tr>
                                <th rowspan=2 class="table-header-text ">
                                    Date
                                </th>
                                <th class="table-header-sort-icon-up">
                                    <a href="{{route('apphtml.index')}}?sort_column=dt&sort_az_za=asc"><i class="fa fa-chevron-up"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th valign=middle class="table-header-sort-icon-down">
                                    <a href="{{route('apphtml.index')}}?sort_column=dt&sort_az_za=desc"><i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                        </table>
                </th>
                <th>
                    <table>
                        <tr>
                            <th rowspan=2 class="table-header-text ">
                                Time
                            </th>
                            <th class="table-header-sort-icon-up">
                                <a href="{{route('apphtml.index')}}?sort_column=tm&sort_az_za=asc"><i class="fa fa-chevron-up"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th valign=middle class="table-header-sort-icon-down">
                                <a href="{{route('apphtml.index')}}?sort_column=tm&sort_az_za=desc"><i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </table>
                </th>
                <th>
                <table>
                    <tr>
                        <th rowspan=2 class="table-header-text ">
                            Profile
                        </th>
                        <th class="table-header-sort-icon-up">
                                <a href="{{route('apphtml.index')}}?sort_column=profile&sort_az_za=asc"><i class="fa fa-chevron-up"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th valign=middle class="table-header-sort-icon-down">
                                <a href="{{route('apphtml.index')}}?sort_column=profile&sort_az_za=desc"><i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </table>
                </th>
                <th>
                    <table>
                        <tr>
                            <th rowspan=2 class="table-header-text ">
                            Profile
                            </th>
                        <th class="table-header-sort-icon-up">
                                <a href="{{route('apphtml.index')}}?sort_column=origin&sort_az_za=asc"><i class="fa fa-chevron-up"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th valign=middle class="table-header-sort-icon-down">
                                <a href="{{route('apphtml.index')}}?sort_column=origin&sort_az_za=desc"><i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </table>
                </th>
                <th>
                    <table>
                        <tr>
                            <th rowspan=2 class="table-header-text ">
                            User
                            </th>
                        <th class="table-header-sort-icon-up">
                                <a href="{{route('apphtml.index')}}?sort_column=user&sort_az_za=asc"><i class="fa fa-chevron-up"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th valign=middle class="table-header-sort-icon-down">
                                <a href="{{route('apphtml.index')}}?sort_column=user&sort_az_za=desc"><i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </table>
                </th>                  
                <th>
                    <table>
                        <tr  class="table-header-text-comment">
                            <th rowspan=2 >
                            Comment
                            </th>
                        <th class="table-header-sort-icon-up"> 
                                     
                            </th>
                        </tr>
                        <tr>
                            <th valign=middle class="table-header-sort-icon-down">
                                
                            </th>
                        </tr>a
                    </table>
                </th>
                <th><a href="{{ route('apphtml.new') }}" class="btn btn-success">Add</a></th>
                <th></th>
                </tr>
            </thead>
            @foreach($visits as $visit) 
            <tbody>     
                <tr>
                    <td data-title="ID">        {{$visit->id       }}</td>
                    <td data-title="Date">      {{$visit->dt       }}</td>
                    <td data-title="Time">      {{$visit->tm       }}</td>
                    <td data-title="Profile">   {{$visit->profile  }}</td>
                    <td data-title="Origin">    {{$visit->origin   }}</td>
                    <td data-title="User">      {{$visit->user     }}{{$visit->user_id }}</td>
                    
                    <!-- <td data-title="Product">  
                        <div class="align-text-top">
                        <table class="table-responsive table-striped table-condensed" id="productTable">
                            <thead style="font-size: 13px;">
                                <tr>                                        
                                    <th >Name</th>
                                    <th style="text-align:right;">Qtd</th>
                                    <th style="text-align:right;">Amount</th>   
                                </tr>        
                            </thead>
                            <tbody>  
                                <?php $totalAmount = 0?>            
                                <?php $totalQtd = 0?>            
                                    @@foreach ($visit->products as $product)
                                        <tr>
                                            <td>@{{$product->name}}</td>
                                            <td style="text-align:right;">{@{$product->pivot->qtd}}</td>
                                            <td style="text-align:right;"@{{$product->pivot->amount}}  </td>
                                        </tr>
                                        <?php $totalQtd = $totalQtd + @$product->pivot->qtd?>         
                                        <?php $totalAmount = $totalAmount + @$product->pivot->amount?>                                                                                       
                                        <br>
                                    @@endforeach
                                <tr>
                                    <td><b>Total</b></td>
                                    <td style="text-align:right;"><b><?php echo $totalQtd?></b> </td>
                                    <td style="text-align:right;"><b><?php echo number_format($totalAmount,2)?></b></td>                                           
                                </tr>
                                    <?php $totalAmount = 0?>
                                <?php $totalQtd = 0?>
                            </tbody>  
                        </table>
                        
                        </div>
                    </td>  -->
                    <!--   Product table inside <td>-->
                    <td class="align-baseline table-td-comments" data-title="Comment"><span>{{ $visit->comment }}</span></td>
                
                   
                    
                 
                    <td class="align-baseline">
                        <a href="{{ route('app.edit', ['id' => $visit->id]) }}"
                            class="btn btn-primary info glyphicon glyphicon-pencil btn-sm 
                            {{ (Auth::user()->id == $visit->user_id ? null : 'disabled')  }}"
                            role="button">
                        </a>
                    </td>                                   
                    <td class="align-baseline">
                        <a href="{{ route('apphtml.delete', ['id' => $visit->id]) }}" 
                            class="btn btn-danger info glyphicon glyphicon-remove btn-sm 
                            {{ (Auth::user()->id == $visit->user_id ? null : 'disabled')  }}"
                            role="button">
                        </a>
                    </td>                                                   
                </tr>         
            </tbody>
            @endforeach
        </table>      
        <!-- </div> -->
    <!-- </div> -->
      <div class="col-md-12 text-center">
        {{$visits->links()}}
    </div> 
</div>
@endsection

@push('scripts')
    <script>
    $(function() {
        //Confirme delete
        $("[data-submit-confirm-text]").click(function(e){
            var $el = $(this);
            e.preventDefault();
            var confirmText = $el.attr('data-submit-confirm-text');
            bootbox.confirm(confirmText, function(result) {
                if (result) {
                    $el.closest('form').submit();
                }
            });
        });
    })
    </script>
@endpush