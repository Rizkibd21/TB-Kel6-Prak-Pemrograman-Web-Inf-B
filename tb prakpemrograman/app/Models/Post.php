<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['course_id', 'user_id', 'content', 'parent_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }
}
