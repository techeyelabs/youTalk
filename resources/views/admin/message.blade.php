@extends('admin.layouts.main-admin')

@section('custom-style')
    <style>
        .msg_send_button{
            padding: 6px;
            border: 1px solid #618ca9;
            background-color: #618ca9;
            border-radius: 25px;
            color: white;
            width: 100px;
            cursor: pointer;
            outline: none !important;
            border: none !important
        }
    </style>
@endsection

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
                <h3 class="box-title text-success m-b-0">Chat</h3>
                <p class="text-muted m-b-30">List of all chats with {{$user->name}} {{$user->last_name}}</p>
        </div>        
        <div class="col-mod-6 col-lg-6 ">
            <a href="{{ route('message-list') }}" class="waves-effect pull-right"><button class="btn btn-xs btn-info pull-right"><i class="fa fa-arrow-circle-left"></i> Go To Messages</button></a>
        </div>
    </div>  
    <div class="clear"></div><hr/>
<div class="table-responsive col-mod-12">

                                

        
            @foreach($conversation as $data)
            <div class="row col-md-12">
                @if($data->sender_id == 0)
                    <div class="col-md-4" style="background-color: #EDF1F5; margin-bottom:10px; padding:5px">
                        {{ $data->message}}
                    </div>
                    <div class="col-md-4"></div>
                @else
                    <div class="col-md-4"></div>
                    <div class="col-md-4" style="background-color: #EDF1F5; margin-bottom:10px; padding:5px">
                        {{ $data->message}}
                    </div>  
                @endif
            </div>
            @endforeach

            <div class="row col-md-12" style="margin-top: 50px">

                <div class="col-md-8" style="padding: 0px !important">
                    <form action="{{route('sending-message')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <textarea id="message_text" name="message_text" style="border: 1px solid #a8c2ce; width: 100%; border-radius: 10px; padding: 10px"></textarea>
                            <input type="hidden" name="id" value="{{$user->id}}">
                        </div>
                        <div class="form-actions">
                            <button class="msg_send_button" type="submit">send</button>
                        </div>
                    </form>
                </div>

                </div>
                <div class="col-md-4">

                </div>
            </div>
        

            
</div>


@endsection

@section('script')

<script>
    // function send_msg(user_id)
    // {
    //     var ajaxurl = "{{route('send-message')}}";
    //     var sender = 0;
    //     var receiver = $user_id;
    //     var message_text = $('#message_text').val();
    //     if(message_text == '')
    //         return;
    //     $.ajax({
    //         url: ajaxurl,
    //         type: "POST",
    //         data: {
    //                 '_token': "{{ csrf_token() }}",
    //                 'sender': sender,
    //                 'receiver': receiver, 
    //                 'message_text': message_text 
    //         },
    //         success: function(data){
                
    //         },
    //         complete: function (data) {    
    //         }
    //     });
    // }
</script>

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

  
        function doAjax(id) {
        
            var ajaxurl = "{{route('change-user-status')}}";
            
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                        '_token': "{{ csrf_token() }}",
                        'id': id
                },
                success: function(data){
                    location.reload();
                },
            });
        }


    
    
</script>
@endsection