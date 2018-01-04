@extends('layouts.master') 
//<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Elasticsearch </h1>
            <p>While Laravel does not provide a search engine out of the box, it does provide <a href="https://laravel.com/docs/5.5/scout" class="doc-link" target="_blank">Scout.</a>, 
                a package that is designed to ingrate Laravel with search packages. Scout comes ready for <a href="https://www.algolia.com/" class="doc-link" target="_blank">Algolia</a>, 
                a very powerful paid service. It is a good idea to also try using it.          
            </p>
            <p>
                Though Laravel is not Elasticsearch-ready by default, there are several drives to make the integration possible. 
                <br>The project uses <a href="https://github.com/ErickTamayo/laravel-scout-elastic "target="_blank">Tamayo's</a> driver that works very well. After installing it, 
                it will be necessary to first create an Elasticsearch index and set it up on the /config/scout.php file:

                class="list-group-item"><strong>Auth</strong>: This is really amazing: just one command and you have all the login logic <b>and </b> the forms implemented. A cool next step could be one command to create and the role and permissions structure. 
                <pre><code class="php">
    'driver' => env('SCOUT_DRIVER', 'elasticsearch'),
        'elasticsearch' => [
            'index' => env('ELASTICSEARCH_INDEX', <strong>'your_index_name'</strong>),
            'hosts' => [
                env('ELASTICSEARCH_HOST', 'http://localhost'),
            ],
        ],
                </code></pre>
                The driver will not only allow searching, as it will keep the database synchronized with the Elasticsearch 
                index as long as the code inserts, deletes and updates the data via Laravel's models. 
            </p>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Features</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Speed</strong>: the app has been tested with more than 150 visits and 400K product_visit records without any significant delay.</li>
                        <li class="list-group-item"><strong>Fuzziness</strong>: It is possible to choose using fuzziness for all the searches. </li>
                        <li class="list-group-item"><strong>Date Search</strong>: date search is simple: just use the format mmmyyyy to get the whole month. For instance, just type mmmyyyy as in jan2017.</li>
                    </ul>
                    @include('partials.docs_import_callout')
                </div>
            </div>
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

