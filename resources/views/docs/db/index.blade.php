@extends('layouts.master') 
//<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Database</h1>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">DB Structure</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <p>To generate fake data, use the <a href="{{route('docs.pages.datagenerator.index')}}" class="doc-link">Data Generator</a>.</p>
                        <img src="\img\db\db_relationships.png" alt="DB Structure">
                    </div>
                </div>
        
        </div>
    </div>
</div>
@endsection


