@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">Notifications</div>

    <div class="card-body">
        <ul class="list-group">
            @foreach ($notifications as $notification)
            <li class="list-group-item">
                @if ($notification->type== 'LaravelForum\Notifications\NewReplyAdded')
                あなたの質問に対して回答が新しく追加されました
                <strong>{{$notification->data['discussion']['title']}}</strong>
            <a href="{{route('discussions.show',$notification->data['discussion']['id'])}}" class="btn float-right btn-sm btn-info">View discussion</a>
                @endif
                @if ($notification->type== 'LaravelForum\Notifications\ReplyMarkedAsBestReply')
                    あなたの回答が「 <strong>{{$notification->data['discussion']['title']}}</strong> 」にてベストアンサーに認定されました！！
                    <a href="{{route('discussions.show',$notification->data['discussion']['id'])}}" class="btn float-right btn-sm btn-info">確認する</a>

                @endif

            </li>
            @endforeach
        </ul>



    </div>
</div>
@endsection
