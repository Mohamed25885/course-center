<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['StudentId', 'CycleId', 'EnrollDate', 'Cancelled'];
    protected $table = 'enrollments';
    protected $primaryKey = 'EnrollmentID';


    public $timestamps = false;

    protected $casts = [
        'EnrollDate' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentId');
    }
    public function cycle()
    {
        return $this->belongsTo(CourseCycles::class, 'CycleId');
    }
}
