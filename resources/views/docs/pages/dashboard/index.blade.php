@extends('layouts.master') 
<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard </h1>
            <p>The dashboard is the most appealing part of the system as it presents a good summary of what is going on. 
            <p>It has two main sections: upper boxes and charts board.</p>
            </p>
            @include('partials.cool-feature')
            Try interacting with the charts. As you hover the mouse, you can see the values of each coordinate. 
            <br> Clicking on the labels (Visits/Sales, for instance) will toggle them on and off. 
            </div>
        
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Look & Feel</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">                    
                    <img class="img-responsive" src="/img/dashboard/dashboard.png" alt="Dashboard">
                </div>
            </div>
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Upper Boxes</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">                    
                        <ul class="list-group">
                            <li class="list-group-item"><strong>1 - Visits</strong>: Number of visits today up the last refresh.</li>
                            <li class="list-group-item"><strong>2 - Sales Today</strong>: Number of sales today. It's literally how many sales have occurred and not the financial value of the sales.</li>
                            <li class="list-group-item"><strong>3 - Conversion %</strong>: The sales performance, expressed be the Sales Today divided by Visits.</li>
                            <li class="list-group-item"><strong>4 - This Month %</strong>: The sales performance since the first day of the current month up the moment. It uses the formula  Sales of the Month divided by Visits of the Month.</li>
                            <li class="list-group-item"><strong>5 - Last Month</strong>: The same as above, but using data from the last month.</li>
                            <li class="list-group-item"><strong>6 - This Month Last Year%</strong>: Shows the same relation but considering the total of the same month of the last year.</li>
                            
                        </ul>
                    </div>
                </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Charts Board</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <p></p>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>7 - Charts</strong>: The chart board shows four distinct charts as described <a href="{{route('docs.pages.charts.index')}}" class="doc-link"> here</a>.</li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

