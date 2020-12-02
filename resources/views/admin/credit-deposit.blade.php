@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
            <h3 class="box-title text-success m-b-0">Credit Deposit</h3>
            <p class="text-muted m-b-30">List of all credit deposits</p>
        </div>        
        {{-- <div class="col-mod-6 col-lg-6 ">
            <a href="{{ route('send-mass-message') }}" class="waves-effect pull-right"><button class="btn btn-xs btn-info pull-right"><i class="fa fa-plus-circle"></i> Send New Message</button></a>
        </div>     --}}
    </div>  
    <div class="clear"></div><hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 40px">
        <li role="presentation"><a href="{{route('pending-deposit')}}">Bank Deposit</a></li>
        <li role="presentation"><a href="{{route('direct-deposit')}}">Direct Deposit</a></li>
        <li role="presentation" class="active"><a href="{{route('credit-deposit')}}">Credit Deposit</a></li>
    </ul>

    <div class="table-responsive col-mod-12">
        <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
            <thead>
                <tr role="row">
                    <th >SL </th>
                    <th >Name</th>
                    <th>Received Amount</th>
                    <th>Deposit time</th>  
                    
                </tr>
            </thead>
            <tbody>
                

                
            @foreach($deposits as $k => $data)

            {{-- @if($data->status == 0)
                @continue
            @endif --}}
            
              <?php
                // echo '<pre>';
                // print_r($data);
                // exit;
              ?>
            <tr role="row" class="odd">
                <td>{{ $k+1 }}</td>
                <td><a href="{{ route('user-details', ['user_id' => $data->user_id])}}"> {{ $data->user->name }} {{ $data->user->last_name }}</td>
                <td>{{ $data->amount}}</td>
                <td>{{ $data->created_at}}</td>

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

            //console.log(did);
            var flag = 0;
            //console.log($('.received_amount'+id));
            var selectorId = 'received_amount'+did;
            //console.log(selectorId);
            var errorId = 'received_amount_error'+did; 
            if($('#'+selectorId).val() == '' || $('#'+selectorId).val() == null){
                flag = 1;
                $('#'+errorId).show();
            }

            var amount = $("#" + selectorId).val();
            //console.log(selectorId);
            //console.log(amount);
            var ajaxurl = "{{route('accept-deposit-request')}}";
            //console.log(amount);
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
            //console.log(user_id);
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