<?php

namespace LaravelForum\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use LaravelForum\Discussion;

class NewReplyAdded extends Notification implements ShouldQueue //ShouldQueueクラスをimplementすることでnotificationをキューで処理する(UXが向上する)
{
    use Queueable;
    /**
     * The reply discussion
     *
     * @return Discussion
     */
    public $discussion;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Discussion $discussion)
    {
        $this->discussion = $discussion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; //mailとdatabaseでnotificationを使用
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('あなたの質問に対して返信がありました！！')
            ->action('回答を確認する', route('discussions.show', $this->discussion->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) //databaseのnotificationsテーブルに保存する情報を配列で指定する
    {
        return [
            'discussion' => $this->discussion
        ];
        //databaseに保存することでlaravelでの情報を利用することができる
    }
}
