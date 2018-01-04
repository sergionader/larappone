@extends('layouts.master') 
@section('content')
<div class="main">
    <div class="row">
        responsiveness
        <br> error pages
        <br> chart total (stacked)
        <br> chart drilldown
        <br> dates inverted automticaly when filtering the charts
        <br>next previous button on the edit page
        <br> carbon add/subtract date is tricky....
        <br> https://zurb.com/playground/responsive-tables
        <br>        // $today = Carbon::today()->format('Y/m/d');
        // dump($today);
        // dump($dt_start );
        // $startDay   = date("d", strtotime($dt_start));
        // $startMonth = date("m", strtotime($dt_start));
        // $startYear  = date("Y", strtotime($dt_start));
        // $endDay     = date("d", strtotime($dt_end));
        // $endMonth   = date("m", strtotime($dt_end));
        // $endYear    = date("Y", strtotime($dt_end));
        
SOFTWARE:
    ImageOptim https://imageoptim.com/
    Tables responsive-tables
    html <code></code>



        // // $dt_start_year_ago = Carbon::createFromDate($startYear, $startMonth, $startYear, null)->subYears(1);
        // $dt_start_month_ago = Carbon::createFromDate($startYear, $startMonth, $startDay, null)->subMonths(1);
        // $dt_end__month_ago  = Carbon::createFromDate($endYear, $endMonth, $endDay, null)->subMonths(1);
        // $dt_start_year_ago = Carbon::createFromDate($startYear, $startMonth, $startDay, null)->subYears(1);
        // $dt_end__year_ago  = Carbon::createFromDate($endYear, $endMonth, $endDay, null)->subYears(1);

        // dump($dt_start_month_ago);
        // dump($dt_end__month_ago);
        // dump($dt_start_year_ago);
        // dump($dt_end__year_ago);
        <div class="col-md-12">
            <h1>Technical Notes</h1>
            
           
           
            <div class="panel panel-primary">
                <div class="panel-heading pnl-collapse">
                    <h2 class="panel-title">Other Software TBD</h2>
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <p>

                    </p>
                    <ul class="list-group">
                        <li class="list-group-item">
                            a
                        </li>
                        <li class="list-group-item">
                            b
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
<!-- // I tried to use it, but as there are several columns named "name", only the last one
// is shown. For instance: 
// ->get(['visits.id', 'types.name', 'types.name', 'subtypes.name']);
// will only bring subtypes.name. If you remove subtypes.name, then it will only bring 
// types.name and so on.
        //     $visits = Visit::
        //       join('types', 'profiles.id', '=', 'visits.profile_id')
        //     ->join('type', 'types.id', '=', 'types.type_id')
        //     ->join('subtypes', 'subtypes.id', '=', 'types.subtype_id')        
        //     ->where('visits.id', 1)
        //     ->get(['visits.id', 'types.name', 'types.name', 'subtypes.name']);
        //  dd (json_encode($visits));  -->