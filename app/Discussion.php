<?php

namespace LaravelForum;

use LaravelForum\Reply;



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
    public function getRouteKeyName() //route-model-bindingを使うときデフォルトではidを参照する
    {
        return 'slug'; //slugを参照するようにoverwriteした
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
