<?php

namespace App\Models;

use App\Interfaces\AttachmentsManagerInterface;
use App\Traits\AttachmentsManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class Teacher extends Model implements AttachmentsManagerInterface
{
    use HasFactory, AttachmentsManager;

    protected $guarded = ['TeacherId'];
    protected $primaryKey = 'TeacherId';

    public $timestamps = false;

    public function getFolderName(): string
    {
        return 'teachers';
    }

    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  $this->FirstName . ' ' . $this->LastName,

        );
    }

    public function imageFile(): Attribute
    {
        return (new Attribute(
            get: fn ($value) =>  $this->getAttachment($this->Image),
            set: fn (File|UploadedFile $file) => ['Image' => $this->uploadAttachment($file, @$this->attributes['Image'])],
        ))->withoutObjectCaching();
    }
}
