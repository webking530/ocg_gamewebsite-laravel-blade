<?php
namespace Models\Mailing;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

class MailingService
{

    protected static $system;
    protected static $mainAdmin;
    protected static $mainDeveloper;
    protected static $support = ['email' => 'support@ocg.casino', 'name' => 'OCG Team'];

    protected static $otherAdmins = [];
    protected static $otherDevelopers = [];


    protected $emailView = 'emails.blank';

    protected $mode = 'to';
    protected $body;
    protected $mailer;
    protected $subject;

    protected $to = [];
    protected $cc = [];
    protected $bcc = [];
    protected $from = [];
    protected $replyTo = [];


    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function send()
    {

        $sender = $this->getSender();

        $this->mailer->send($this->emailView, ['body' => $this->body], function (Message $message) use ($sender) {

            $message->subject($this->subject);
            $message->from($sender['email'], $sender['name']);

            foreach (['to', 'cc', 'bcc'] as $mode) {
                $this->addRecipients($message, $mode);
            }

        });
    }

    public function replyTo()
    {
        $this->mode = 'replyTo';

        return $this;
    }

    public function from()
    {
        $this->mode = 'from';

        return $this;
    }

    public function to()
    {
        $this->mode = 'to';

        return $this;
    }

    public function cc()
    {
        $this->mode = 'cc';

        return $this;
    }

    public function bcc()
    {
        $this->mode = 'bcc';

        return $this;
    }

    public function allAdmins()
    {
        $this->admin();
        $this->{$this->mode} = array_merge($this->{$this->mode}, static::$otherAdmins);

        return $this;
    }

    public function allDevelopers()
    {
        $this->developer();
        $this->{$this->mode} = array_merge($this->{$this->mode}, static::$otherDevelopers);

        return $this;
    }

    public function user(User $user)
    {
        $this->{$this->mode}[] = [
            'email' => $user->email,
            'name'  => $user->email,
        ];

        return $this;
    }


    public function users(Array $users)
    {
        foreach ($users as $user) {
            $this->user($user);
        }

        return $this;
    }

    public function system()
    {
        if (static::$system === null){
            $this->defineSystem(settings('no_reply_email'), settings('no_reply_name'));
        }

        $this->{$this->mode}[] = static::$system;

        return $this;
    }

    public function admin()
    {
        if (static::$mainAdmin === null){
            $this->defineMainAdmin(settings('admin_email'), settings('admin_name'));
        }

        $this->{$this->mode}[] = static::$mainAdmin;

        return $this;
    }

    public function support()
    {
        $this->{$this->mode}[] = static::$support;

        return $this;

    }

    public function developer()
    {
        if (static::$mainDeveloper === null){
            $this->defineMainDeveloper(settings('developer_email'), settings('developer_name'));
        }

        $this->{$this->mode}[] = static::$mainDeveloper;

        return $this;
    }

    public static function defineMainAdmin($email, $name)
    {
        static::$mainAdmin = compact('email', 'name');
    }

    public static function defineMainDeveloper($email, $name)
    {
        static::$mainDeveloper = compact('email', 'name');
    }

    public static function defineSystem($email, $name)
    {
        static::$system = compact('email', 'name');
    }

    public static function addAdmin($email, $name)
    {
        static::$otherAdmins[] = compact('email', 'name');
    }

    public static function addDeveloper($email, $name)
    {
        static::$otherDevelopers[] = compact('email', 'name');
    }

    private function getSender()
    {
        if (! count($this->from)) {
            $this->from()->system();
        }

        return end($this->from);
    }

    private function addRecipients($message, $mode)
    {
        foreach ($this->{$mode} as $receiver) {
            $message->{$mode}($receiver['email'], $receiver['name']);
        }
    }

    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function message($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $emailView
     * @return MailingService
     */
    public function emailView($emailView)
    {
        $this->emailView = $emailView;

        return $this;
    }
}