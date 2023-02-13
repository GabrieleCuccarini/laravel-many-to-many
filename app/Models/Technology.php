<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = ['tech_name'];
    use HasFactory;

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
