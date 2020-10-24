<?php

namespace LaravelForum\Http\Controllers;

use LaravelForum\Reply;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use LaravelForum\Discussion;
use LaravelForum\Http\Requests\CreateDiscussionRequest;

class DiscussionsController extends Controller
{
    public function __construct() //middlewareを適用する
    {
        $this->middleware('auth')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index', [
            'discussions' => Discussion::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {  //userメソッドからcreateを実行することでuser_idが自動的にセットされる
        auth()->user()->discussions()->create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'channel_id' => $request->channel

        ]);
        session()->flash('success', 'Discussion posted.');
        return redirect()->route('discussions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion) //Model内のgetRouteKeyNameメソッドで参照元をslugに変更した
    {
        return view('discussions.show', [
            'discussion' => $discussion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function reply(Discussion $discussion, Reply $reply) //$discussionにはslugがわたり,$replyにはidが渡る
    {
        $discussion->markAsBestReply($reply);
        session()->flash('success', 'Marked as best reply.');
        return redirect()->back();
    }
}
