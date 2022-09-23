<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceSection;

class ServiceSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
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
        $data = ServiceSection::findOrFail($id);
        
        return view('admin.service_sections.show', compact('data'));
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
        $data = ServiceSection::findOrFail($id);

        return view('admin.service_sections.edit', compact('data'));
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
            '_token',
            '_method',
            'service_sections_id'
        ]);
        if($id == 6 || $id == 7 || $id == 8){
            $character_count = strlen(strip_tags($request->content));
            if($character_count > 80){
                $rules = [
                    'content' => 'required|max:80',
                ];
            
                $customMessages = [
                    'required' => 'The :attribute must not be greater than 80 characters.'
                ];
            
                $this->validate($request, $rules, $customMessages);
            }
            
        }
        $service_section = ServiceSection::find($id);
        $service_section->service_id = $service_section->service_id;
        $service_section->title = isset($request->title) ? $request->title : $service_section->title;
        $service_section->body = isset($request->content) ? $request->content : $service_section->body;
        $service_section->save();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Services updated sucessfully.');
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
