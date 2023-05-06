<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCycles extends Model
{
    use HasFactory;

    protected $guarded = ['CycleId'];
    protected $primaryKey = 'CycleId';
    protected $table = 'coursespercycle';

    protected $casts = [
        'StartDate' => 'date',
        'EndDate' => 'date',
    ];

    public $timestamps = false;

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'TeacherId', 'TeacherId');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'CoursesId');
    }
    public function students()
    {
        return $this->hasManyThrough(Student::class, Enrollment::class, 'StudentId', 'StudentId');
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'CycleId');
    }
    public function classes()
    {
        return $this->hasMany(CycleClass::class, 'CycleId');
    }
    public function exams()
    {
        return $this->hasMany(Exam::class, 'CycleId');
    }
}
