<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\FeaturedImage;

class FeaturedImagesController extends Controller
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
        $data = FeaturedImage::get();
        return view('admin.featured_images.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.featured_images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except([
            '_token',
            '_method',
            'media_image'
        ]);

        if ($request->has('media_image')) {
            @mkdir(uploadsDir('admin/featured-images'), 0755, true);

            $file               = $request->file('media_image');
            $extension          = $file->getClientOriginalExtension();
            $filename           = 'featured-image-'.time(). '.'. $extension;
            $file->move(uploadsDir('admin/featured-images'), $filename);
            $data['media_image'] = $filename;
        }

        $data['is_active'] = $request->is_active ? 1 : 0;


        FeaturedImage::create($data);

        return redirect()
            ->route('admin.featured-images.index')
            ->with('success', 'Featued Image has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = FeaturedImage::find($id);
        return view('admin.featured_images.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FeaturedImage::find($id);
        return view('admin.featured_images.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except([
            'previous_image',
            '_token',
            '_method',
        ]);

        if ($request->hasFile('media_image')) {
            if (!empty($request->previous_image)) {
                if (!empty($request->previous_image) && file_exists(uploadsDir('admin/featured-images') . $request->previous_image)) {
                    unlink(uploadsDir('admin/featured-images') . $request->previous_image);
                }
            }

            @mkdir(uploadsDir('admin/featured-images'), 0755, true);

            // move/upload file on server
            $photo              = $request->file('media_image');
            $extension          = $photo->getClientOriginalExtension();
            // getting file extension
            $filename           = 'featured-image-' . time() . '.' . $extension;
            $photo->move(uploadsDir('admin/featured-images'), $filename);
            $data['media_image'] = $filename;
        }

        $data['is_active'] = $request->is_active ? 1 : 0;

        FeaturedImage::where('id', $id)->update($data);

        return redirect()
            ->route('admin.featured-images.index')
            ->with('success', 'Image has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FeaturedImage::where('id', $id)->delete();

        return redirect()
            ->route('admin.featured-images.index')
            ->with('success', 'Featued Image has been removed successfully.');
    }
}
