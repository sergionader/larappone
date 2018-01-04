@extends('layouts.master') 
<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>The Project </h1>
            <p>The project has begun as a way to verify the conversion performance by measuring the number of visitors a sunglasses
                store versus the number of sales in a given time. It was first conceived as a simple spreadsheet and when
                I was asked to move it to a web system, I took the opportunity to use Laravel to do so, aiming to use as
                much as it can offer to bust productivity and performance;
                <br> As it will be easy to see, it becomes much more than that and should be seen as a Laravel's case study.
            </p>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Features</h2>
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
                            <b>Access control</b>: other than creating users and logging in, users can only edit/delete their
                            own records.</li>
                        <li class="list-group-item">A
                            <b>dashboard</b> based on the
                            <a href="https://adminlte.io/" class="doc-link" target="_blank"> AdminLTE 2</a> project with a rich set of graphical information and charts, including one drill down
                            one.</li>
                        <li class="list-group-item">
                            <b>Cached</b> values for past data that is visible on the dashboard and that will not change within
                            the current month last month and last month last year.</li>
                        <li class="list-group-item">A
                            <b> chart selector</b> to analyze the data by any date range.</li>
                        <li class="list-group-item">An
                            <b> easy-to-use responsive</b> interface.</li>
                        <li class="list-group-item">
                            <b> Navigation controls</b> (forth and back) when editing records.</li>
                        <li class="list-group-item">A very
                            <b> fast grid </b> that can paginate
                            <b> tens of thousands</b> records without any performance issue.</li>
                        <li class="list-group-item">A very
                            <b> fast search engine</b> based on the
                            <a href="http://www.elastic.co/" class="doc-link" target="_blank">Eslasticsearch</a>
                             engine.</li>
                        <li class="list-group-item">A
                            <b>data generator </b>that offers a way to bulk add/delete records for testing purposes.</li>
                        <li class="list-group-item">
                            <b>Interface Customization</b> that allows the user to choose skins and some other custom settings. 
                        </li>
                    </ul>
                </div>
            </div>
            <div class="callout callout-warning">
                <h4>
                    <i class="icon fa fa-warning"></i> Important</h4>
                The data (sales, visits, etc) presented here was
                <a href="{{route('docs.pages.datagenerator.index')}}">electronic generated</a> to preserve the client privacy.
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">The Business</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <p>The rules are quite simple: every visit, whether there was a sale or not, is registered on the system.
                        </p>
                    <p>The important concepts are:</p>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>Visit</b>: every client that comes to the store is a visitor and therefore generate a visit.
                            If the visit does not generate a sale, it is only a visit. </li>
                        <li class="list-group-item">
                            <b>Sale</b>: If the visit generated a sale, then, well, it is a sale. </li>
                    </ul>
                    <p>The
                        <a href="{{route('docs.pages.add.index')}}" class="doc-link"> Add Page</a> and
                        <a href="{{route('docs.pages.edit.index')}}" class="doc-link"> Edit Page </a>documents explain how the add/edit interface work.
                    </p>
                </div>

            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Authentication and Authorization</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    It was used the Laravel Auth classes, methods and views for registering new users, logging in/out and retrieving forgot passwords.
                    As the store has a very small staff, there are no restraints except for the fact that a user can only
                    access and edit his/her own records.
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Interface</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <p>The interface was kept as simple as possible. After logging in, the initial page shows the dashboard
                        <<LINK>> The interface comprises:
                            <ul class="list-group">
                                <li class="list-group-item">The Dashboard,</li>
                                <li class="list-group-item">The List, Search, Edit, Delete & Add page,</li>
                                <li class="list-group-item">The Edit Page -- called from the above page,</li>
                                <li class="list-group-item">The Add Page,</li>
                                <li class="list-group-item">The Charts Page,</li>
                                <li class="list-group-item">The Data Generator Menu,</li>
                                <li class="list-group-item">The Settings Menu,</li>
                                <li class="list-group-item">The Login page,</li>
                                <li class="list-group-item">The Forgot Password page,</li>
                                <li class="list-group-item">The Reset Password page.</li>
                            </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">To do</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">create mySQL user</li>
                        <li class="list-group-item">move chart select to eloquent</li>
                        <li class="list-group-item">Roles & permissions</li>
                        <li class="list-group-item">Implement Queues</li>
                        <li class="list-group-item">Revise ES implementation</li>
                        <li class="list-group-item">grid export</li>
                        <li class="list-group-item">http://127.0.0.1:8000/docs/elasticsearch - Date Search: other than creating users and logging in,
                            users can only edit/delete their own records. </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ./row -->
</div>
<!--./ main -->
@endsection

