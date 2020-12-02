@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
                <h3 class="box-title text-success m-b-0">Messages</h3>
                <p class="text-muted m-b-30">List of all chats</p>
        </div>        
        <div class="col-mod-6 col-lg-6 ">
            <a href="{{ route('send-mass-message') }}" class="waves-effect pull-right"><button class="btn btn-xs btn-info pull-right"><i class="fa fa-plus-circle"></i> Send New Message</button></a>
        </div>    
    </div>  
    <div class="clear"></div><hr/>
<div class="table-responsive col-mod-12">

                                

        <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
            <thead>
                <tr role="row">
                    <th >SL </th>
                    <th >User Name</th>
                    <th >Last Message</th>
                    <th>Date&Time</th>
                    <th>Action</th> 
                    
                </tr>
            </thead>
            <tbody>
                

                
            @foreach($users as $k => $data)

            {{-- @if($data->status == 0)
                @continue
            @endif --}}
            
                
                <tr role="row" class="odd">
                    <td>{{ $k+1 }}</td>
                    @if($data->receiver_id != 0)
                        <td><a href="{{ route('user-details', ['user_id' => $data->receiver_id])}}"> {{ $data->receiver->name }} {{ $data->receiver->last_name }}</td>
                    @elseif($data->sender_id != 0) 
                        <td><a href="{{ route('user-details', ['user_id' => $data->sender_id])}}"> {{ $data->sender->name }} {{ $data->sender->last_name }}</td>
                    @else
                        <td></td>  
                    @endif
                    @php
                        $str = strtok($data->recent_message, "\n");    
                    @endphp
                    <td>{{ substr($str,0,25) }}</td>
                    
                    <td>{{ $data->updated_at}}</td>
                    
                    <td>
                        @if($data->receiver_id != 0)
                            @if($data->receiver->is_admin_checked == 1)
                                <a class="btn btn-info" href="{{route('show-messages', ['id' => $data->receiver_id])}}" style="color: white !important">chat <span class="badge" >new</span></a>
                            @else
                                <a class="btn btn-info" href="{{route('show-messages', ['id' => $data->receiver_id])}}" style="color: white !important">chat</a>
                            @endif
                        @elseif($data->sender_id != 0) 
                            @if($data->sender->is_admin_checked == 1)
                                <a class="btn btn-info" href="{{route('show-messages', ['id' => $data->sender_id])}}" style="color: white !important">chat <span class="badge" >new</span></a>
                            @else
                                <a class="btn btn-info" href="{{route('show-messages', ['id' => $data->sender_id])}}" style="color: white !important">chat</a>
                            @endif
                        @else 

                        @endif
                    </td>

                    
                
                </tr>

            @endforeach
                
                

            </tbody>
        </table>

            
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });

  
        // function doAjax(id) {
        
        //     var ajaxurl = "{{route('change-service-status')}}";
            
        //     $.ajax({
        //         url: ajaxurl,
        //         type: "POST",
        //         data: {
        //                 '_token': "{{ csrf_token() }}",
        //                 'id': id
        //         },
        //         success: function(data){
        //             location.reload();
        //         },
        //     });
        // }


    
    
</script>
@endsection