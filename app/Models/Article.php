<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'summary',
        'content',
        'image_name'
    ];




    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }



}

