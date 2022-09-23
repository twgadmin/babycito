<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'title',
        'content',
        'blog_media',
        'is_featured',
        'blog_category_id',
        'tags',
        'is_index',
        'is_follow',

    ];

    public static function getAllBlogsWithUser($where = [])
    {
        $query = self::select(
            'blogs.*',
            'admins.first_name as admin_name',
            'blog_categories.name as blog_category_name'
        )
            ->leftjoin('admins', 'admins.id', '=', 'blogs.admin_id')
            ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->where($where)
            ->groupBy('blogs.id')
            ->paginate(10);

        return $query;
    }


    public static function getAllBlogsWithUserWithCategory($search_keyword,$where = [])
    {
        $query = self::select(
            'blogs.*',
            'admins.first_name as admin_name',
            'blog_categories.name as blog_category_name'
        )
            ->leftjoin('admins', 'admins.id', '=', 'blogs.admin_id')
            ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->where($where)
            ->where('blog_categories.name','LIKE','%' . $search_keyword .'%')
            ->groupBy('blogs.id')
            ->paginate(10);

        return $query;
    }

    public static function getAllBlogsList($search_keyword = null)
    {
        $query = self::select(
            'blogs.*',
            'admins.first_name as admin_name',
            'blog_categories.name as blog_category_name'
        )
            ->leftjoin('admins', 'admins.id', '=', 'blogs.admin_id')
            ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->when($search_keyword->q,function($query) use ($search_keyword){
                $query->where('blogs.title','LIKE','%' . $search_keyword->q .'%');
            })
            ->groupBy('blogs.id')
            ->paginate(10);

        return $query;
    }
}
