<?php


namespace App\Repositories;


use App\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class FileRepository
{
    public function getAllFilesWithEmails() : Collection
    {
        return File::orderBy('created_at', 'desc')->with('emails')->get();
    }

    public function createFile(UploadedFile $file) : File
    {
        return File::create(['name' => $file->getClientOriginalName()]);
    }
}