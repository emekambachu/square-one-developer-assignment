<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class BlogPost extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
      'user_id',
      'user_name',
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
