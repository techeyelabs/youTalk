<?php
    $budget = $p->project->budget;
    $investment = $p->project->investment->where('status', true)->sum('amount');
    $done = $investment*100/$budget;
    $done = round($done);
?>
<div class="project_item four_stickers extra_div small_screen_font" style="">
    <a href="{{route('front-project-details', ['id' => $p->project->id])}}">
        <div  class="project_img small_sticker" style="height:220px; width:auto; background-color:#fff; background-image: url({{url('uploads/projects/'.$p->project->featured_image)}});background-repeat: no-repeat;
            background-position: center center; background-size: cover;">

            {{--<div class="project_status {{strtotime($p->project->end) < strtotime(date('Y-m-d H:i:s')) ? 'status_3' : ($done >= 100?'status_2':'status_1')}}"><span>{{strtotime($p->project->end) < strtotime(date('Y-m-d H:i:s')) ? '終了' : ($done >= 100?'達成':'募集中')}}</span></div>--}}
            <!-- 終了 Complete, '達成':'募集中' 'Status':'Live' -->
        </div>
    </a>


    <div class="project_text">
        <ul class="project_tags list-inline project_category_items">
            <li class="list-inline-item">
                <i class="fa fa-tag"></i> <a style="font-size: 10px" href="{{ route('front-project-list', ['c' => $p->project->category->id]) }}" class="category">{{$p->project->category->name}}</a>

            </li>
        </ul>
        <h2 class="project_title"><a style="font-size: 12px;  height: 36px" title="{{$p->project->title}}" class="title small_screen_font" href="{{route('front-project-details', ['id' => $p->project->id])}}">{{str_limit($p->project->title, 20)}}</a></h2>
        <br/>
        <div class="row project_progress pt-2">
            <div class="col-10">
                <div class="progress project_progress">
                    <div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-2"><p>{{ $done }}%</p></div>
        </div>
        <div class="row project_item_footer">
            <div class="col-7" style="font-size: 11px">
                <p>現在 {{ number_format($investment) }} 円</p>
            </div>
            <!-- 現在 Current, 円 $ -->
            <div class="col-5" style="font-size: 11px">
                <p class="text-right">応援者 {{$p->project->investment->where('status', true)->count()}} 人</p>
            </div>
            <!-- 応援者 Supporter -->
        </div>
    </div>
</div>	