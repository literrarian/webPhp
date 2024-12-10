<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public $timestamps = false;
    public function articles(){
        return $this->belongsTo(Article::class);
    }
}
