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
                   
                    <th >Created At</th>
                    <th >Name </th>
                    <th >Email</th>
                    <th style="display: none">Action</th> 
                    <th >Deposit Balance</th>
                    <th >Income Balance</th>
                </tr>
            </thead>
            <tbody>
                

                
            @foreach($users as $k => $data)

            {{-- @if($data->status == 0)
                @continue
            @endif --}}
            
                
            <tr role="row" class="odd">
                
                <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                <td><a href="{{route('user-details', ['id' => $data->id])}}">{{ $data->name }}</a></td>
                <td>{{ $data->email }}</td>
                
                
                
                    
                <td style="display: none">                                     
                    {{-- <a href="#" type="button" class="btn btn-warning btn-xs"  data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> UPDATE</a> --}}

                    {{-- <a href="#" id="disable" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fa fa-times-circle"></i> Disable
                    </a>   --}}
                    @if($data->status == 1)
                        <button class="btn btn-danger" onclick="doAjax({{$data->id}})">disable</button>
                    @else
                        <button class="btn btn-success"  onclick="doAjax({{$data->id}})">enable</button>
                    @endif  

                    @if($data->is_admin_checked == 1)
                        <a class="btn btn-info" href="{{route('show-messages', ['id' => $data->id])}}" style="color: white !important">chat <span class="badge" >new</span></a>
                    @else
                        <a class="btn btn-info" href="{{route('show-messages', ['id' => $data->id])}}" style="color: white !important">chat</a>
                    @endif
                </td>
                <td>{{ $data->wallet_balance }}</td>
                <td>{{ ($data->earning_balance > 0)? $data->earning_balance: 0}}</td>
               
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