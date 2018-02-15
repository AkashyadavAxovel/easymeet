@section('title', $pageTitle)
@extends('admin.layouts.admin')
@section('content')
<!-- page title -->
<div class="page-title">
    <h1>User List</h1>
    <p>List of registered users in the Easymeet</p>
    
    <ul class="breadcrumb">
        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
        <li>Users</li>
    </ul>
</div>                        
<!-- ./page title -->

<!-- datatables plugin -->
<div class="wrapper wrapper-white">
    @include('admin.notification')
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sortable">
            <thead>
                <tr>
                    <th class="sort-header">#</th>
                    <th class="sort-header">Name</th>
                    <th class="sort-header">Email</th>
                    <th class="sort-header">Designation</th>
                    <th class="sort-header">City</th>
                    <th class="sort-header">State</th>
                    <th class="sort-header">Country</th>
                    <th class="sort-header">Action</th>
                </tr>
            </thead>                               
            <tbody>
                @php ($i = 1)
                @foreach( $jsonDocList as $jsonDoc )  
                    @php ($jstring = json_decode(explode(" : ", $jsonDoc->toString())[1]))
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $jstring->first_name or '' }} {{ $jstring->last_name or '' }}</td>
                        <td>{{ $jstring->email or '' }}</td>
                        <td>{{ $jstring->designation or '' }}</td>
                        <td>{{ $jstring->city or '' }}</td>
                        <td>{{ $jstring->state or '' }}</td>
                        <td>{{ $jstring->country or '' }}</td>
                        <td>
                            <button class="btn btn-default"><i class="fa fa-pencil"></i></button>
                            @if(!$jstring->is_blocked)
                                <a href="{{ url('users/block/'.explode(" : ", $jsonDoc->toString())[0]) }}">
                                    <button class="btn btn-success btn-default"><i class="fa fa-unlock"></i><span class="fa fa-lock-open"></span></button>
                                </a>
                            @else
                                <a href="{{ url('users/block/'.explode(" : ", $jsonDoc->toString())[0]) }}">
                                    <button class="btn btn-danger btn-default"><i class="fa fa-lock"></i><span class="fa fa-lock-open"></span></button>
                                </a>
                            @endif
                            <form action="{{ url('users/'.explode(" : ", $jsonDoc->toString())[0]) }}" method="POST" onsubmit='deleteUser("{{explode(" : ", $jsonDoc->toString())[0]}}", "{{ $jstring->first_name or '' }} {{ $jstring->last_name or '' }}", event,this)'>
                                {{ csrf_field() }}   
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn_fixes" title="Delete"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>  
                    @php ($i++)  
                @endforeach        
            </tbody>
        </table>
    </div>
    
</div>                        
<!-- ./datatables plugin -->
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript">
    function deleteUser(id, title, event,form)
    {   

        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You want to delete "+title,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: false,
            allowEscapeKey: false,
        },
        function(isConfirm){
            if(isConfirm) {
                $.ajax({
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    type: 'DELETE',
                    success: function(data) {
                        data = JSON.parse(data);
                        if(data['status']) {
                            swal({
                                title: data['message'],
                                text: "Press ok to continue",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Ok",
                                closeOnConfirm: false,
                                allowEscapeKey: false,
                            },
                            function(isConfirm){
                                if(isConfirm) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            swal("Error", data['message'], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", title+"'s record will not be deleted.", "error");
            }
        });
    }
</script>
@endsection