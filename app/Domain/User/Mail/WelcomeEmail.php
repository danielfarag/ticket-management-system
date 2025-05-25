<?php

namespace App\Domain\User\Mail;

use App\Domain\Interaction\Traits\HasMailTemplate;
use App\Domain\User\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels, HasMailTemplate;

    /**
     * Created User
     *
     * @var User
     */
    public $user;

    /**
     * Created User
     *
     * @var User
     */
    private $type = 'new_user';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        $placeholders = [
            '[name]'            => $this->user->name,
            '[email]'           => $this->user->email,
            '[created_at]'      => $this->user->created_at,
        ];
        
        $this->buildMailBody($placeholders);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown("users::mails.WelcomeEmail")
        ->subject($this->subject ?? config('app.name') . ' - User Created - ' . $this->user->email);
        ;
    }
}
