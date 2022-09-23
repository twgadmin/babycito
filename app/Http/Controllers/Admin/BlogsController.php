<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\Blog;
use Auth;

class BlogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::getAllBlogsWithUser();
        return view('admin.blogs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::get();
        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method',
            'blog_media',
            'tags'
        ]);

        $tagData = json_decode($request->tags);
        $tags = '';

        foreach ((array)$tagData as $key => $value) {
            if ($key == 0) {
                $tags = "#" . $value->value;
            } else {
                $tags = $tags.", #".$value->value;
            }
        }
        
        $tags = str_replace(' ', '', $tags);
        $data['tags'] = $tags;

        if ($request->has('blog_media')) {
            @mkdir(uploadsDir('admin/blogs'), 0755, true);

            $file               = $request->file('blog_media');
            $extension          = $file->getClientOriginalExtension();
            $filename           = 'blogs-'.time(). '.'. $extension;
            $file->move(uploadsDir('admin/blogs'), $filename);
            $data['blog_media'] = $filename;
        }

        if ($request->is_featured && $request->is_featured == 'on') {
            $featured = 1;
        } else {
            $featured = 0;
        }
        $data['admin_id'] = Auth::id();

        $data['is_featured'] = $featured;
        Blog::create($data);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Blog::getAllBlogsWithUser(['blogs.id' => $id])->first();
        
        return view('admin.blogs.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data       = Blog::where('id', $id)->first();
        $categories = BlogCategory::get();
        return view('admin.blogs.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'previous_image',
            'tags'
        ]);
        
        $tagData = json_decode($request->tags);
        $tags = '';
        foreach ($tagData as $key => $value) {
            if ($key == 0) {
                if (substr($value->value, 0, 1) == '#') {
                    $tags = $value->value;
                } else {
                    $tags = "#" . $value->value;
                }
            } else {
                if (substr($value->value, 0, 1) == '#') {
                    $tags = $tags.", ".$value->value;
                } else {
                    $tags =$tags.", #".$value->value;
                }
            }
        }

        $tags = str_replace(' ', '', $tags);
        $data['tags'] = $tags;

        if ($request->hasFile('blog_media')) {
            if (!empty($request->previous_image)) {
                if (!empty($request->previous_image) && file_exists(uploadsDir('admin/blogs') . $request->previous_image)) {
                    unlink(uploadsDir('admin/blogs') . $request->previous_image);
                }
            }

            @mkdir(uploadsDir('admin/blogs'), 0755, true);

            // move/upload file on server
            $photo              = $request->file('blog_media');
            $extension          = $photo->getClientOriginalExtension();
            // getting file extension
            $filename           = 'blogs-' . time() . '.' . $extension;
            $photo->move(uploadsDir('admin/blogs'), $filename);
            $data['blog_media'] = $filename;
        }

        if ($request->is_featured && $request->is_featured == 'on') {
            $featured = 1;
        } else {
            $featured = 0;
        }
        $data['admin_id']    = Auth::id();
        $data['is_featured'] = $featured;

        Blog::where('id', $id)->update($data);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::where('id', $id)->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog was removed successfully!');
    }
}
