@extends('layouts.master') @section('content')
<div class="col-md-12">
    <div class="col-md-6">
        <h1>LED: List, Edit & Delete ({{ $title[0] }})</h1>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                Records per page:  
                    {!!Form::select('page_size', [5,10,15,25,50,100], 
                        [
                            'id'=>'page_size', 
                            'class'=>'form-control'
                        ]) 
                    !!}

            <table id="usersDataGrid" class="table table-hover">
                <thead class="cf">
                    <tr>
                        @foreach($aliases as $alias)
                        <th>
                            <table>
                                <tr>
                                    <th rowspan=2 class="table-header-text ">
                                        {{$alias['name']}}
                                    </th>
                                    @if($alias['sort'] )
                                    <th class="table-header-sort-icon-up">
                                        <a href="{{route($route)}}?sort_column={{$alias['field']}}&sort_az_za=asc&page_size={{$_REQUEST['page_size']}}">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="table-header-sort-icon-down">
                                        <a href="{{route($route)}}?sort_column={{$alias['field']}}&sort_az_za=desc&page_size={{$_REQUEST['page_size']}}">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
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
                        <td data-title="ID"> {{$item->id }}</td>
                        <td data-title="Name"> {{$item->name }}</td>
                        <td data-title="Email"> {{$item->email }}</td>
                        <td data-title="Created At"> {{$item->created_at }}</td>
                        <td data-title="Updated At"> {{$item->updated_at }}</td>
                    </tr>
                    @endforeach
            </table>
            <div class="row">
                <div class="col-md-12 text-center">
                   {{$result->links()}}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function () {
    // $("#submit-updateXXX").on('click', function (e) {
    $("#page_size").on('change', function (e){
        // $_REQUEST['page_size'] = this
        alert('test')
    })
})
</script>
@endpush
