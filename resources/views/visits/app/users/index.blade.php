@extends('layouts.master') 
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h1>LED: List, Edit & Delete ({{ $title[0] }})</h1> 
            </div>
        </div>             
    </div>             
    <table id="usersDataGrid" class="table table-hover">    
        <thead class="cf">
            <tr>
                @foreach($aliases as $alias) 
                    <th>
                        <table >
                            <tr>
                                <th rowspan=2 class="table-header-text ">                                   
                                    {{$alias['name']}}
                                </th>
                        @if($alias['sort'] )                            
                                <th class="table-header-sort-icon-up">
                                    <a href="{{route('app.index')}}?sort_column={{$alias['field']}}&sort_az_za=asc"><i class="fa fa-chevron-up"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th class="table-header-sort-icon-down">
                                    <a href="{{route('app.index')}}?sort_column={{$alias['field']}}&sort_az_za=desc"><i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr> 
                        @endif
                        </table>
                    </th>
                @endforeach
                </tr>
        </thead>
        @foreach($result as $item) 
        <tbody>     
            <tr>                
                <td data-title="ID">            {{$item->id       }}</td>
                <td data-title="Name">          {{$item->name       }}</td>
                <td data-title="Email">         {{$item->email       }}</td>
                <td data-title="Created At">    {{$item->created_at  }}</td>
                <td data-title="Updated At">    {{$item->updated_at   }}</td>                                                                                                            
            </tr>              
        @endforeach
    </table>      
    <div class="col-md-12 text-center">
        {{$result->links()}}
    </div> 

@endsection
