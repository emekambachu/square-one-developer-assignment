<?php

namespace App\Services;

use App\Models\BlogPost;

/**
 * Class PostService.
 */
class PostService
{
    public static function posts(){
        return new BlogPost();
    }

    public static function postsWithRelationships(){
        return self::posts()->with('user');
    }

    public static function postsByUserId($id){
        return self::posts()->where('user_id', $id);
    }
}
