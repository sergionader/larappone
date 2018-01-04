
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">     
  <section class="sidebar">  
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-desktop side-bar-icon"></i> <span dusk="app">App</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="{{route('app.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>                      
              <li><a href="{{route('app.index')}}?sort_column=id&sort_az_za=asc&page=1"><i class="fa fa-th"></i>List, Search, Edit, Delete & Add)</a></li>
              <li><a href="{{route('app.create')}}" dusk="add_visit"><i class="fa fa-plus-square-o"></i>Add Visit</a></li>
              <li><a href="{{route('charts.chartloader')}}"><i class="fa fa-pie-chart"></i>Charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book side-bar-icon"></i>  
            <span>Documentation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">                   
            <li class="treeview">
              <a href="#"><i class="fa fa-cubes"></i> Project
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{route('docs.project.index')}}"><i class="fa fa-cubes"></i>About the Project</a></li>     
                <li><a href="{{route('docs.laravel.index')}}"><i class="fa fa-cube"></i>Laravel</a></li>
                <li><a href="{{route('docs.laravel.todo')}}"><i class="fa fa-list"></i>To Do</a></li>
              </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="ion ion-ios-bookmarks-outline"></i> Pages
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('docs.pages.add.index')}}"><i class="fa fa-plus-square"></i>Add Page</a></li>     
                    <li><a href="{{route('docs.pages.auth.index')}}"><i class="fa fa-check-square-o"></i>Auth</a></li> 
                    <li><a href="{{route('docs.pages.charts.index')}}"><i class="fa fa-bar-chart"></i>Charts</a></li>
                    <li><a href="{{route('docs.pages.datagenerator.index')}}"><i class="ion ion-ios-analytics"></i>Data Generator</a></li>
                    <li><a href="{{route('docs.pages.dashboard.index')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li><a href="{{route('docs.pages.edit.index')}}"><i class="glyphicon glyphicon-pencil "></i>Edit Page</a></li>                       
                    <li><a href="{{route('docs.pages.layout.index')}}"><i class="ion ion-levels"></i>Layout Options</a></li>                       
                    <li><a href="{{route('docs.pages.list.index')}}"><i class="fa fa-table"></i>List, Search, Edit, Delete</a></li>                                      
                  </ul>        
              </li>
            <li><a href="{{route('elasticsearch.index')}}"><i class="fa fa-gg-circle"></i>Elasticsearch</a></li>
            <li><a href="{{route('db.index')}}"><i class="fa fa-database"></i>DB & Data</a></li>

            <li><a href="{{route('docs.stack.index')}}"><i class="fa fa-th-list"></i>Stack</a></li>             
            <li class="treeview">
              <a href="#"><i class="ion ion-code"></i> API
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{route('api.index')}}"><i class="fa fa-arrow-circle-right"></i>Intro, Postman & Auth</a></li>
                  <li><a href="{{route('api.doc')}}"><i class="glyphicon glyphicon-book"></i>Docs</a></li>                       
                </ul>        
            </li>
            <li><a href="{{route('docs.tests.index')}}"><i class="fa  fa-check-square-o"></i> Tests</a></li>
          </ul>
        </li>
        <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-question-sign side-bar-icon"></i> <span dusk="app">About the Author</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('docs.author.index')}}"><i class="fa fa-user"></i>Sergio Nader</a></li>                                             
                <li><a href="{{route('docs.author.contact')}}"><i class="fa fa-phone"></i>Contact</a></li>                                             
            </ul>
          </li>                  
      </ul>              
    <!-- /.sidebar-menu-->
  </section>
  <!-- /.sidebar -->
</aside>
