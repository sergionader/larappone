<!-- Content Header (Page header) -->
<section class="content-header">
        <strong>Records: </strong>Visits Table: {{number_format(App\Visit::count()) }} |
        Products Table: {{number_format(App\ProductVisit::count()) }}
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