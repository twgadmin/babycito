<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Http\Requests\Admin\Faq\Store;
use App\Http\Requests\Admin\Faq\Update;

class FaqController extends Controller
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
        $data = Faq::whereNull('deleted_at')->get();
        return view('admin.faq.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Faq::where('is_active',1)->get();

        return view('admin.faq.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        $data['is_active'] = (isset($request->is_active) && $request->is_active == 1) ? $request->is_active : 0;

        Faq::create($data);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'Faq has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Faq::findOrFail($id);
        
        return view('admin.faq.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Faq::findOrFail($id);

        return view('admin.faq.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'faq_id'
        ]);

        $faq = Faq::find($id);


        $data['is_active'] = (isset($request->is_active) && $request->is_active == 1) ? $request->is_active : 0;

        Faq::where('id', $id)->update($data);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'Page updated sucessfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faq::where('id', $id)->delete();

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'Faq removed successfully!');
    }
}
