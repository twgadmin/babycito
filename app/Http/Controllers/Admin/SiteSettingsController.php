<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;

class SiteSettingsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = SiteSetting::find(1);
        return view('admin.site-settings', compact('records'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateSiteSettingRequest $request, $id)
    {
        // check logo if exists
        if ($request->hasfile('logo')) {

            //move | upload file on server
            $file      = $request->file('logo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename  = 'logo-'.time() . '.' . $extension;
            $file->move(uploadsDir('front'), $filename);

            //check if upload successfully
            if (file_exists(uploadsDir('front').$filename)
                && !empty($request->previous_logo && file_exists(uploadsDir('front').$request->previous_logo))
            ) {
                unlink(uploadsDir('front').$request->previous_logo);
            }
        } else {
            $filename = $request->previous_logo;
        }


        $data = $request->except([
            '_token',
            '_method',
            'previous_logo'
        ]);

        $data['logo'] = $filename;

        SiteSetting::where('id', $id)->update($data);

        return redirect()
            ->route('admin.site-settings.index')
            ->with('success', 'Site settings was updated successfully!');
    }
}
