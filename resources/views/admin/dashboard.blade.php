@extends('admin.layouts.main-admin')

@section('title')
    <div>
        <div class="content-wraper">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h5><a href="{{ route('services') }}"><i class="dashboard-icon fa-fw ti-settings text-info"></i>Service List</a></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h5><a href="{{ route('user-list') }}"><i class="dashboard-icon fa-fw ti-layout-accordion-list text-info"></i>User List</a></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h5><a href="{{ route('reservation-list') }}"><i class="dashboard-icon fa-fw ti-layers text-info"></i>Reservation List</a></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h5><a href="{{ route('service-history-list') }}"><i class="dashboard-icon fa-fw ti-clipboard text-info"></i>Talk Room History</a></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h5><a href="{{ route('message-list') }}"><i class="dashboard-icon fa-fw ti-clipboard text-info"></i>Message
                            @if($unread > 0)
                                <span class="badge">new</span>
                            @endif
                        </a></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h5><a href="{{ route('point-withdraw') }}"><i class="dashboard-icon fa-fw ti-clipboard text-info"></i>Withdraw Request
                            <span id="withdraw_badge_dashboard" class="badge"></span>
                        </a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function(){
        function updateWithdrawBadgeDashboard(){
            var ajaxurl = "{{route('withdraw-notification-dashboard')}}";
            $.ajax({
                url: ajaxurl,
                type: "GET",
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                success: function(data){
                    if(data > 0){
                        console.log("tktk2: "+data);
                        $('#withdraw_badge_dashboard').html("new");
                        $('#withdraw_badge_dashboard').show();
                    }
                },
                complete: function (data) {
                }
            }); 
        }
        updateWithdrawBadgeDashboard();
    });
</script>
@endsection
