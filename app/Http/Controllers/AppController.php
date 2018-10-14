<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\UploadFileRequest;
use App\Jobs\ProccessFile;
use App\Mail\ShutterstockMail;
use App\Services\MailchimpService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Mailgun\Mailgun;
use Mailgun\Model\Message\SendResponse;

class AppController extends Controller
{
    public function index()
    {
        $data['key'] = config('shutterstock.key');
        $data['secret'] = config('shutterstock.secret');

        return view('app', $data);
    }

    public function upload(UploadFileRequest $request)
    {
        /** @var UploadedFile $file */
        $file = $request->file;
        $images = $request->images;

        ProccessFile::dispatch($file, $images);

        return response()->json('Success', 200);
    }
}
