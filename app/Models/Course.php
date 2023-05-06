<?php

namespace App\Models;

use App\Interfaces\AttachmentsManagerInterface;
use App\Traits\AttachmentsManager;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class Course extends Model implements AttachmentsManagerInterface
{
    use HasFactory, AttachmentsManager;

    protected $guarded = ['CourseId'];
    protected $primaryKey = 'CourseId';

    public $timestamps = false;


    public function getFolderName(): string
    {
        return 'courses';
    }

    public function cycles()
    {
        return $this->hasMany(CourseCycles::class, 'CoursesId', 'CourseId');
    }

    public function enrollments()
    {
        return $this->hasManyThrough(Enrollment::class, CourseCycles::class, 'CoursesId', 'CycleId');
    }


    public function imageFile(): Attribute
    {
        return (new Attribute(
            get: fn ($value) =>  $this->getAttachment($this->Image),
            set: fn (File|UploadedFile $file) => ['Image' => $this->uploadAttachment($file, @$this->attributes['Image'])],
        ))->withoutObjectCaching();
    }
}
