<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 09/11/18
 * Time: 11:41 AM
 */

namespace Models\Mailing;


use Illuminate\Mail\Message;
use Mail;

abstract class BaseEmail
{
    protected $isProduction;

    protected $noreplyEmail;
    protected $adminEmail;
    protected $adminName;

    protected $recipients;
    /**
     * @var array $variables
     */
    protected $variables;

    public function __construct($recipients, array $variables) {
        $this->isProduction = env('APP_ENV') == 'production';

        $this->recipients = $recipients;
        $this->variables = $variables;

        $this->noreplyEmail = settings('noreply_email');
        $this->adminEmail = settings('admin_email');
        $this->adminName = trans('emails.admin_name');
    }

    public abstract function view();
    public abstract function subject();

    /**
     * @throws \Exception
     */
    public function send() {
        if ( ! $this->isProduction) {
            return;
        }

        try {
            Mail::send($this->view(), $this->variables, function (Message $message) {
                $message->from($this->noreplyEmail, $this->adminName);
                $message->to($this->recipients)->subject($this->subject());
            });
        } catch (\Exception $ex) {
            file_put_contents('email_errors.txt',  date('Y-m-d H:i') . ' - ' . $this->view() . "\n" . $ex->getMessage() . "\n\n", FILE_APPEND);

            throw $ex;
        }
    }
}