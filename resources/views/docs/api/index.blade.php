@extends('layouts.master') 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>APIs </h1>
            <p>A set of APIs has been created to allow remote access to the database without exposing the database connection.
                <br>The authentication uses JTW (JSON Web Token) and is implemented to the create, update and delete (POST, PUT,
                DELETE) methods/verbs.
            </p>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Visits</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <table class="c2l-md-12  table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Method</th>
                                <th>Description</th>
                                <th>URL</th>
                                <th>Route</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GET</td>
                                <td>List all the visits (*)</td>
                                <td>api/v1/visit</td>
                                <td>visit.index</td>
                            </tr>
                            <tr>
                                <td>POST</td>
                                <td>Save a new visit and its products (if any)</td>
                                <td>api/v1/visit</td>
                                <td>visit.store</td>
                            </tr>
                            <tr>
                                <td>GET</td>
                                <td>Show any specific visit</td>
                                <td>api/v1/visit/{id}</td>
                                <td>visit.show</td>
                            </tr>
                            <tr>
                                <td>PUT</td>
                                <td>Update a visit</td>
                                <td>api/v1/visit/{id}</td>
                                <td>visit.update</td>
                            </tr>
                            <tr>
                                <td>DELETE</td>
                                <td>Delete a visit</td>
                                <td>api/v1/visit/{id}</td>
                                <td>visit.destroy</td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <small>(*) limited to 100 registers. The database has more than 100K records. Retrieving them at once is far from being a good idea.</small>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Products</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <table class="c2l-md-12  table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Method</th>
                                <th>Description</th>
                                <th>URL</th>
                                <th>Route</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GET</td>
                                <td>Show any specific product</td>
                                <td>api/v1/product/{id}</td>
                                <td>product.showtroy</td>
                            </tr>
                            <tr>
                                <td>DELETE</td>
                                <td>Delete an array of products from a specific visit</td>
                                <td>api/v1/product/{visitID}/products[]
                                    <br> api/v1/product/1?product_id[]=1&product_id[]=34?product_id[]=1&product_id[]=34
                                </td>
                                <td>product.destroy</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h2>How to use</h2>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">List and Show Visits</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <p>
                        For the ones with the GET method, you can use them on any browser just typing the URL with the visit id, when appropriate.
                    </p>
                    <ul class="list-group">
                        <li class="list-group-item">List: ../api/v1/visit (will show all the visits)</li>
                        <li class="list-group-item">Show: ../api/v1/visit/2 (will show the visit id 2 if it exists)</li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Authentication</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    For the others, you need to first authenticate yourself.
                    <ul class="list-group">
                        <li class="list-group-item">Download, install and run
                            <a href="https://www.getpostman.com/" target="_blank">Postman</a>
                        </li>
                        <li class="list-group-item">Set Postman as shown below -- use the correct URL where you see {url}:
                            <br>
                            <br>
                            <img src="\img\postman\postman001.png" alt="DB Structure">
                        </li>
                        <li class="list-group-item">
                            You can copy the 'Body' content from here:
                            <code>
                                { "email": "user2@test.com", "password": "test1234" }
                            </code>
                        </li class="list-group-item">After you press send you should see something like this:
                        <br>
                        <br>
                        <img src="\img\postman\postman002.png" alt="DB Structure">
                        </li>
                        <li class="list-group-item">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Create a Visit</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">Now you can, for instance, create a new record as the next image (make sure to use the token you
                            just copied -- ../api/v1/visit?token=TOKEN_YOU_COPIED
                            <br>
                            <br>
                            <img src="\img\postman\postman003.png" alt="DB Structure">
                        </li>
                        <li class="list-group-item"> You can copy the 'Body' content from here:
                            <pre><code class="json">
{
    "unit": "AB",
    "dt": "2017-12-19",
    "tm": "15:15:00",
    "profile_id": 2,
    "origin_id": 1,
    "avg": 2,
    "max": 92,
    "min": 69,
    "prec": 1.26,
    "comment": "Here is where the user places the comments...",
    "user_id": 2,
    "products": {
        "0": 1,
        "1": 1,
        "2": 30.50
    }
}             
                            </code></pre>
                        </li>

                        <li class="list-group-item">
                            Then the record is created and a confirmation is displayed:
                            <br>
                            <br>
                            <img src="\img\postman\postman004.png" alt="DB Structure">
                        </li>

                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Delete a Visit</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Set the method to DELETE and add the id for the visit to be updated on the URL.
                            <br>For instance, to delete the visit id 280:
                            <br>../api/v1/visit/280?token=TOKEN_YOU_COPIED
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Show a Product</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Set the method to GET (or use the browser).
                            <br>To see the product id 1:
                            <br>../api/v1/product/1
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Delete from the table product_visit</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            To delete a visit and one or more product from the product_visit table, set the method to DELETE and use the below URL --
                            it is useful for excluding products from a visit in a web form.
                            <br>../api/v1/product/290/?product_id[]=31&product_id[]=11&token=TOKEN_YOU_COPIED
                            <br>(it will delete the records where visit_id= 290 and product_id in(31,11)
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Postman Collection and Documentation</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Here is the link to import the Postman collection:
                            <br>
                            <a href="https://www.getpostman.com/collections/0785ce129b2a49ca61bb" target="_blank">https://www.getpostman.com/collections/0785ce129b2a49ca61bb</a>
                            <br>
                            <div class="postman-run-button" data-postman-action="collection/import" data-postman-var-1="114b1fd138ef403464f5"></div>
                            <script type="text/javascript">
                                (function (p, o, s, t, m, a, n) {
                                    !p[s] && (p[s] = function () {
                                        (p[t] || (p[t] = [])).push(arguments);
                                    });
                                    !o.getElementById(s + t) && o.getElementsByTagName("head")[0].appendChild((
                                        (n = o.createElement("script")),
                                        (n.id = s + t), (n.async = 1), (n.src = m), n
                                    ));
                                }(window, document, "_pm", "PostmanRunObject", "https://run.pstmn.io/button.js"));
                            </script>
                        </li>
                        <li class="list-group-item">
                            <a href="https://documenter.getpostman.com/view/1542077/larappone/7LkfiLX" target="_blank">API Documentation</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
