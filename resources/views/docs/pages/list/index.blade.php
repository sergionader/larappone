@extends('layouts.master') 
<!-- extends('layouts.docs')  -->
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>List, Search, Edit & Delete. </h1>

            <p>This page is also known as "the grid" for the short. From here it's possible to search for 
                visits and edit records. The <a href="{{route('elasticsearch.index')}}}" class="doc-link" >Elasticsearch</a> 
                document shows how it has been constructed and how to perform different types of searches. 
            <p>Though it is simple, it is also powerful, offering options for fuzzy searches, column sorting, pagination and, mainly, and, mainly, a very fast response time.
                </p>
            @include('partials.cool-feature') 
            It is important to mention that this a 100% Laravel, HTML and a little JS. No third-party grid has been employed. 
                Laravel does a great job server-paginating the result set making its use a very good choice.
           
            </div>

            </p>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Layout</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                        <table>
                                <tr>
                                  <td class="col-md-10">
                                        <img class="img-responsive" src="/img/crud/search.png" alt="Search">
                                        <div class="text-center"><small>Image 1 - Grid</small></div>
                                        <br>
                                  </td>
                                  <td class="col-md-2">
                                        <img class="img-responsive" src="/img/crud/responsive.png" alt="Responsive">
                                        <div class="text-center"><small>Image 2 - Mobile View</small></div>
                                        <br>
                                    <p><strong>Responsiviness</strong>:  As for the layout, the grid will shrink 
                                    as far as possible for smaller screens up the point it will freeze the first column and allow the user to slide the other columns horizontally.</li>
                                    </p>
                                  </td>
                                </tr>
                            </table>
                    
                    <ul class="list-group">
                        <li class="list-group-item"><strong>1 - Search Box</strong>: just type what you want to search for and hit enter.</li>
                        <li class="list-group-item"><strong>2 - Fuzziness on/off</strong>: if you want to enable fuzzy search, just active it. Note that in this example the search t
                            erm was "brasil" but Elasticsearch returned "Brazil" as the origin. </li>
                        <li class="list-group-item"><strong>3 - Expand/Collapse Control</strong>: the plus/minus sign allows you see what products made part of any visit.</li>
                        <li class="list-group-item"><strong>4 - Sort Controls</strong>: you can sort any of the sortable fields (all except comments) even if the resultset is filtered.</li>
                        <li class="list-group-item"><strong>5 - Edit Button</strong>: only the records created by the current user can be edited. You can tell it by seeing if the edit button is dimmed or not.</li>
                        <li class="list-group-item"><strong>6 - Page Navigator</strong>: It uses Laravel's out-of-the-box paginator.</li>
                        
                    
                      
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

