<?php


namespace App\Services;


use Mailgun\Mailgun;

class MailgunService
{
    private $status = false;
    private $message;

    public function send($email, array $images)
    {
        $mgClient = Mailgun::create(config('services.mailgun.secret'));
        $domain = config('services.mailgun.domain');

        try {
            $result = $mgClient->messages()->send($domain, [
                'from'    => 'mailgun@' . $domain,
                'to'      =>  $email,
                'subject' => 'Hey, look at this images I\'ve found for you',
                'html'    => view('emails.shutterstock', ['images' => $images])->render()
            ]);

            $this->status = true;
            $this->message = $result->getMessage();
        } catch (\Exception $e) {
            $this->status = false;
            $this->message = $e->getMessage();
        }

        return $this;
    }


    public function getStatus(): bool
    {
        return $this->status;
    }


    public function getMessage()
    {
        return $this->message;
    }
}