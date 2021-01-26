@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
                <h3 class="box-title text-success m-b-0">TALK ROOM HISTORY</h3>
                <p class="text-muted m-b-30">List of all talk room histories</p>
        </div>
    </div>  
    <div class="clear"></div><hr/>
<div class="table-responsive col-mod-12">
    <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
        <thead>
            <tr role="row">
                <th style="display: none">SL</th>
                <th>Date&Time</th>
                <th >Talk Room Title</th>
                <th >Seller Name</th>
                <th>Buyer Name</th>
                <th>Talk Time</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($talkrooms as $k => $data)
                <tr role="row" class="odd">
                    <?php
                        $year = date('Y', strtotime($data->created_at));
                        $day = date('d', strtotime($data->created_at));
                        $month = date('m', strtotime($data->created_at));
                        $time = date('H:i:s', strtotime($data->created_at));
                        $res = $year.'年'.$month.'月'.$day.'日'.' '.$time;
                    ?>
                    <td style="display: none">{{$k+1}}</td>
                    <td>{{ $res }}</td>
                    <td><a href="{{ route('talkroom-details', ['talkroom_id' => $data->id])}}"> {{ $data->service->title }}</a></td>
                    <td><a href="{{ route('user-details', ['seller_id' => $data->seller_id])}}"> {{ $data->seller->name}}</a></td>
                    <td><a href="{{ route('user-details', ['buyer_id' => $data->buyer_id])}}"> {{ $data->buyer->name}}</a></td>
                    <td>{{ $data->duration }}</td>
                    <td>{{ $data->cost }}</td>
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
                    [2, 'desc']
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
</script>
@endsection