<?php


namespace App\Services;


use App\Email;
use App\File;
use App\Repositories\EmailRepository;
use DrewM\MailChimp\Batch;
use DrewM\MailChimp\MailChimp;
use Illuminate\Support\Facades\Log;

class MailchimpService
{
    private $MailChimp;
    private $emailRepository;

    public function __construct()
    {
        $api_key = config('services.mailchimp.key');
        $this->MailChimp = new MailChimp($api_key);
        $this->emailRepository = new EmailRepository();
    }

    public function addMembersToList(File $file)
    {
        $emails = $this->emailRepository->getSuccessEmailsByFile($file);

        $batch = $this->MailChimp->new_batch();

        $emails->each(function(Email $email) use ($batch) {
            $this->addMemberToList($email->email, $batch);
        });

        $result = $batch->execute();

        Log::debug(json_encode($result));
    }

    private function addMemberToList($email, Batch $batch)
    {
        $list_id = config('services.mailchimp.list');

        $batch->post($email, "lists/$list_id/members", [
            'email_address' => $email,
            'status'        => 'subscribed',
        ]);
    }
}