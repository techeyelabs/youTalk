@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
            <h3 class="box-title text-success m-b-0">Bank Deposit</h3>
            <p class="text-muted m-b-30">List of all bank deposit requests</p>
        </div>
    </div>  
    <div class="clear"></div><hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 40px">
        <li role="presentation"><a href="{{route('direct-deposit')}}">Direct Deposit</a></li>
        <li role="presentation"><a href="{{route('credit-deposit')}}">Credit Card Deposit</a></li>
    </ul>
    <div class="table-responsive col-mod-12">
        <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
            <thead>
                <tr role="row">
                    <th >SL </th>
                    <th >Name</th>
                    <th >Requested Amount</th>
                    <th>Received Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deposits as $k => $data)
                    <tr role="row" class="odd">
                        <td>{{ $k+1 }}</td>
                        <td><a href="{{ route('user-details', ['user_id' => $data->user_id])}}"> {{ $data->user->name }} {{ $data->user->last_name }}</td>
                        <td>{{ $data->amount}}</td>
                        <td>
                            @if($data->status == 1)
                                <input type="number" class="form-control" id="received_amount{{$data->id}}" placeholder="received amount">
                                <div id="received_amount_error{{$data->id}}" style="font-size: 11px; color: red; display: none"><span>received amount required</span></div>
                            @elseif($data->status == 2)
                                {{$data->accepted_amount}}
                            @else
                                n/a
                            @endif
                        </td>
                        <td>
                            @if($data->status == 1)
                                <button class="btn btn-success" onclick="acceptDeposit({{$data->user_id}},{{$data->id}})">accept</button>
                                <button class="btn btn-danger" onclick="rejectDeposit({{$data->id}})">reject</button>
                            @elseif($data->status == 2)
                                accepted
                            @else
                                rejected
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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

  
    function doAjax(id) {

        var ajaxurl = "{{route('change-service-status')}}";

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

    function acceptDeposit(user_id,did){
        var flag = 0;
        var selectorId = 'received_amount'+did;
        var errorId = 'received_amount_error'+did;
        if($('#'+selectorId).val() == '' || $('#'+selectorId).val() == null){
            flag = 1;
            $('#'+errorId).show();
        }

        var amount = $("#" + selectorId).val();

        var ajaxurl = "{{route('accept-deposit-request')}}";

        if(flag == 0){
            if(confirm("Are you sure you want to accept?")){
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                            '_token': "{{ csrf_token() }}",
                            'amount': amount,
                            'user_id': user_id,
                            'id': did
                    },
                    success: function(data){
                        location.reload();
                    },
                    complete: function (data) {
                    }
                });
            }
        }

    }

    function rejectDeposit(did){
        var flag = 0;
        var deposit_id = did;
        var ajaxurl = "{{route('reject-deposit-request')}}";

        if(flag == 0){
            if(confirm("Are you sure you want to reject?")){
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                            '_token': "{{ csrf_token() }}",
                            'deposit_id': deposit_id
                    },
                    success: function(data){
                       location.reload();
                    },
                    complete: function (data) {
                    }
                });
            }
        }
    }
</script> 
@endsection