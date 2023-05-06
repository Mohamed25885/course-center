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

    protected $casts = [
        'BirthDate' => 'date'
    ];

    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  $this->FirstName . ' ' . $this->LastName,

        );
    }

    public function cycles()
    {
        return $this->hasManyThrough(CourseCycles::class, Enrollment::class, 'CycleId', 'CycleId')->where('Cancelled', false);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'EnrollmentID');
    }
}
