<?php

namespace App\Jobs;

use App\Email;
use App\File;
use App\Repositories\EmailRepository;
use App\Repositories\FileRepository;
use App\Services\MailgunService;
use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mailgun\Mailgun;


class ProccessFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $fileModel;
    private $emails = [];
    private $images = [];
    private $mailgunService;
    private $emailRepository;


    public function __construct(UploadedFile $file, string $images)
    {
        $fileRepository = new FileRepository();

        $this->fileModel = $fileRepository->createFile($file);

        $this->emails = $this->getEmailList($file);

        $this->images = $this->getImages($images);

        $this->mailgunService = new MailgunService();

        $this->emailRepository = new EmailRepository();
    }

    public function handle()
    {

        foreach ($this->emails as $email) {
            $result = $this->mailgunService->send($email, $this->images);
            $this->emailRepository->createEmailWithStatusResult($email, $result, $this->fileModel);
        }

        $this->fileModel->status = true;
        $this->fileModel->save();

    }

    private function getEmailList(UploadedFile $file): array
    {
        $emailsArray = file($file->getRealPath());

        $emails = [];

        foreach ($emailsArray as $email) {
            $emails[] = trim($email);
        }

        return array_filter($emails);
    }


    private function getImages(string $images): array
    {
        $images = explode(',', $images);

        $images = array_map(function ($image) {
            return 'https://www.shutterstock.com/ru/image/' . $image;
        }, $images);

       return $images;
    }
}
