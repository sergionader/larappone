@extends('layouts.master') 
@extends('visits.charts.partials.chartscripts') 
@section('content')

<div class="main">
    <span id="formGetDates">  
        <div class="row">
            <div class="col-md-12">      
                <div class="box box">
                    <div class="box-header with-border">
                        <h3  class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! Form::open(array(null, null, 'onsubmit' => 'init(this); return false;')) !!} 
                        <div class="form-group row">   
                            <div class="col-md-3">
                                <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-pie-chart"></i></span>
                                    {{ Form::select('chart', $chart_list, null, ['required', 'class' => 'form-control']) }}
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {!! Form::text('daterange', null, 
                                    ['required', 'id'=>'datarange-chart-loader', 'class'=>'date form-control date-range-input', 'placeholder'=>'mm/dd/yyyy'])
                                    !!}
                                </div>   
                            </div>     
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    {!! Form::submit('Filter', array('class'=>'btn btn-primary')) !!}
                                </div>
                            </div> 
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.box -->
             </div>  
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3  class="box-title"><span id="boxTitle"></span></h3>
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
                        <div class="chart" id="chartArea" style="height:400px;"></div>
                        <div class="chart" id="chartMap" style="height:400px;"></div>
                        <div class="chart" id="chartStackedColumns"  style="width:100%; height:400px;"></div>
                        <div class="chart" id="chartDonutdrilldown" style="width:100%; height:400px;"></div>
                    </div>
                </div>
                <!-- /.box -->
            </div>   
        </div>
    </span>
</div>


@endsection

@push('scripts')
<script>
    
    function init(){
        date = $('#datarange-chart-loader').val();
        dt_start = date.substring(0, 10)
        dt_end = date.substring(13, 23)
        
        // DATE CHECK
        dt_start_validate = moment(dt_start, "MM/DD/YYYY", true).isValid()
        dt_end_validate = moment(dt_end, "MM/DD/YYYY", true).isValid()
        
        if(!(dt_start_validate && dt_end_validate)){
            BootstrapDialog.show({
                title: "Your attention, please",
                type: BootstrapDialog.TYPE_WARNING,
                buttons: [{
                    label: 'Close',
                    action: function (dialogRef) {
                        dialogRef.close();
                    }
                }],
                message: "Invalid dates. The date range should have a start and end date in this format: 'MM/DD/YYYY - MM/DD/YYYY'. Please correct them and try again."
            });
            return
        }
        //***  DATE CHECK
        dt_temp="";
        if(dt_end<dt_start){
            dt_temp = dt_end;
            dt_end = dt_start;
            dt_start= dt_temp
        } 
        chart= $("[name='chart'").val();
        // hide all the charts divs to only show the right one under the below switch. 
        var charts = $('.chart');
        for(var i=0;i<charts.length;i++){
            $("#" + charts[i].id).hide()
        }
        switch(parseInt(chart)) {
            case 0: //Area"
                $("#chartArea").show()
                $("#boxTitle").text("{{$chart_list[0]}}")
                chartArea (dt_start, dt_end);                                
                break;
            case 1: //Map     
                $("#chartMap").show()                      
                chartMap (dt_start, dt_end);
                $("#boxTitle").text("{{$chart_list[1]}}")
                break;
            case 2: //stacked
                $("#chartStackedColumns").show()
                $("#boxTitle").text("{{$chart_list[2]}}")
                chartStackedColumns(dt_start, dt_end);
                break;
            case 3: //donut               
                $("#chartDonutdrilldown").show()
                $("#boxTitle").text("{{$chart_list[3]}}")
                chartDonut(dt_start, dt_end);
                break;
            default:    
        }
    }
</script>
@endpush