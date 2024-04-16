<?php

namespace App\Notifications\Articles;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Mail\Articles\ArticleCreatedMale;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendArticleCreatedNotificationToAdmin extends Notification implements ShouldQueue
{
    use Queueable;

    public $article;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $admin_emale = conf('admin_email');

        return (new ArticleCreatedMale($this->article))->to($admin_emale);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
