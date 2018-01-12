@extends('layouts.master')
@section('content') 
@include('partials.errors')
@include('dashboard.partials.upperboxes')

<!-- HighCharts  -->   
<script src="{{URL::to('vendor/highchart/js/highcharts.src.js')}}"></script>
<!-- Google Charts  Maps -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<div class="main">
@if(Session::has("fail"))
    <div class = "alert alert-danger">
        {{Session::get('fail')}}
    </div>
@endif
@if(Auth::user())
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3 id="visits"></h3>
                      <p>Visits</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-6 col-xs-12">
                <div class="small-box bg-green">
                    <div class="inner">
                      <h3 id="sales"></h3>
                      <p>Sales Today</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12">                
                <div class="small-box bg-teal">
                    <div class="inner">
                      <h3 id="rate"></h3>
                      <p>Conversion %</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-social-usd"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <div class="small-box bg-blue">
                    <div class="inner">
                      <h3 id="thismonthrate"></h3>
                      <p>This Month %</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <div class="small-box bg-orange">
                    <div class="inner">
                      <h3 id="lastmonthrate"></h3>
                      <p>This Mo Lst Yr %</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-calendar-minus-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12">                
                <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3 id="thismonthlastyearrate"></h3>
                      <p>This Mo Lst Yr %</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-calendar"></i>
                    </div>
                </div>
            </div>           
        </div>
        <!-- CHARTS -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Number of Visits vs. Sales</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <!-- AREA -->
                    <div class="box-body">
                        <div class="box-body">
                            <div class="chart" id="chartArea" style="height:400px;">
                                    @include('visits.charts.partials.chartscripts')
                                Loading chart...              
                            </div>  
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">USD Sales by Regions - This Month</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <!-- MAP -->
                    <div class="box-body">
                        <div class="chart" id="chartMap" style="height:420px;">
                            @include('visits.charts.partials.chartscripts')
                            Loading map...
                        </div> 
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">USD Annual Sales by Type</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <!-- STACKED CHART -->
                    <div class="box-body">                
                        <div class="chart" id="chartStackedColumns" style="width:100%; height:400px;">
                            @include('visits.charts.partials.chartscripts')
                            Loading chart...
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">USD Sales % by Month by Type and Subtype - drill down (click on the center)</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <!-- DONUT -->
                    <div class="box-body">
                        <div class="chart" id="chartDonutdrilldown" style="height:400px;">
                                @include('visits.charts.partials.chartscripts')
                            Loading chart...
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
@endif
@overwrite
@if(Auth::user())
@push('scripts')
<script>
$(document).ready(function() {
    var charts = $('.chart');    
    for(var i=0;i<charts.length;i++){
        $("#" + charts[i].id).show()
    } 
    dt_start=  moment().startOf('month').format('YYYY/MM/DD') 
    dt_end = moment().format('YYYY/MM/DD')  
    dt_startChartStackedColumns= moment().startOf('year').format('YYYY/MM/DD') 
    dt_endChartStackedColumns = moment().format('MM/DD/YYYY')
    chartArea (dt_start, dt_end);
    chartMap (dt_start, dt_end);
    chartStackedColumns(dt_startChartStackedColumns, dt_endChartStackedColumns);
    chartDonut(dt_start, dt_end);
})
</script>
@endpush
@endif
