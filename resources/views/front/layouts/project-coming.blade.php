<?php
    $budget = $p->budget;
    $investment = $p->investment->where('status', true)->sum('amount');
    $done = $investment*100/$budget;
    $done = round($done);
?>
<div class="project_item four_stickers extra_div small_screen_font" style="">
    <a href="{{route('front-project-details', ['id' => $p->id])}}">
        <div  class="project_img small_sticker" style="height:220px; width:auto; background-color:#fff; background-image: url({{url('uploads/projects/'.$p->featured_image)}});background-repeat: no-repeat;
            background-position: center center; background-size: cover;">

            {{--<div class="project_status {{strtotime($p->end) < strtotime(date('Y-m-d H:i:s')) ? 'status_3' : ($done >= 100?'status_2':'status_1')}}"><span>{{strtotime($p->end) < strtotime(date('Y-m-d H:i:s')) ? '終了' : ($done >= 100?'達成':'募集中')}}</span></div>--}}
            <!-- 終了 Complete, '達成':'募集中' 'Status':'Live' -->
        </div>
    </a>


    <div class="project_text">
        <ul class="project_tags list-inline project_category_items">
            <li class="list-inline-item">
                <i class="fa fa-tag"></i> <a style="font-size: 10px" href="{{ route('front-project-list', ['c' => $p->category->id]) }}" class="category">{{$p->category->name}}</a>

            </li>
        </ul>
        <h2 class="project_title"><a style="font-size: 12px; height: 36px" title="{{$p->title}}" class="title small_screen_font" href="{{route('front-project-details', ['id' => $p->id])}}">{{str_limit($p->title, 90)}}</a></h2>

        {{--<div class="row project_progress pt-2">
            <div class="col-10">
                <div class="progress project_progress">
                    <div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-2"><p>{{ $done }}%</p></div>
        </div>--}}
        <div class="row project_item_footer">
            <?php
                $date1 = strtotime(date('Y-m-d H:i:s'));
                $date2 = strtotime($p->end);
                $interval = floor(($date2 - $date1)/86400);
                if($interval < 0)
                    $interval = '終了';
                $flag = 0;
                $start = strtotime("now");
                $end = strtotime(date('Y-m-d 23:59:59', strtotime($p->end)));
                $interval = ceil(abs($end - $start) / 86400);
                $hours_between = round((strtotime(date('Y-m-d 23:59:59', strtotime($p->end))) - strtotime("now"))/3600);
                $interval = $hours_between <= 24?$hours_between:$interval;
                $interval = ($interval < 0)?0:$interval;
                $start_real = strtotime(date('Y-m-d 01:01:01', strtotime($p->start)));
                if($hours_between < 24){
                    $interval = $interval.($hours_between <= 24)?'時間':'日';
                }
                if($start_real > $start){
                    $interval = ceil(abs($start_real - $start) / 86400);
                    $hours_left = round((strtotime(date('Y-m-d 23:59:59', strtotime($p->start))) - strtotime("now"))/3600);
                    $interval = $hours_left <= 24?$hours_left:$interval;
                    $interval = ($interval < 0)?0:$interval;
                    $interval = $interval.($hours_left <= 24)?'時間':'日';
                }
                if($interval <= 0)
                    $interval = '終了';
            ?>
            <div class="col-12 text-center" style="padding: 3px !important">
                <p style="font-size: 19px">{{$interval}}日後開始</p>
            </div>
        </div>
    </div>
</div>	