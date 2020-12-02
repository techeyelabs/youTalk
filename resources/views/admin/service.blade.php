@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
                <h3 class="box-title text-success m-b-0">Services</h3>
                <p class="text-muted m-b-30">List of all Services</p>
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
                    <th >Title </th>
                    <th >Seller name</th>
                    <th >Price</th>
                    <th></th> 
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                

                
            @foreach($services as $k => $data)

            {{-- @if($data->status == 0)
                @continue
            @endif --}}
            
                
            <tr role="row" class="odd">
                <td><a href="{{route('admin-service-details', ['id' => $data->id])}}">{{ $data->title }}</a></td>
                <td><a href="{{route('user-details', ['id' => $data->createdBy->id])}}">{{ $data->createdBy->name }}</td>
                <td>{{ $data->price}}</td>
                <td>
                    @if($data->status == 1)
                        <button class="btn btn-danger" onclick="doAjax({{$data->id}})">非表示にする</button>
                    @else
                        <button class="btn btn-success"  onclick="doAjax({{$data->id}})">公開にする</button>
                    @endif  
                </td>
                
                
                    
                <td>                                     
                    @if($recom_count < 3)
                        @if($data->recommendation == 0)
                            <div class="dropdown" style="display: inline-block">
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    おすすめにする
                                <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    @for($i = 0 ; $i < 3 - $recom_count ; ++$i)
                                        <li><a onclick="recommendation({{$data->id}}, {{ $recom_free[$i] }})">{{$recom_free[$i]}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                        @else 
                            <button class="btn btn-danger" >おすすめ削除</button>
                        @endif
                    @else 
                        @if($data->recommendation > 0)
                            <button class="btn btn-danger" onclick="removeRecom({{$data->id}})">remove</button>
                        @endif
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

        function recommendation(sid, count){
            //console.log("cc "+count+" "+sid);

            var ajaxurl = "{{route('service-recommendation')}}";
            
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                        '_token': "{{ csrf_token() }}",
                        'service_id': sid,
                        'recom_serial': count
                },
                success: function(data){
                    location.reload();
                },
            });
        }

        function removeRecom(sid){
            var ajaxurl = "{{route('remove-recommendation')}}";
            
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                        '_token': "{{ csrf_token() }}",
                        'service_id': sid
                },
                success: function(data){
                    location.reload();
                },
            });
        }
    
</script>
@endsection