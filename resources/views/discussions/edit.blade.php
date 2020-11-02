@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">質問を編集する</div>

    <div class="card-body">
        <form action="{{ route('discussions.update',$discussion->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{$discussion->title}}">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
            <input id="content" value="{!! $discussion->content!!}" type="hidden" name="content">
                <trix-editor input="content" ></trix-editor>
            </div>
            <div class="form-group">
                <label for="channel">Channel</label>
                <select name="channel" id="channel" class="form-control">
                    @foreach($channels as $channel)
                <option value="{{$channel->id}}" {{$discussion->channel_id == $channel->id ? 'selected': ''}}>{{$channel->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">内容を変更</button>
        </form>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js" integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous"></script>

@endsection
