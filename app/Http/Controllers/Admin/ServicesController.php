<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceSection;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth:admin');
    } 
    
    public function index(){
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if($id == 4 || $id == 5){
            $services = Service::findOrFail($id);
        }
        else{
            $services = Service::whereHas('serviceSection',function($query) use($id){
                return $query->where('service_id',$id);
            })->findOrFail($id);
        }
        return view('admin.services.show', compact('services'));
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
        if($id == 4 || $id == 5){
            $data = Service::findOrFail($id);
        }
        else{
            $data = Service::whereHas('serviceSection',function($query) use($id){
                return $query->where('service_id',$id);
            })->findOrFail($id);
        }
        
        return view('admin.services.edit', compact('data'));
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
            'service_id'
        ]);
        
        $services = Service::find($id);
        $services->title = isset($request->title) ? $request->title : $services->title;
        $services->body = isset($request->body) ? $request->body : $services->body;
        $services->save();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Services updated sucessfully.');
    }

    

}
