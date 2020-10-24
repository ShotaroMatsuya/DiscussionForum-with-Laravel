@extends('layouts.app')

@section('content')


<div class="card">
@include('partials.discussion-header')
    <div class="card-body">
        <div class="text-center">
            <strong>{{$discussion->title}}</strong>
        </div>

        <hr>
        {!!$discussion->content!!}
        @if ($discussion->bestReply)
        <div class="card bg-success my-5" style="color:#fff">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img width="40px" height="40px" style="border-radius: 50%" class="mr-2" src="{{Gravatar::src($discussion->bestReply->owner->email)}}" alt="">
                        <strong>
                            {{$discussion->bestReply->owner->name}}
                        </strong>

                    </div>
                    <div><strong>BEST REPLY</strong></div>
                </div>

            </div>
            <div class="card-body">
                {!!$discussion->bestReply->content!!}
            </div>

        </div>

        @endif
    </div>


    </div>
    @foreach ($discussion->replies()->paginate(3) as $reply){{-- controllerではなくviewでpaginateメソッドをつかうのもアリ--}}
    <div class="card my-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                <img width="40px" height="40px" style="border-radius: 50%" src="{{Gravatar::src($reply->owner->email)}}" alt="">
                <span>{{$reply->owner->name}}</span>
                </div>
                <div>
                    @auth
                    @if (auth()->user()->id == $discussion->user_id)
                    <form action="{{route('discussions.best-reply',['discussion'=>$discussion->slug,'reply'=>$reply->id])}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-info">mark as best reply</button>
                    </form>

                    @endif

                    @endauth
                </div>
            </div>
        </div>
        <div class="card-body">
            {!!$reply->content!!}

        </div>
    </div>

    @endforeach
    {{$discussion->replies()->paginate(3)->links()}}
    <div class="card my-5">
        <div class="card-header">
            Add a reply
        </div>

        <div class="card-body">
            @auth
            <form action="{{route('replies.store',$discussion->slug)}}" method="POST">
                @csrf
                <input type="hidden" name="content" id="content">
                <trix-editor input="content"></trix-editor>
                <button type="submit" class="btn btn-sm my-2 btn-success">
                    Add Reply
                </button>
            </form>

            @else

        <a href="{{route('login')}}" class="btn btn-info">Sign in to add a reply</a>
            @endauth
        </div>
    </div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js" integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous"></script>

@endsection
