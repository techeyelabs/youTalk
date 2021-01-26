@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
            <h3 class="box-title text-success m-b-0">Reservations</h3>
            <p class="text-muted m-b-30">List of all Reservations</p>
        </div>
    </div>
    <div class="clear"></div><hr />
    <div class="table-responsive col-mod-12">
        <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
            <thead>
                <tr role="row">
                    <th>Service Title </th>
                    <th>Seller Name</th>
                    <th>Buyer Name</th>
                    <th>Reservation Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $k => $data)
                    @if($data->status == 2 && $data->completion_status == 1)
                        <tr role="row" class="odd">
                            <td>
                                <a href="{{route('admin-service-details', ['id' => $data->whichService->id])}}">{{ $data->whichService->title }}</a>
                            </td>
                            <td>
                                <a href="{{route('user-details', ['id' => $data->whichService->createdBy->id])}}">{{ $data->whichService->createdBy->name }}</a>
                            </td>
                            <td>
                                <a href="{{route('user-details', ['id' => $data->reserver->id])}}">{{ $data->reserver->name }}</a>
                            </td>
                            <?php
                                $year = date('Y', strtotime($data->acceptedSlot->day));
                                $day = date('d', strtotime($data->acceptedSlot->day));
                                $month = date('m', strtotime($data->acceptedSlot->day));
                                $res = $year.'年'.$month.'月'.$day.'日'.' '.$data->acceptedSlot->slot.':00:00';
                            ?>
                            <td>{{ $res}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group +
                                '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function () {
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

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection