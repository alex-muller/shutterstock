<?php


namespace App\Repositories;


use App\Email;
use App\File;
use App\Services\MailgunService;

class EmailRepository
{
    public function createEmailWithStatusResult(string $email, MailgunService $result, File $fileModel)
    {
        $emailModel = new Email();
        $emailModel->email = $email;
        $emailModel->status = $result->getStatus();
        $emailModel->status_message = $result->getMessage();
        $emailModel->file_id = $fileModel->id;
        $emailModel->save();
    }

    public function getSuccessEmailsByFile(File $file)
    {
        return $file->emails()->where('status', true)->get();
    }
}