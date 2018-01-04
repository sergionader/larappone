@extends('layouts.master') 
<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Layout Options </h1>
            <p>Based on the <a href="https://adminlte.io/"  class="doc-link" target="_blank">AdminLTE 2</a> demo settings page, it offers some basic customization options that are saved as cookies.
            </p>
            <p>You access it from the Settings menu</p>
            <img class="img-responsive" src="/img/settings/settings-layout.png" alt="Settings">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Layout Options</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <table>
                        <tr>
                            <td class="col-md-4">
                                <img class="img-responsive" src="/img/settings/layout/layout_options.png" alt="Layout options">                    
                                
                            </td>
                            <td class="col-md-8">  
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>1 - Toggle Sidebar</strong>: use this option if you want to change between seeing the left sidebar or not. 
                                    </li>
                                    <li class="list-group-item"><strong>2 - Toggle Right Sidebar</strong>: the right sidebar is where the settings section is placed. From here you can choose between a dark or light layout for it.
                                    </li>
                                    <li class="list-group-item"><strong>3 - Skins</strong>: you can use any of the six colors, which one with two variations: dark and light.
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

