<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['TeacherId'];
    protected $primaryKey = 'TeacherId';

    public $timestamps = false;


    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  $this->FirstName . ' ' . $this->LastName,

        );
    }
}
