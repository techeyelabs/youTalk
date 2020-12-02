@extends('navbar')

@section('custom_css')
    
   
@stop


@section('content')
{{-- @include('template.mytop') --}}
    {{-- <div class="col-md-12 row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-right" style="padding-left: 40px; padding-right: 40px">
            <form action="{{route('my-page-service')}}">
                <button type="submit" class="buttons" style="background-color: #7BB3AE !important">戻る</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/> --}}
    <div class="col-md-12 row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <div class="col-md-12">
            @php $index = 1; @endphp
                <div class="col-md-12">
                    <table style="width: 100%">
                        <tbody>
                                <tr>
                                    <td class="index_cells" style="width: 2%">#</td>
                                    <td class="index_cells">通話相手</td>
                                    <td class="index_cells">通話時間</td>
                                    <td class="index_cells">通話料</td>
                                    <td class="index_cells">日付</td>
                                </tr>
                            @foreach($list as $s)
                                <tr>
                                    <td class="index_cells" style="width: 2%">{{$index}}</td>
                                    <td class="index_cells">{{$s->receiver->name}}</td>
                                    <td class="index_cells">{!!gmdate("H:i:s", $s->seconds)!!}</td>
                                    <td class="index_cells">{{$s->providers_cut}} 円</td>
                                    <td class="index_cells">{{$s->created_at}}</td>
                                </tr>
                                @php $index++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/>
    <br/>
    <br/>
@stop



@section('custom_js')
@stop

















