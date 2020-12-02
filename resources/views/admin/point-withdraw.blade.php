@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
                <h3 class="box-title text-success m-b-0">Users</h3>
                <p class="text-muted m-b-30">List of all Users</p>
        </div>        
        {{-- <div class="col-mod-6 col-lg-6 ">
            <a href="{{ route('add_product') }}" class="waves-effect pull-right"><button class="btn btn-xs btn-info pull-right"><i class="fa fa-arrow-circle-left"></i> ADD NEW PRODUCT</button></a>
        </div>     --}}
    </div>  
    <div class="clear"></div><hr/>
<div class="table-responsive col-mod-12">

                                

        <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
            <thead>
                <tr role="row">
                    <th >SL </th>
                    <th >User Name </th>
                    <th >Amount</th>
                    
                    <th >Time</th>
                    
                    
                    <th>Action</th> 
                    
                </tr>
            </thead>
            <tbody>
                

                
            @foreach($withdraw_requests as $k => $data)

            {{-- @if($data->status == 0)
                @continue
            @endif --}}
            
                
            <tr role="row" class="odd">
                <td>{{ $k+1 }}</td>
                <td>{{ $data->user->name }}</td>
                <td>{{ $data->amount }}</td>
                <td>{{ $data->created_at }}</td>
                
                
                
                    
                <td>                                     
                    @if($data->status == 1)
                        <a class="btn btn-success" href="{{route('accept-withdraw', ['id' => $data->id])}}" style="color: white !important">Accept</a>
                    @else
                        <button class="btn btn-info" disabled>Accepted</button>
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