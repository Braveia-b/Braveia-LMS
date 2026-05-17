<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'program_id',
        'title',
        'content',
        'video_url',
        'file_url',
        'order',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
