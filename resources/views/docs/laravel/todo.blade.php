@extends('layouts.master') 
<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>To Do </h1>
            <p>This is an on-going project, so there will always be things to do. </p>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">To do</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item"><i class="ion-android-checkbox-outline-blank"></i> Move the remaining chart selects to eloquent</li>  
                        <li class="list-group-item"><i class="ion-android-checkbox-outline-blank"></i> Roles & permissions</li>                     
                        <li class="list-group-item"><i class="ion-android-checkbox-outline-blank"></i> Implement Queues</li>                     
                        <li class="list-group-item"><i class="ion-android-checkbox-outline-blank"></i> Make it multilanguage</li>                     
                        <li class="list-group-item"><i class="ion-android-checkbox-outline-blank"></i> Revise ES implementation</li>                     
                        <li class="list-group-item"><i class="ion-android-checkbox-outline-blank"></i> Set ES startup</li>                     
                        <li class="list-group-item"><i class="ion-android-checkbox-outline-blank"></i> Grid export</li>                                             
                    </ul>
                </div>            
            </div>
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

