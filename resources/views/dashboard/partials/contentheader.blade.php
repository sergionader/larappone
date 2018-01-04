<!-- Content Header (Page header) -->
<section class="content-header">
        <!-- @@if(!Auth::user() && !str_contains(url()->current(), "docs"))  -->
        <!-- "{{route('login')}}" -->
        <!-- <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Just one more step...</h4>
                <p>You must be logged in to use the app. </p>
                <p>Click to <a href="{{route('login')}}">login</a>.  </p>
                <p><span class="msg-red">Access data: user1@example.org/test1234</span></p>
                <p>I prefer to see the <a href="{{route('docs.project.index')}}">documentation</a>. </p>
        </div> -->
        <!-- @@endif -->

    @if(Session::has('info-success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>
                <i class="icon fa fa-check"></i> Success!</h4>
                {{ Session::get('info-success') }}
        </div>
    @endif
    @if(Session::has('info-warning'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>
                <i class="icon fa fa-warning"></i> Warning!</h4>
                {{ Session::get('info-warning') }}
        </div>
    @endif
    @if(Session::has('info-danger'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>
                <i class="icon fa fa-ban"></i> Alert!</h4>
                {{ Session::get('info-danger') }}
        </div>
    @endif
</section>