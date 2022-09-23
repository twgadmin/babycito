<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CustomService;
use App\Models\Category;
use App\Models\User;
use Auth;

class CustomServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //\
        $users = User::where('user_type',2)->where('approved',1)->get();
        $categories = Category::whereNull('deleted_at')->get();
        return view('admin.custom_services.create', compact('users','categories'));

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
        $data = $request->except([
            '_token',
            '_method',
        ]);

        $rules = [
            'services_title' => 'required|max:80',
            //'amount' => 'required|numeric|min:1',
            'category' => 'required',
            'vendor' => 'required'
        ];
    
        $customMessages = [
            'required' => ':attribute field is required.'
        ];
        $this->validate($request, $rules, $customMessages);
        $custom_service = new CustomService;
        $custom_service->services_title = $request->services_title;
        $custom_service->show_amount = ($request->show_amount ? 1 : 0);
        $custom_service->amount = $request->amount;
        $custom_service->description = $request->description;
        $custom_service->vendor_id = $request->vendor;
        $custom_service->status = 1;
        $custom_service->save();
        if(isset($custom_service->id)){
            $custom_service->categoryCustomService()->attach($request->category);
        }

        // $custom_service->category_id = $request->category;
        
        return redirect('admin/vendors/'. $request->vendor.'/custom_services')
            ->with('success', 'New Service has been created successfully.');
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
        
        return view('admin.custom_services.show', compact('custom_service'));  
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
        $users = User::where('user_type',2)->where('approved',1)->get();
        $custom_service = CustomService::findOrFail($id);        
        $selected_category = $custom_service->categoryCustomService()->pluck('category_id')->toArray();        
        $categories = Category::whereNull('deleted_at')->get();        
        return view('admin.custom_services.edit', compact('custom_service','categories','users','selected_category'));
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
            '_method'
        ]);

        $data['status'] = $request->status ? 1 : 0;
        $data['show_amount'] = $request->show_amount ? 1 : 0;
        $custom_service = CustomService::find($id);
        $custom_service->services_title = isset($request->services_title) ? $request->services_title : $custom_service->services_title;
        $custom_service->show_amount = $data['show_amount'];
        $custom_service->amount = isset($request->amount) ? $request->amount : $custom_service->amount;
        $custom_service->description = isset($request->description) ? $request->description : $custom_service->description;
        $custom_service->vendor_id = isset($request->vendor) ? $request->vendor : $custom_service->vendor_id;
        $custom_service->status = $data['status'];
        $custom_service->save();
        $custom_service->categoryCustomService()->sync($request->category);
        
        return redirect('admin/vendors/'. $data['vendor_id'].'/custom_services')
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

        return redirect('admin/vendors/'. $request->vendor_id.'/custom_services')
            ->with('success', 'Service was removed successfully!');
    }
}
