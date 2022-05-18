<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
      'user_id',
      'title',
      'slug',
      'description',
      'publication_date',
      'published'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
