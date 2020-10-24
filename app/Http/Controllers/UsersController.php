<?php

namespace LaravelForum\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function notifications()
    {
        //mark all as read
        auth()->user()->unreadNotifications->markAsRead();
        //display all notifications
        // dd(auth()->user()->notifications->first()->data['discussion']['slug']); //jsonフォーマットの連想配列になっている

        return view('users.notifications', [
            'notifications' => auth()->user()->notifications()->paginate(5)
        ]);
    }
}
