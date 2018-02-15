@section('title', $pageTitle)
@extends('admin.layouts.admin')
@section('content')
<!-- page title -->
<div class="page-title">
    <h1>Event List</h1>
    <p>List of events in the Easymeet</p>
    
    <ul class="breadcrumb">
        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
        <li>Events</li>
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
                    <th class="sort-header">Event Name</th>
                    <th class="sort-header">Event Organizer</th>
                    <th class="sort-header">Event Category</th>
                    <th class="sort-header">Event Date</th>
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
                        <td>
                            @if(isset($jstring->eventName))
                                {{$jstring->eventName}}
                            @endif
                        </td>
                        <td>
                            @if(isset($jstring->organizerName))
                                {{$jstring->organizerName}}
                            @endif
                        </td>
                        <td>@if(isset($jstring->eventCategory))
                            @foreach($jstring->eventCategory as $category)
                                {{$category->category}},
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(isset($jstring->eventDate))
                                @php ($date = date_create($jstring->eventDate))
                                @if(!$date)
                                    {{ $jstring->eventDate }}
                                @else
                                    {{ date_format($date,"d/m/Y") }}
                                @endif
                            @endif
                        </td>
                        <td>{{ $jstring->city or '' }}</td>
                        <td>{{ $jstring->state or '' }}</td>
                        <td>{{ $jstring->country or '' }}</td>
                        <td>
                            <button class="btn btn-default"><i class="fa fa-pencil"></i></button>
                            @if(isset($jstring->is_blocked))
                                @if(!$jstring->is_blocked)
                                    <a href="{{ url('events/block/'.explode(" : ", $jsonDoc->toString())[0]) }}">
                                        <button class="btn btn-success btn-default"><i class="fa fa-unlock"></i><span class="fa fa-lock-open"></span></button>
                                    </a>
                                @else
                                    <a href="{{ url('events/block/'.explode(" : ", $jsonDoc->toString())[0]) }}">
                                        <button class="btn btn-danger btn-default"><i class="fa fa-lock"></i><span class="fa fa-lock-open"></span></button>
                                    </a>
                                @endif
                            @endif
                            <form action="{{ url('events/'.explode(" : ", $jsonDoc->toString())[0]) }}" method="POST" onsubmit='deleteEvent("{{explode(" : ", $jsonDoc->toString())[0]}}", "{{ $jstring->eventName or '' }}", event,this)'>
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
    function deleteEvent(id, title, event,form)
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