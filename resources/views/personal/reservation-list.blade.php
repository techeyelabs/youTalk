@extends('navbar')

@section('custom_css')
   
@stop


@section('content')
    {{-- @include('template.mytop') --}}
    
    {{-- <br/> --}}
    <div class="col-md-12 row" style="min-height: 850px">
    @php $index = 1; @endphp
        <div class="col-md-2"></div>
        <div class="col-md-8 remove-pads hscroll" style="padding-left: 40px; padding-right: 40px">
            <table style="width: 100%">
                <tbody>
                        <tr>
                            <td class="index_cells">#</td>
                            <td class="table_cells">サービスタイトル</td>
                            <td class="table_cells">通話予約日程</td>
                        </tr>
                        <?php
                            foreach($list as $s){
                                if($s->slot == 1){
                                    $time = '11:00:00AM';
                                } elseif($s->slot == 2){
                                    $time = '02:00:00PM';
                                } else {
                                    $time = '04:00:00PM';
                                }
                                $day = '';
                                foreach($s->slots as $slt){
                                    if($slt->id == $s->slot)
                                        $day = $slt->day;
                                }
                        ?>
                            <tr>
                                <td class="index_cells">{{$index}}</td>
                                <td class="table_cells">{{$s->whichService->title}}</td>
                                <td class="table_cells">{{$day}}, {{$time}}</td>
                            </tr>
                            <?php $index++; }
                        ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/>
    <br/>
    <br/>
@stop



@section('custom_js')
@stop





















