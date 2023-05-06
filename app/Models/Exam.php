<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;


    protected $guarded = ['TestNo'];
    protected $table = 'exams';
    protected $primaryKey = 'TestNo';

    public $timestamps = false;

    protected $casts = [
        'TestDate' => 'date',
        'TestTime' => 'datetime:H:i',
    ];

    public function cycle()
    {
        return $this->belongsTo(CourseCycles::class, 'CycleId');
    }
    public function results()
    {
        return $this->hasMany(ExamResult::class, 'TestNo');
    }
}
