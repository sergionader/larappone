@extends('layouts.master')
@section('content')
@include('partials.errors')
<div class="main">
    <div class="row">
        <div class="col-xs-12">              
        {!! Form::open(array('route' => array('app.store'))) !!}
            <div class="box box-primary"> <!-- Main box -->
                <div class="box-header with-border">
                    <h3 class="box-title">Add Visit</h3>
                    <!-- <div class="box-tools pull-right">
                    </div>  -->
                    <!-- /.box-tools -->
                </div> <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('Unit *') !!} 
                            {!! Form::text('unit', 'AB', array('required', 'class'=>'form-control', 'placeholder'=>'Store Code')) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('Date *') !!} 
                            {!! Form::text('dt', null, array('required', 'id'=>'dt', 'class'=>'form-control', 'id'=>'dt', 'placeholder'=>'mmm/dd/yyyy')) !!}
                        </div>
                        <div class="col-md-2">
                            <div class="input-group bootstrap-timepicker timepicker">  
                                {!! Form::label('Time *') !!}
                                {!! Form::text('tm', Carbon\Carbon::now()->toTimeString(), array('required', 'id'=>'tm', 'class'=>'form-control', 'placeholder'=>'hh:mm')) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Profile *') !!}
                            {{Form::select('profile_id', $profiles, null, array('required', 'class'=>'form-control'))}}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Origin *') !!}
                            {{Form::select('origin_id', $origins, null, array('required','class'=>'form-control') )}}
                        </div>
                    </div>
                    <div class="box box">
                        <div class="box-header with-border">
                            <div class="col-xs-10">
                                <h3 class="box-title">Products</h3>
                            </div>
                        </div> <!-- /.box-header -->
                        <div class="box-body">  
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('Product *') !!}
                                    {{Form::select('products[]', $products, null, array('required','class'=>'form-control') )}}
                                </div>
                                <div class="col-md-2">
                                        {!! Form::label('Qtd *') !!} 
                                        {!! Form::text('products[]', '0', array('required', 'class'=>'form-control', 'id'=>'qtd', 'placeholder'=>'0')) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::label('Amount *') !!} 
                                    {!! Form::text('products[]', '0', array('required', 'class'=>'form-control', 'id'=>'amount', 'placeholder'=>'0')) !!}
                                </div>
                            </div>
                        </div> <!-- /.box body PRODUCTS -->
                    </div> <!-- /.box  -->
                    <div class="form-group row">
                        <div class="col-md-3 card-temperature">  
                            <div class="card">
                                <h3 class="cart-title">Wheater (&#8457;)</h3>
                                <div class="col-md-5">                    
                                    <div class="form-group">
                                        {!! Form::label('Average *') !!} 
                                        {!! Form::text('avg', '0', array('required', 'class'=>'form-control', 'placeholder'=>'0')) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Max *') !!} 
                                        {!! Form::text('max', '0', array('required', 'class'=>'form-control', 'placeholder'=>'0')) !!}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('Min *') !!} 
                                        {!! Form::text('min', '0', array('required', 'class'=>'form-control', 'placeholder'=>'0')) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Precip *') !!} 
                                        {!! Form::text('prec', '0', array('required', 'class'=>'form-control', 'placeholder'=>'0')) !!}
                                    </div>                    
                                </div>
                            </div>  <!-- card -->  
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                {!! Form::label('Comment') !!} 
                                {!! Form::textarea('comment', null, array( 'class'=>'form-control', 'placeholder'=>'Your comments and notes', 'rows' => 8)) !!}
                            </div>
                        </div>
                        {{ csrf_field() }}  
                    </div>    <!-- row -->  
                </div> 
                <!-- box body -->
                <div class="box-footer">
                    <a href="{{route('app.index')}}?sort_column=id&sort_az_za=asc&page=1" class="btn btn-primary">List</a>
                    {!! Form::submit('Save', array('class'=>'btn btn-info', 'id'=>'save-button')) !!}
                    <a href="{{route('app.create')}}" class="btn btn-danger">Cancel</a>
                </div> <!-- bpx footer -->
        {!! Form::close() !!}
            </div> <!-- panel -->
        </div> <!--col-md-12 -->
    </div> <!-- row -->

    <div class="row">
        
    </div>

</div> <!-- main -->

@endsection