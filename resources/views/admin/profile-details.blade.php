@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
                <h3 class="box-title text-success m-b-0">User Profile Details</h3>
        </div>        
        {{-- <div class="col-mod-6 col-lg-6 ">
            <a href="{{ route('add_product') }}" class="waves-effect pull-right"><button class="btn btn-xs btn-info pull-right"><i class="fa fa-arrow-circle-left"></i> ADD NEW PRODUCT</button></a>
        </div>     --}}
    </div>  
    <div class="clear"></div><hr/>
    <div class="table-responsive col-mod-12">

                                
        <div class="col-md-12 row remove-pads">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td colspan="2" style="font-size: 20px"><b>プロフィール情報</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">氏名</td>
                                    <td style="width: 65%; text-align:left">{{$user_details->first_name}} {{$user_details->last_name}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">電話番号</td>
                                    <td style="width: 65%; text-align:left">{{$user_details->phone}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">性別</td>
                                    <td style="width: 65%; text-align:left">
                                        @if($user_details->gender == 1)
                                            <span>男性</span>
                                        @elseif($user_details->gender == 2)
                                            <span>女性</span>
                                        @elseif($user_details->gender == 3)
                                            <span>末記入</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">誕生日</td>
                                    @if($user_details->dob)
                                    <td style="width: 65%; text-align:left">{!!date('M j, Y', strtotime($user_details->dob))!!}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td style="width: 35%">住所</td>
                                    <td style="width: 65%; text-align:left">
                                        {!!nl2br($user_details->address)!!}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">自己紹介</td>
                                    <td style="width: 65%; text-align:left">
                                        {!!nl2br($user_details->bio)!!}
                                    </td>
                                </tr>
                                <tr><td colspan="2" style="font-size: 20px"><b>銀行口座情報</b></td></tr>
                                <tr>
                                    <td style="width: 35%">銀行名</td>
                                    <td style="width: 65%; text-align:left">
                                        {!!nl2br($user_details->bank_name)!!}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">支店名</td>
                                    <td style="width: 65%; text-align:left">
                                        {!!nl2br($user_details->branch_name)!!}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">種類</td>
                                    <td style="width: 65%; text-align:left">
                                        @if($user_details->acc_type == 1)
                                            <span>普通</span>
                                        @elseif($user_details->acc_type == 2)
                                            <span>当座</span>
                                        @elseif($user_details->acc_type == 3)
                                            <span>貯蓄</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">口座番号</td>
                                    <td style="width: 65%; text-align:left">
                                        {!!nl2br($user_details->acc_number)!!}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 35%">口座名義</td>
                                    <td style="width: 65%; text-align:left">
                                        {!!nl2br($user_details->acc_name)!!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <div class="col-md-6">
                <img src="{{Request::root()}}/assets/user/{{$user_details->picture}}" style="height: 160px; width: 160px; "/>
            </div>
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

  
        // function doAjax(id) {
        
        //     var ajaxurl = "{{route('change-user-status')}}";
            
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


