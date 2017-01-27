
<li class="dropdown">
    @if(count(Auth::User()->unreadNotifications) > 0)
    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
        <i class="glyphicon glyphicon-globe"></i>
        
        <span class="badge badge-up badge-danger badge-small">{!!count(Auth::User()->unreadNotifications)!!}</span>
        </a>
        @endif
    
    <ul class="dropdown-menu dropdown-notifications pull-right">
        <li class="dropdown-title bg-inverse">Notifications ({!!count(Auth::User()->unreadNotifications)!!})</li>
        @foreach(Auth::User()->unreadNotifications as $notif)
        <li>
            <a href="{{url('/view-task' , ['id' => $notif->data['task_id'] , 'notif'=> $notif->id])}}" class="notification" onclick="markasread('{{$notif->id}}')")>
                <div class="notification-thumb pull-left">
                    <i class="fa fa-clock-o fa-2x text-info"></i>
                </div>
                <div class="notification-body">
                    <strong>{!! $notif->data['message'] !!}</strong><br>
                    <small class="text-muted">created on: {!! $notif->created_at !!}</small>
                </div>
                
            </a>
        </li>
    @endforeach

        
        <li class="dropdown-footer">
            <a href="javascript:;"><i class="fa fa-share"></i> See all notifications</a>
        </li>
    </ul>
</li>
