@extends('layouts.master-login')
@section('content')
<table class="datatable dataTable" cellspacing="0" width="100%" role="grid" style="width: 100%;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>      
            <th>Email</th>            
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection
@push('scripts')
<script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("serverSide")}}',
                columns: [            
                { data: 'id', name: 'id'},
                { data: 'name', name: 'name'},
                { data: 'email', name: 'email'},               
                { data: 'created_at', name: 'created_at'},
                { data: 'updated_at', name: 'updated_at'}
                ]
            });
        });
    </script>
@endpush