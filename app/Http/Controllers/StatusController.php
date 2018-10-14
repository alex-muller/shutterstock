<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Resources\FileResource;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('status');
    }

    public function getStatus(FileRepository $repository)
    {
        $files = $repository->getAllFilesWithEmails();

        return FileResource::collection($files);
    }
}
