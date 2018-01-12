@extends('layouts.scripts') 
<!DOCTYPE html>
<html lang="en">            

@include('dashboard.partials.htmlheader')
@section('htmlheader')
@show
<body class="skin-black fixed">
    <!-- <div id="ap" v-cloak> -->
    <div class="wrapper">
            @include('dashboard.partials.mainheader')
            @include('dashboard.partials.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @include('dashboard.partials.contentheader')
                <!-- Main content -->
                <section class="content">
                    <!-- Your Page Content Here -->
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            @include('dashboard.partials.controlsidebar')
            @include('dashboard.partials.footer')
        </div><!-- ./wrapper -->
        <!-- </div> -->
</body>
</html>
