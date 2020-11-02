<?php

namespace LaravelForum\Http\Controllers;

use LaravelForum\Reply;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use LaravelForum\Discussion;
use LaravelForum\Http\Requests\CreateDiscussionRequest;

class DiscussionsController extends Controller
{
    public function __construct() //middlewareを適用する(登録しかつメール認証を完了したユーザーのみdiscussionを新規作成できる)
    {
        // $this->middleware(['auth'])->only(['create', 'store']);
        $this->middleware(['auth', 'verified'])->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index', [
            'discussions' => Discussion::filterByChannels()->orderBy('updated_at', 'desc')->paginate(3) //filterByChannelsはクエリスコープ
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
        session()->flash('success', '質問が投稿されました！');
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
    public function edit(Discussion $discussion)
    {
        return view('discussions.edit', ['discussion' => $discussion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDiscussionRequest $request, Discussion $discussion)
    {
        //

        $discussion->update(
            [
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
                'channel_id' => $request->channel

            ]
        );

        session()->flash('success', '質問が修正されました！');
        return redirect()->route('discussions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        //

        $discussion->delete();
        session()->flash('success', '質問の削除が成功しました。');
        return redirect()->back();
    }
    public function reply(Discussion $discussion, Reply $reply) //$discussionにはslugがわたり,$replyにはidが渡る
    {
        $discussion->markAsBestReply($reply);
        session()->flash('success', '回答をベストアンサーとして認定しました！あとからでも変更可能です。');
        return redirect()->back();
    }
}
