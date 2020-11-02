<div class="card-header">
    <div class="d-flex justify-content-between  align-items-center">
        <div>
            <img width="40px" height="40px" style="border-radius:50%;" src="{{ Gravatar::src($discussion->author->email) }}" alt="">
            <span class="ml-2 font-weight-bold">{{$discussion->author->name}}</span>
        </div>
        <div class="ml-auto">

            <div class="d-flex">
                {{-- ログインしていないとき --}}
                @guest
                @if(in_array(request()->path(),['discussions']))
                <a href="{{route('discussions.show',$discussion->id)}}" class="btn btn-success btn-sm">View</a>
                @endif

                @endguest

                {{-- ログインしているとき --}}
                @auth
                @if(!in_array(request()->path(),['discussions']))
                    @if ( auth()->user()->id == $discussion->author->id)
                    <a href="{{route('discussions.edit',$discussion->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                    @endif
                @else
                    <a href="{{route('discussions.show',$discussion->id)}}" class="btn btn-success btn-sm">View</a>
                @endif
                {{-- @if (auth()->user()->id == $discussion->author->id)
                <form action="{{route('discussions.destroy',$discussion->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>

                    </form>

                @endif --}}


                @endauth

            </div>

        </div>




    </div>


</div>
