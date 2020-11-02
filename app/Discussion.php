<?php

namespace LaravelForum;

use LaravelForum\Reply;
use LaravelForum\Channel;
use LaravelForum\Notifications\ReplyMarkedAsBestReply;



class Discussion extends Model
{
    //userメソッドにすることでuser_idというforeignKeyを自動的に探しに行ってくれる
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    //user以外のnamingにする場合は以下のようにする必要がある
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); //foreignKeyを第2引数にセットする
    }
    // public function getRouteKeyName() //route-model-bindingを使うときデフォルトではidを参照する
    // {
    //     return 'slug'; //slugを参照するようにoverwriteした
    // }
    public function replies() //すべてのreplyを取得
    {
        return $this->hasMany(Reply::class);
    }
    // public function getBestReply()
    // {
    //     return Reply::find($this->reply_id);
    // }
    public function bestReply() //bestReplyのみを取得
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }
    public function scopeFilterByChannels($builder)
    { //クエリスコープの作成
        if (request()->query('channel')) {
            //filter
            $channel = Channel::where('slug', request()->query('channel'))->first();
            if ($channel) {
                return $builder->where('channel_id', $channel->id);
            }
            return $builder; //見つからなかった場合
        }
        return $builder;
    }




    public function markAsBestReply(Reply $reply)
    {
        //discussionsテーブルのupdate
        $this->update([
            'reply_id' => $reply->id
        ]);

        if ($reply->owner->id == $this->author->id) { //discussionのauthorが自分のreplyをMarkしたときにはnotificationをさせない
            return;
        }
        //notificationの送信
        //notification関連のメソッドはuserモデルのインスタンスを解す必要がある点に注意
        $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
    }
}
