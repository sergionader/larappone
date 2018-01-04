@extends('layouts.master') 
<!-- extends('layouts.docs') -->
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Data Generator </h1>
            <p> The data generator is used to generate fake data for testing purposes. It is somehow complex as it tries to create sales and visits in 
                a way that the numbers will look natural. 
                It could have been a factory but I opted to create a controller (/app/Http/Controllers/DbController.php) what seemed to simplify getting the parameters from the Add Random Records form. 
                From the menu settings (upper right corner) you can access these three forms. 
            </p>
                @include('partials.cool-feature')
                    Every day the generator will create a variable number of records every one hour to mimic a working store.        
                </div>
            <p>You access it from the Settings menu</p>
            <img class="img-responsive" src="/img/settings/settings-db.png" alt="Settings">
            <br>
            <p><strong>Important</strong>: only administrators can use these features.</p>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Elements</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                        
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Add Random Records</strong>: 
                            
                            <table class="table">
                                <tr>
                                    <td class="col-md-4">
                                        <img class="img-responsive" src="/img/settings/data_generator/dg_add_random_records.png" alt="Data Generator">
                                    </td>
                                    <td class="col-md-8">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <strong>1 - Records</strong>
                                                number of records to create. Note that this is a base number, 
                                                as the controller will create 100 records with sales and will try to create a greater number of records
                                                 without sales to make the numbers look more natural. The idea is that the number of visits has to be
                                                equal or greater the number of sales.</li>
                                            <li class="list-group-item">
                                                <strong>2 - Zero Sales Only</strong>: 
                                                If for any reason you need to create zero sales (that is the same of
                                                a visit that didn't generate a sale), you should check this box.</li>
                                            <li class="list-group-item">
                                                <strong>3 - Date Range</strong>:
                                                Here you choose the data range you want the records to be created. It will randomically distribute the records 
                                                within the specified range. Note that the time of the visits have been limiting from 7:00 AM to 7:00 PM, as this is 
                                                a 24 hours store.                                                 
                                            </li>
                                        </ul>
                                       @include('partials.docs_import_callout')
                                    </td>
                                </tr>
                            </table>
                            
                        </li>
                        <li class="list-group-item"><strong>Populate Aux Tables</strong>

                            <table class="table">
                                <tr>
                                    <td class="col-md-4">
                                            <img class="img-responsive" src="/img/settings/data_generator/dg_populate_aux_tables.png" alt="Data Generator">
                                    </td>
                                    <td class="col-md-8">
                                        As stated on the screen, it will delete the data and populate the auxiliary tables. Technically it will: 
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <strong>1 - Delete all records from the model Visit</strong> -- this is necessary to update ES indexes;
                                                <pre><code class="php"><small>
$visits = Visit::all();
foreach ($visits as $visit) {
    $visit->delete(); 
}
                                                </small></code></pre>                       
                                            </li>
                                            <li class="list-group-item">
                                                <strong>2 - Delete all records from the model ProductVisit</strong> -- this is necessary to update ES indexes;
                                                <pre><code class="php"><small>
$product_visits = ProductVisit::all();
foreach ($product_visits as $product_visit) {
    $product_visit->delete();
}
                                                 </small></code></pre>   
                                            </li>
                                            <li class="list-group-item">
                                                3 - <strong>Run the migrations</strong> what will cause the tables to be deleted and recreated
                                                <pre><code class="php"><small>
Artisan::call('migrate:refresh');
                                                </small></code></pre>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>4 - Insert the auxiliary table's data</strong>: 
                                                <pre><code class="php"><small>
    $sql_origins = DB::insert(
        "INSERT INTO `origins` (`id`, `name`, `created_at`, `updated_at`) VALUES
        (1, 'Australia', '2017-11-27 09:30:00', NULL),
        ...
                                                </small></code></pre>
                                            <strong>Note:</strong>: The auxiliary tables are: 
                                                origins, products, profiles, subtypes, types, and users. 
                                                I could have used a seeder to input the data but it seemed more practical to create a controller for it. 
                                            </li>
                                        </ul>
                                        @include('partials.docs_import_callout')
                                    </td>
                                </tr>
                                ]
                            </table>
                        </li>                    
                        <li class="list-group-item"><strong>Delete All Records</strong>
                            <table class="table">
                                <tr>
                                    <td class="col-md-4">
                                            <img class="img-responsive" src="/img/settings/data_generator/dg_delete_all_records.png" alt="Data Generator">
                                    </td>
                                    <td class="col-md-8">
                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                As stated on the screen, it will delete the data and populate the users table, so you will be able to login in without having to recreate the default users.
                                                The users are: 
                                                This action will delete all data and then add only to the users table: 
                                                <br>John - user1@example.org, 
                                                <br>Mary - user2@example.org and
                                                <br>Peter - user3@example.org. 
                                                <br>All of them with the passwords test1234.
                                                <br>If you want to add random records, you must first populate the auxiliary tables as described above. 
                                            </li>
                                        </ul>
                                        @include('partials.docs_import_callout')
                                    </td>
                                </tr>
                            </table>                                  
                        </li>
                    </ul>
                </div>
            </div>
          
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

