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
            <!-- <div class="col-md-2 text-center"> -->
            <div class="col-md-2 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua">
                        <i class="fa fa-users"></i>
                    </span>            
                    <div class="info-box-content">
                        <span class="info-box-text">Visits</span>
                        <span class="info-box-number" id="visits"></span>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-2 text-center"> -->
            <div class="col-md-2 col-sm-6 col-xs-12">
                    
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="ion ion-bag"></i></span>            
                    <div class="info-box-content">
                        <span class="info-box-text">Sales Today</span>
                        <span class="info-box-number" id="sales"></span>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-2 text-center"> -->
            <div class="col-md-2 col-sm-6 col-xs-12">                
                <div class="info-box">
                    <span class="info-box-icon bg-teal"><i class="ion ion-social-usd"></i></span>            
                    <div class="info-box-content">
                        <span class="info-box-text">Conversion %</span>
                        <span class="info-box-number" id="rate"></span>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-2 text-center"> -->
            <div class="col-md-2 col-sm-6 col-xs-12">
                    
                <div class="info-box">
                    <span class="info-box-icon bg-light-blue"><i class="fa fa-calendar"></i></span>            
                    <div class="info-box-content">
                        <span class="info-box-text">This Month %</span>
                        <span class="info-box-number" id="thismonthrate"></span>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-2 text-center"> -->
            <div class="col-md-2 col-sm-6 col-xs-12">
                    
                <div class="info-box">
                    <span class="info-box-icon bg-orange"><i class="fa fa-calendar-minus-o"></i></span>            
                    <div class="info-box-content">
                        <span class="info-box-text">Last Month %</span>
                        <span class="info-box-number" id="lastmonthrate"></span>
                    </div>
                </div>
            </div>        
            <!-- <div class="col-md-2 text-center"> -->
            <div class="col-md-2 col-sm-6 col-xs-12">                
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-calendar"></i></span>            
                    <div class="info-box-content">
                        <span class="info-box-text">This Mo Lst Yr %</span>
                        <span class="info-box-number" id="thismonthlastyearrate"></span>
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
