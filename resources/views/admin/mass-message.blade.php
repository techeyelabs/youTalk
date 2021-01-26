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
                <h3 class="box-title text-success m-b-0">Message</h3>
                <p class="text-muted m-b-30">Send message to selected users</p>
        </div>        
        <div class="col-mod-6 col-lg-6 ">
            <a href="{{ route('message-list') }}" class="waves-effect pull-right"><button class="btn btn-xs btn-info pull-right"><i class="fa fa-arrow-circle-left"></i> Go To Messages</button></a>
        </div> 
    </div>  
    <div class="clear"></div><hr/>
    <div class="table-responsive col-mod-12">
        <div class="col-md-12">
            <form action="{{route('mass-message')}}" method="POST">
            {{ csrf_field() }}
                <div class="col-md-4" style="border: 1px solid rgba(184, 160, 160, 0.651); margin-right:20px;box-shadow: 2px 2px 10px #888888;">
                    <div class="col-md-12" style="margin: 16px 0px" >
                        <div><h4>Select Users</h4></div><hr>
                        <ul style="list-style: none; padding: 0px">
                            <li><input type="checkbox" id="select_all"/> Selecct All</li><hr>
                            @foreach($users as $user)
                                <li ><input style="display: inline; margin-right:10px; margin-bottom:10px" class="checkbox" type="checkbox" name="user[]" value="{{$user->id}}">{{$user->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-4" style="border: 1px solid rgba(184, 160, 160, 0.651);padding-left:0px;box-shadow: 2px 2px 10px #888888;">
                    <div class="col-md-12" style="margin: 16px 0px">
                        <h4>Message</h4><hr>
                        <div class="form-body">
                            <textarea id="message_text" name="message_text" placeholder="type tour text here..." style="border: 1px solid #FFFFFF; width: 100%; border-radius: 10px; margin-bottom: 20px"></textarea>
                        </div>
                        <button class="btn btn-info" style="margin-bottom: 10px"  type="submit">send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var select_all = document.getElementById("select_all"); //select all checkbox
    var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

    //select all checkboxes
    select_all.addEventListener("change", function(e){
        for (i = 0; i < checkboxes.length; i++) { 
            checkboxes[i].checked = select_all.checked;
        }
    });

    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if(this.checked == false){
                select_all.checked = false;
            }
            //check "select all" if all checkbox items are checked
            if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
                select_all.checked = true;
            }
        });
    }
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