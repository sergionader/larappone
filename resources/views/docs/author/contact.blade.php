@extends('layouts.master') 
@section('content') 
@include('partials.errors')
<div class="main">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <!-- Main box -->
                <div class="box-header with-border">
                    <h3 class="box-title">Contact</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-8">
                    <!-- <form class="form-horizontal"> -->
                            {!! Form::open(array('route' => array('docs.author.contact.store'), 'class'=>'form-horizontal', 'method'=>'post')) !!}
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name (*)</label>
                            <div class="col-sm-9">
                                <!-- <input type="email" class="form-control" id="name" placeholder="Name"> -->
                                {!! Form::text('name', null, array('', 'class'=>'form-control', 'placeholder'=>'Your name')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company" class="col-sm-3 control-label">Company (*)</label>
                            <div class="col-sm-9">
                                <!-- <input type="text" class="form-control" id="company" placeholder="Company"> -->
                                {!! Form::text('company', null, array('', 'class'=>'form-control', 'placeholder'=>'Company')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email (*)</label>
                            <div class="col-sm-9">
                                <!-- <input type="email" class="form-control" id="email" placeholder="Email"> -->
                                {!! Form::text('email', null, array('', 'class'=>'form-control', 'placeholder'=>'Email')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Phone</label>
                            <div class="col-sm-9">
                                <!-- <input type="text" class="form-control" id="phone" placeholder="Phone"> -->
                                {!! Form::text('phone', null, array('', 'class'=>'form-control', 'placeholder'=>'Phone')) !!}
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Message (*)</label>
                            <div class="col-sm-9">
                                    {!! Form::textarea('message', null, array('', 'class'=>'form-control', 'id'=>'message', 'placeholder'=>'Message', 'rows' => 3)) !!}
                                <div id="textarea_feedback"><small>250 characters max.</small></div>
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button 
                                    id="submit" 
                                    type="submit" 
                                    class="btn btn-primary"
                                    data-loading-text="<i class='fa fa-spinner fa-spin '></i>&nbsp;Sending..."
                                >Send</button>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
                </div>
            </div>
            <!-- /.box - Main Box-->
        </div>
        <!-- col-xs-12 -->
    </div>
    <!-- row -->
</div>
<!-- main -->
@endsection
@push('scripts')
<script>
$(document).ready(function () {
    var text_max = 250;
    $('#textarea_feedback').html(text_max + ' characters remaining');

    $('#message').keyup(function() {
        var text_length = $('#message').val().length;
        var text_remaining = text_max - text_length;

        var text_message = ' characters remaining'; 
        if(text_remaining<=1){
            var text_message = ' character remaining'; 
        }

        $('#textarea_feedback').html(text_remaining + text_message);
    });

    $("#submit").on('click', function(){
        var $this = $(this);
        $this.button('loading');
    })
})
</script>
@endpush

    
