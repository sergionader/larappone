@extends('layouts.master') 
@section('content') 
@include('partials.errors') 
<section>
    <h1>
        About the Author
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="/img/author/sergionader2.jpg" alt="User profile picture">
                    <h3 class="profile-username text-center">Sergio Nader</h3>
                    <p class="text-muted text-center">Full Stack Developer</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <i class="fa fa-github margin-r-5"></i> <strong>Github</strong>
                    <p class="text-muted">
                       <a href="https://github.com/sergionader" target="_blank">https://github.com/sergionader/</a>
                    </p>
                    <i class="fa fa-twitter margin-r-5"></i> <strong>Twitter</strong>
                    <p class="text-muted">
                        <a href="https://twitter.com/nadersergio/" target="_blank">https://twitter.com/nadersergio</a>
                    </p>
                    <hr>
                    <i class="fa fa-book margin-r-5"></i> <strong>Education</strong>
                    <p class="text-muted">
                        B.S. in Business Administration from Faculdades Anhembi Morumbi at São Paulo, Brazil.
                    </p>
                    <hr>
                    <i class="fa fa-map-marker margin-r-5"></i> <strong>Location</strong>
                    <p class="text-muted">Orlando, Florida, US</p>
                    <hr>
                   <i class="fa fa-pencil margin-r-5"></i>  <strong>Skills</strong>
                    <p>
                        <span class="label label-warning">AWS</span>
                        <span class="label label-success">Elasticsearch</span>
                        <span class="label label-info">GIT</span>
                        <span class="label label-primary">Javascript</span>
                        <span class="label label-success">Ionic</span>
                        <span class="label label-primary">IoT</span>                        
                        <span class="label label-warning">jQuery</span>                        
                        <span class="label label-primary">Laravel</span>      
                        <span class="label label-success">Linux</span>
                        <span class="label label-warning">Magento</span>
                        <span class="label label-success">MVC</span>
                        <span class="label label-info">mySQL</span>
                        <span class="label label-warning">Node.js</span>
                        <span class="label label-success">ORM</span>
                        <span class="label label-warning">PHP</span>
                        <span class="label label-primary">PostgreSQL</span>
                        <span class="label label-primary">Streaming</span>
                        <span class="label label-info">WordPress</span>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-text-o margin-r-5"></i>Idioms</strong>
                    <p>English, Portuguese, Spanish and Italian</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#activity" data-toggle="tab">Some Thoughts About Developing</a>
                    </li>
                    <!-- <li>
                        <a href="#timeline" data-toggle="tab">Timeline</a>
                    </li> -->
                    <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <div>
                                <h4>Why do we develop?</h4>
                            </div>
                            <p>
                                We develop because someone will use it or will benefit from it somehow -- therefore we have to keep the user (and the use
                                the program will have) in mind all the time.
                                <br>We only exist as developer because of the users!
                            </p>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post">
                            <div>
                                <h4>Should I use this XYZ technology/framework/methodology/etc everyone is talking about?</h4>
                            </div>
                            <p>
                                Remember that today's trend my be the vilan in some years -- we have been there before.
                                <br>Before embarking yourself in using "what-everyone-is-using" ask yourself what are the costs
                                and benefits before making a decision.
                                <br>For the ones who love tech stuff and the thrill of the chalenge of something new, it's very
                                tempting to start using something new without measuring costs and benefits.
                                <br>Ideally, it's great to reserve some daily time for researching and learning.
                            </p>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post">
                            <div>
                                <h4>What is the most important thing about developing?</h4>
                            </div>
                            <p>
                                Keep it simple! It is so easy to over complicate things without getting any real benefit from it.
                                <br>Two other things:
                                <p>1) Always make a proof of concept if you are dealing with something new and</p>
                                <p>2) be patient! If it was that easy, anyone could do it. Think about it!</p>
                            </p>
                        </div>
                        <!-- /.post -->
                        <div class="post">
                            <div>
                                <h4>What is the most important characteristic one should have to become a developer?</h4>
                            </div>
                            <p>
                                The other day someone asked me that. That is a good question and the answer is not being good at Maths or going to college -- 
                                sure they are very useful for devolping but without the key ingredient, there is no way of being really good at anything in life. 
                                <br>What is the key ingredient? Love! The best tech people I've ever meet always loved what they do! Other than
                                that, there is a lot of hard work to get there, but without love, the best one will achieve, at most, 
                                so-so level.
                            </p>
                        </div>
                        <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
@endsection


