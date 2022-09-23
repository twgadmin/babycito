<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Banner;
use Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('banner'));
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
        //

        $data = $request->except([
            '_token',
            '_method',
            'previous_image'
        ]);
        
        

        if ($request->hasFile('filename')) {
            if (!empty($request->previous_image)) {
                if (!empty($request->previous_image) && file_exists(uploadsDir('admin/banner') . $request->previous_image)) {
                    unlink(uploadsDir('admin/banner') . $request->previous_image);
                }
            }

            @mkdir(uploadsDir('admin/banner'), 0755, true);

            // move/upload file on server
            $photo              = $request->file('filename');
            $extension          = $photo->getClientOriginalExtension();
            // getting file extension
            $filename           = 'banners-' . time() . '.' . $extension;
            $photo->move(uploadsDir('admin/banner'), $filename);
            $data['filename'] = $filename;
        }

        
        $data['user_id']    = Auth::id();

        Banner::where('id', $id)->update($data);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Banner has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
