<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
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
        $data = Testimonial::get();
        return view('admin.testimonials.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
        'full_name' => 'required|alpha|max:60',
        'media_image' => 'required|image',
        ]);



        $data = $request->except([
            '_token',
            '_method',
        ]);

        if ($request->has('media_image')) {
            @mkdir(uploadsDir('admin/testimonials'), 0755, true);

            $file               = $request->file('media_image');
            $extension          = $file->getClientOriginalExtension();
            $filename           = 'testimonial-'.time(). '.'. $extension;
            $file->move(uploadsDir('admin/testimonials'), $filename);
            $data['media_image'] = $filename;
        }

        $data['is_featured'] = $request->is_featured ? 1 : 0;


        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Testimonial::find($id);
        return view('admin.testimonials.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Testimonial::find($id);
        return view('admin.testimonials.edit', compact('data'));
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

        $request->validate([
        'media_image' => 'sometimes|image',
        ]);

        $data = $request->except([
            'previous_image',
            '_token',
            '_method',
        ]);

        if ($request->hasFile('media_image')) {
            if (!empty($request->previous_image)) {
                if (!empty($request->previous_image) && file_exists(uploadsDir('admin/testimonials') . $request->previous_image)) {
                    unlink(uploadsDir('admin/testimonials') . $request->previous_image);
                }
            }

            @mkdir(uploadsDir('admin/testimonials'), 0755, true);

            // move/upload file on server
            $photo              = $request->file('media_image');
            $extension          = $photo->getClientOriginalExtension();
            // getting file extension
            $filename           = 'testimonial-' . time() . '.' . $extension;
            $photo->move(uploadsDir('admin/testimonials'), $filename);
            $data['media_image'] = $filename;
        }

        $data['is_featured'] = $request->is_featured ? 1 : 0;

        Testimonial::where('id', $id)->update($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Testimonial::where('id', $id)->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Featued Image has been removed successfully.');
    }}
