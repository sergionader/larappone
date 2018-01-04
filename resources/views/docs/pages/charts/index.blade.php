@extends('layouts.master') 

@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Charts</h1>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">USD Monthly Sales by Type - Stacked Column</h2>
                </div>
                <div class="box-body">
                    <div class="col-md-9">
                        <ul class="list-group">
                            <li class="list-group-item">
                                It shows sales by month and subdivides it by profile (Couple, Family, Gentlemen, Ladies)
                                in each column, showing how much each type represents for each column as well as the column total
                                at its top. 
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="text-right">
                            <a class="btn btn-primary" href="{{route('charts.chartloader')}}" role="button">See the live chart</a>
                        </p>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img class="img-responsive" src="/img/charts/stacked_chart.png" alt="column chart">
                            </li>
                            <li class="list-group-item">
                               
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>1 - Type</strong>: chart selection.</li>
                            <li class="list-group-item"><strong>2 - Date</strong>: the date range selection, using <a href="{{route('docs.pages.crud.daterange')}}" class="doc-link">Date Range Picker</a> control.</li>
                            <li class="list-group-item"><strong>3 - Filter Button</strong>: as the name says.</li>
                            <li class="list-group-item"><strong>4 - Chart Title</strong>: chart title.</li>
                            <li class="list-group-item"><strong>5 - Dynamic Total</strong>: as you toggle the profiles, the total is updated.</li>
                            <li class="list-group-item"><strong>6 - Date Range</strong>: The date range select on item 2 - it is useful if the user copies the
                                resulting chart to paste somewhere else.</li>
                            <li class="list-group-item"><strong>7 - Dynamic Legends</strong>: clicking on the profiles (couple, family, etc) toggles the data on the chart.</li>
                        </ul>
                        <div class="col-md-8">
                                @include('partials.cool-feature')
                                    <p> Hovering the mouse over the columns shows the month total and profile total for that month.
                                </div>

                                <!-- @include('partials.cool-feature')<strong>Cool Feature!</strong>:  -->
                            </div>
                            <div class="col-md-4">
                                <img class="img-responsive" src="/img/charts/stacked-tooltip.png" alt="column chart">
                            </div>
                    </div>
                </div>                
            </div><!-- END panel body -->

            
            <!-- panel body -->       
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Donut Drilldow - USD Sales %  by Type and Subtype </h2>
                </div>
                <div class="box-body">
                    <div class="col-md-9">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p>It shows sales by type - 
                                    <i>Couple, Family, Gentlemen and Ladies</i> - and types -
                                    <i>Middle Age, Senior, Young</i> with a date filter.

                                <br>For "Family" the subtype is "All".</p>
                               @include('partials.cool-feature') if you click on any of the types it will show the products sold by type and subtypes.
                                </div>
                               
                               <!-- <p><strong>Note</strong>: type and subtype are subsets of the profile entity</p> -->
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="text-right">
                            <a class="btn btn-primary" href="{{route('charts.chartloader')}}" role="button">See the live chart</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img class="img-responsive" src="/img/charts/drill_down.png" alt="donut drilldown 1">
                                <p class="text-center">
                                    <small>The user clicked on the "Gentlemen" inner portion and...</small>
                                    <br>
                                    <br>
                                </p>
                            </li>
                        </ul>   
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img class="img-responsive" src="/img/charts/drill_down_inner.png" alt="donut drill down 1">
                                <p class="text-center">
                                    <small>... now it shows not only the subtype distribution but the products that it each subtype contains. It also shows a "Back" button.</small>
                                </p>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <!-- END panel body -->

    
        <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Map - USD Sales by Regions</h2>
                </div>
                <div class="box-body">
                    <div class="col-md-9">
                        <ul class="list-group">
                            <li class="list-group-item">
                                It shows sales by month in a geo format. 
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="text-right">
                            <a class="btn btn-primary" href="{{route('charts.chartloader')}}" role="button">See the live chart</a>
                        </p>
                    </div>
                    <div class="col-md-9">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img class="img-responsive" src="/img/charts/map.png" alt="column chart">
                            </li>
                            <!-- <li class="list-group-item">
                            
                            </li> -->
                        </ul>
                    </div>                   
                </div>                
            </div><!-- END panel body -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Area - Number of Visits vs. Sales</h2>
                </div>
                <div class="box-body">
                    <div class="col-md-9">
                        <ul class="list-group">
                            <li class="list-group-item">
                                It shows visits and sales by date range.
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="text-right">
                            <a class="btn btn-primary" href="{{route('charts.chartloader')}}" role="button">See the live chart</a>
                        </p>
                    </div>
                    <div class="col-md-9">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img class="img-responsive" src="/img/charts/area_chart.png" alt="column chart">
                            </li>
                            <li class="list-group-item">
                            
                            </li>
                        </ul>
                    </div>
                </div>                
            </div><!-- END panel body -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title" id="tnCharts">Technical Notes</h2>
                </div>
                <div class="box-body">
                    <p> For rendering the charts it uses <a href="https://www.highcharts.com/" target="_blank">HighCharts</a>. 
                        I tried to keep all the processing on the server side delivering the 
                        dataset as ready as possible to the client to minimize keeping the data logic 
                        in two places - the ChartController controller takes care of it. </p>
                        <p> Some of the selects uses the DB::select class/method as shown below while some uses a more Eloquent syntax. All of them are to be migrated to the Eloquent standart.
                        </b>
                        <pre><code class="php">
    $sql_sales_by_month=  DB::select("
    SELECT
        DATE_FORMAT(visits.dt, '%m') AS month_idx,
        DATE_FORMAT(visits.dt, '%b') AS month,
        DATE_FORMAT(visits.dt, '%Y') AS year,
        ROUND(sum(product_visit.amount)) AS y
    FROM  visits, product_visit
    WHERE 
        visits.id = product_visit.visit_id
        AND product_visit.amount>0
        AND (visits.dt between '$dt_start' and '$dt_end')
    GROUP BY month_idx, month, year
    ORDER BY year desc, month_idx desc ;
    ");
                        </code></pre>
                        As for the Javascript, the  <a href="{{route('charts.chartloader')}}" 
                        target="_blank"><strong>Column Chart</strong></a> illustrates what happens after making an ajax call:
                        <pre><code class="javascript">
    $.ajax({
        url: url,
        method: "post",
        contentType: 'application/json',
        data: JSON.stringify({
            dt_start,
            dt_end
            }),
        success: function (response) {   
            response    = JSON.parse(response);   
            categories  = response.categories;
            data        = response.data                
                            </code></pre>
                            The variables categories, that holds the months within the date range, and data, that holds the sales for each month, 
                            are set are then passed directly to the chart options.xAxis and options.Series:
                            <pre><code class="javascript">
    options = {...
        xAxis: {
            categories: <strong>categories</strong>
           .....
                            </code></pre> and
                            <pre><code class="javascript">
            ...
            series: [{
                name: 'Sales',
                data: <strong>data</strong>
                            </code></pre>
                            This prevents the view for processing data that has already been processed by the controller. 
                            <br> 
                        </p>
                    </div>
                </div> <!-- END panel body -->
            </div>
        </div>
    </div>
</div>
@endsection