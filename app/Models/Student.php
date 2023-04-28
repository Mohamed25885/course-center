<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['StudentId'];
    protected $primaryKey = 'StudentId';

    public $timestamps = false;

    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  $this->FirstName . ' ' . $this->LastName,

        );
    }
}
