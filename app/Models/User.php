<?php

namespace App\Models;

use App\Interfaces\AttachmentsManagerInterface;
use App\Traits\AttachmentsManager;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class User extends Authenticatable implements AttachmentsManagerInterface
{
    use HasApiTokens, HasFactory, Notifiable, AttachmentsManager;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getFolderName(): string
    {
        return 'users';
    }

    public function imageFile(): Attribute
    {
        return (new Attribute(
            get: fn ($value) =>  $this->getAttachment($this->image),
            set: fn (File|UploadedFile $file) => ['image' => $this->uploadAttachment($file, @$this->attributes['image'])],
        ))->withoutObjectCaching();
    }
}
