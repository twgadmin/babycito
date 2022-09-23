<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CustomService;
use App\Models\User;
use Auth;

class CategoryController extends Controller
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
        $data = Category::whereNull('deleted_at')->get();

        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('admin.category.create', compact('categories'));
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
            'category_name' => 'required|max:80',
            'slug' => 'required',
        ];
    
        $customMessages = [
            'required' => ':attribute field is required.'
        ];
    
        $this->validate($request, $rules, $customMessages);
        $category = new Category;
        $category->name = $request->category_name;
        $category->slug = $request->slug;
        $category->user_id = Auth::id();
        $category->save();
        
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category has been created successfully.');
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
        $categories = Category::findOrFail($id);

        return view('admin.category.show', compact('categories'));
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
        $categories = Category::findOrFail($id);

        return view('admin.category.edit', compact('categories'));
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
            'category_id'
        ]);

        $rules = [
            'category_name' => 'sometimes|max:80',
            'slug' => 'sometimes',
        ];
    
        $customMessages = [
            'sometimes' => ':attribute field is required.'
        ];
    
        $this->validate($request, $rules, $customMessages);
        $category = Category::findOrFail($id);
        $category->name = isset($request->category_name) ? $request->category_name : $category->name ;
        $category->slug = isset($request->slug) ? $request->slug : $category->slug;
        $category->user_id = Auth::id();
        $category->save();
        
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category has been updated successfully.');
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
        $custom_services = CustomService::where('category_id',$id)->get();
        $custom_services->each->delete();
        Category::where('id', $id)->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category was removed successfully!');
    }
}
