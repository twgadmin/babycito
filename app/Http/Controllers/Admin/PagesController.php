<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\MediaFile;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StorePageRequest;
use App\Http\Requests\Admin\UpdatePageRequest;

class PagesController extends Controller
{
    private $pageRepository;
    private $mediaFileRepository;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Page::all();

        return view('admin.pages.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mediaFile = MediaFile::all();

        return view('admin.pages.create', compact('mediaFile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        $data['is_system_page'] = (isset($request->is_system_page) && $request->is_system_page == 1) ? $request->is_system_page : 0;

        Page::create($data);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Page::getPageDetailsWithMedia(['pages.id' => $id]);
        
        return view('admin.pages.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Page::getPageDetailsWithMedia(['pages.id' => $id]);
        $mediaFiles = MediaFile::all();

        return view('admin.pages.edit', compact('data', 'mediaFiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'page_id'
        ]);

        $page = Page::find($id);

        // Slug of seeder based pages, need not to update,
        // as they are created from seeder.
        if ($page->is_system_page == '1') {
            unset($data['slug']);
        }

        $data['is_system_page'] = (isset($request->is_system_page) && $request->is_system_page == 1) ? $request->is_system_page : 0;

        Page::where('id', $id)->update($data);

        return redirect()
            ->route('admin.pages.index')
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
        Page::where('id', $id)->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page was removed successfully!');
    }
}
