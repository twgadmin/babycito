<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Registry;
use App\Models\CustomService;

class RegistryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $custom_service = CustomService::with(['user','category'])->findOrFail($id);
        
        return view('admin.registry_services.show', compact('custom_service')); 
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
        $custom_service = CustomService::findOrFail($id);
        $categories = Category::whereNull('deleted_at')->get();
        
        return view('admin.registry_services.edit', compact('custom_service','categories'));
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
            'user_id'
        ]);
        $data['status'] = $request->status ? 1 : 0;

        $custom_service = CustomService::where('id', $id)->update($data);
            return redirect('admin/user/'. $request->user_id.'/custom_services')
            ->with('success', 'Service has been updated successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        CustomService::where('id', $id)->delete();

        return redirect('admin/user/'. $request->user_id.'/custom_services')
            ->with('success', 'Service was removed successfully!');
    }
}
