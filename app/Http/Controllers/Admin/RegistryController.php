<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Registry;
use App\Models\CustomService;

class RegistryController extends Controller
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        $user_id = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d','default');
        $custom_service = CustomService::findOrFail($id);
        $categories = Category::whereNull('deleted_at')->get();
        
        return view('admin.registries.edit', compact('custom_service','categories','user_id'));
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

        $custom_service = Registry::where('services_id', $id)->where('user_id',$request->user_id)->update($data);
            return redirect('admin/user/'. $request->user_id.'/registries')
            ->with('success', 'Registry has been updated successfully.');
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
        $registry = Registry::where('services_id', $id)->where('user_id',$request->user_id)->delete();
            return redirect('admin/user/'. $request->user_id.'/registries')
            ->with('success', 'Registry has been updated successfully.');
    }
}
