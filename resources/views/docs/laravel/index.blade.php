@extends('layouts.master') 
//<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Laravel </h1>
            <p>Working with <a href="https://laravel.com/" class="doc-link"  target="_blank">Laravel</a> is a good experience. There many cool features out-of-the-box that can be used with just a few lines of code. For sure one has to 
                understand how the models, views, controllers, migrations, traits, etc work, but there are several good sources of information around -- I would mention 
                <a href="https://laracasts.com" class="doc-link"  target="_blank">Laracasts</a> as a very good place to go both for beginners or more advanced developers. 
            </p>
            <p>The <a href="https://laravel.com/docs/5.5/" class="doc-link" target="_blank"> official docs </a> are ok but don't expect to go much deeper from there. Many times you have to read the source code of a given method or class to better understand their nuances. 
            </p>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Main Features Used In This Project</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Auth</strong>: This is really amazing: just one command and you have all the login logic <b>and </b> the forms implemented. A cool next step could be one command to create and the role and permissions structure. 
                            <pre><code class="php">php artisan make:auth</code></pre>
                            Once it's done, you just have to set where you want to prevent access, say, by a user that has not created a record. The next line controls if the user will have access to the edit button for any of the loaded records in a blade: 
                            <pre><code class="php">
    @{{ (Auth::user()->id == $visit->user_id ? null : 'disabled not-allowed')  }}" role="button">
                            </code></pre>
                            <div class="text-center">
                                <img src="\img\laravel\laravelGridAuth.png" alt="Grid">
                                <p><small>User 1 is logged and can only edit records belonging to him/herself</small></p>
                            </div>
                            <p>See more about authentication <a href="https://laravel.com/docs/5.5/authentication" target="_blank">here</a>. </p>
                            <li>
                            <li class="list-group-item"><strong>Grid</strong>: before I decided for the native grid I tried some other options, but all got to point that got very slow with more than some hundreds of records. 
                                Sure I tried to handle the records on the server side, but there are some costs on doing so. 
                                That was until I realized that the native grid is just great (and fast!!). 
                                <p>The whole thing is composed by an HTML table with a tag for showing the pages navigator and a controller to fetch the records with the 
                                <pre><code class="php">paginate(n)</code></pre> as the closing method -- "n", as you can imagine, it is the number of records per page.</p>
                                <p>It's worthy to mention that it's fast even if you have one-to-many <b>and</b> many-to-many relations showing on the grid.</p>                            
                                <p>The grid has been tested with tens of thousands of records and the results were: fast, reliable and constant. </p>
                                <p>As a final thought, the grid does not have any sorting or filtering resources. Sorting is really easy to implement. 
                                    For the searching part, Elasticsearch does a great job. </p>
                            </li>
                        <li class="list-group-item">
                        @include('partials.cool-feature')
                        Laravel comes with a built-in <a href="https://laravel.com/docs/5.5/scheduling" class="doc-link">scheduler</a>. It saves a lot a work and keeps the scheduled tasks versioned.
                        </li>
                        <li class="list-group-item"><strong>Eloquent</strong>: though Eloquent is not difficult to learn, it took me some time to get used to that, 
                            especially when using it with <a href="{{route('elasticsearch.index')}}" class="doc-link" >Elasticsearch</a> via <a href="https://laravel.com/docs/5.5/scout" class="doc-link" target="_blank">Scout.</a> 
                            <p>For instance, when sorting by more than one field, the following syntax does not seem intuitive to me:</p>                            
                            <pre><code class="php">$model->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get(); </code></pre> 
                            <p>It could be something like the next snippet if both fields are to be 'asc' sorted;</p>
                            <pre><code class="php">$model->orderBy(['last_name', 'first_name'])->get(); </code></pre> 
                            <p>Naturally it would be possible to point the direction for each field if needed. </p>
                            <p>Nevertheless, once you get used to the way it works, there is a lot of things you can do without having to code that much. </p>
                            <p>Eloquent also offers ways to even use plain SQL syntax if you want -- or need, in some cases). It's as simple as the following: </p>
                            <pre><code class="sql">
    $sql_type = DB::select("
        SELECT  
            types.id as type_id,
            types.name as type,
            sum(product_visit.amount) AS y
        FROM 
            visits, product_visit, profiles, types
        WHERE 
            visits.id = product_visit.visit_id
            AND profiles.id = visits.profile_id
            AND types.id = profiles.type_id
            AND product_visit.amount>0
            AND (visits.dt between '$dt_start' and '$dt_end')  
        GROUP BY types.id, types.name
        ORDER BY types.name
    ");
                            </code></pre>
                            More about Eloquent can be found <a href="https://laravel.com/docs/5.5/eloquent" class="doc-link"  target="_blank"> here</a>
                        </li>
                        <li class="list-group-item">
                                @include('partials.cool-feature')
                                Laravel comes with a lot a validation presets that you can use as they are or extend them to meet your requirements.                             
                                </div>
                                <p>If you try to add visits without filling in the required fields, the validation engine comes to alert the user.</p>
                                <img src="\img\laravel\validation.png" alt="Messages">
                               <p>In our case, we use custom messages: </p>
                               <pre><code class="php">
            $prof_id_not = $env = env('APP_PROFILE_ID');
            $orig_id_not = $env = env('APP_ORIGIN_ID');
            $prod_id_not = $env = env('APP_PRODUCT_ID');
    
            $rules = [
                // the other fields in the form can be handled by the 'required' parameter in the <<Forms::>>
                'profile_id' => 'required|not_in:' . $prof_id_not,
                'origin_id' => 'required|not_in:' . $orig_id_not,
                'products.0' => 'required|not_in:' . $prod_id_not,
                'products.1' => 'required|min:0',
                'products.2' => 'required|min:0',
                ];
            $profile_message = 'Please choose the visitor\'s profile from the "Profile" list';
            $origin_message = 'Please choose the origin of the visitor from the "Origin" list';
            $product_message = 'Please choose the product from the "Product" list.';
            $customMessages = [
                'profile_id.required' => $profile_message,
                'profile_id.not_in' => $profile_message,
                'origin_id.required' => $origin_message,
                'origin_id.not_in' => $origin_message,
                'products.0.required' => $product_message,
                'products.0.not_in' => $product_message,
            ];
            $this->validate($request, $rules, $customMessages);
                                </code></pre>
                                <p>Note that all the magic happens here: <code class="php"> $this->validate($request, $rules, $customMessages);</code>
                                <p>The view gets the message like this:</p>
                                <pre><code class="html">
...
&lt;div class="alert alert-danger">
    &lt;ul>
        @@foreach($errors->all() as $error)
            &lt;li>@{{ $error }}&lt;/li>
        @@endforeach
    &lt;/ul>
&lt;/div>
...
                                </code></pre>
                                <br>Very simple and useful!</p>
                            </li>
                        <li class="list-group-item"><strong>Form Binding</strong>: Laravel offers a way of building web forms and binding them  to the related data with easy: 
                            <br>
                            <pre><code class="html">
...                                
    @{!! Form::open(['route' => ['app.update', 'id'=>"$visit->id"], 'method' => 'post']) !!}
    &lt;div class="form-group row">
        &lt;div class="col-md-2">
            @{!! Form::label('Unit *') !!} 
            @{!! Form::text('unit', $visit->unit, ['required', 'class'=>'form-control', 'id'=>'unit', 'placeholder'=>'Store Code'])!!}                                
        &lt;/div>
    &lt;/div>
...
                            </code></pre>
                                @include('partials.cool-feature')
                                    The 'required' keyword on the field definition will trigger an alert and stop the form submission as soon as the user presses the submit button.
                                </div>
                                <img src="\img\laravel\form_validation.png" alt="Form Validation">
                        </li>
                        <li class="list-group-item"><strong>Routes</strong>: are great and save a lot of time. Not only you can create groups but you can also create an entire set of API routes by creating a controller with the --resource modifier:
                            <pre><code class="php">
    php artisan make:controller myController --resource
                            </code></pre>
                            <p>More resource controllers can be found <a href="https://laravel.com/docs/5.5/controllers#resource-controllers" class="doc-link" class="doc-link"  target="_blank">here</a>.</p>
                            <p>Make sure to check the <a href="https://laravel.com/docs/5.5/routing" class="doc-link" target="_blank">routing documentation</a>.</p>
                        </li>
                        <!-- <li class="list-group-item">
                            @include('partials.cool-feature')
                            Laravel comes with a built-in <a href="https://laravel.com/docs/5.5/scheduling" class="doc-link">mail</a>. It saves a lot a work and keeps the scheduled tasks versioned.
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

