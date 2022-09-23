<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\CustomService;
use App\Models\User;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Registry;
use App\Models\UserMediaFile;
use Auth;

class CustomServicesController extends Controller
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
        $user = User::findOrFail(Auth::id());
        $usermediaFile = UserMediaFile::where('user_id',Auth::id())->whereNull('deleted_at')->get();
        if($request->user()->user_type == 2){
            if(empty($user->services_title) || empty($user->services_body)  || empty($user->meta_description) || empty($user->services_image) || count($usermediaFile) < 1){
                return redirect()->back()->with('error', 'Please complete your profile to continue.' );
            }
        }
        else{
            if(empty($user->services_title) || empty($user->services_body)  || empty($user->meta_description) || empty($user->services_image)){
                return redirect()->back()->with('error', 'Please complete your profile to continue.' );
            }
        }
        
        $data = $request->except([
            '_token',
            '_method',
        ]);

        if($user->user_type=='1'){
            $rules = [
                'services_title' => 'required|max:80',
                //'amount' => 'required|numeric|min:1',
                'category' => 'required',
                'qty' => 'required'
            ];
        }else{
            $rules = [
                'services_title' => 'required|max:80',
                //'amount' => 'required|numeric|min:1',
                'category' => 'required',
            ];
        }

        $customMessages = [
            'required' => ':attribute field is required.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        /*for ($i=1; $i<=$request->qty; $i++) {} */

                $custom_service = new CustomService;
                $custom_service->services_title = $request->services_title;
                $custom_service->amount = $request->amount;
                $custom_service->description = $request->description;
                if($user->user_type == 2){
                    $custom_service->show_amount = ($request->show_amount ? 1 : 0);
                }
                
                if($user->user_type=='1'){
                    $custom_service->qty = $request->qty;    
                }else{
                    $custom_service->qty = 1;
                }
                
                $custom_service->status = 1;

                if ($request->hasFile('filename')) {
                    if (!empty($request->previous_image)) {
                        if (!empty($request->previous_image) && file_exists(uploadsDir('front/custom_services/registry_images') . $request->previous_image)) {
                            unlink(uploadsDir('front/custom_services/registry_images') . $request->previous_image);
                        }
                    }

                    @mkdir(uploadsDir('front/custom_services/registry_images'), 0755, true);

                    // move/upload file on server
                    $photo              = $request->file('filename');
                    $extension          = $photo->getClientOriginalExtension();
                    // getting file extension
                    $filename           = 'registry-' . time() . '.' . $extension;
                    $photo->move(uploadsDir('front/custom_services/registry_images'), $filename);
                    $custom_service->filename = $filename;
                }else{

                    if (!empty($request->previous_filename)) {
                        $custom_service->filename = $request->previous_filename;
                    }
                    
                }         

                $custom_service->vendor_id = Auth::id();
                $custom_service->save();
                
                if(isset($custom_service->id)){
                    $custom_service->categoryCustomService()->attach($request->category);
                }

                if($request->user()->user_type == 1){
                    $registry = new Registry;
                    $registry->user_id = $request->user()->id;
                    $registry->services_id = $custom_service->id;
                    $registry->status = 1;
                    $registry->save();
                }
        
        
                if($request->user()->user_type == 1){
                    return redirect('view-registry')->with('success', 'Your service has been added.');
                }else{
                    return redirect('services')->with('success', 'Your service has been added.');                    
                }

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
        $userdetail = User::where('id',Auth::id())->first();
        $users = User::where('user_type',2)->where('approved',1)->get();
        $custom_service = CustomService::findOrFail($id);
        $selected_category = $custom_service->categoryCustomService()->pluck('category_id')->toArray();
        $categories = Category::whereNull('deleted_at')->get();        
        return view('front.pages.custom_services.edit', compact('custom_service','categories','users','selected_category','userdetail'));
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
        $userdetail = User::where('id',Auth::id())->first();
        //
        $data = $request->except([
            '_token',
            '_method'
        ]);

        $custom_service = CustomService::findOrFail($id);
        $custom_service->services_title = isset($request->services_title) ? $request->services_title : $custom_service->services_title;
        $custom_service->amount = isset($request->amount) ? $request->amount : $custom_service->amount;
        $custom_service->description = isset($request->description) ? $request->description : $custom_service->description;
        if($userdetail->user_type=='2'){
            $custom_service->show_amount = isset($request->show_amount) ? 1 : 0;            
        }       
        $custom_service->vendor_id = Auth::id();
        if ($request->hasFile('filename')) {
            if (!empty($request->previous_image)) {
                if (!empty($request->previous_image) && file_exists(uploadsDir('front/custom_services/registry_images') . $request->previous_image)) {
                    unlink(uploadsDir('front/custom_services/registry_images') . $request->previous_image);
                }
            }

            @mkdir(uploadsDir('front/custom_services/registry_images'), 0755, true);

            // move/upload file on server
            $photo              = $request->file('filename');
            $extension          = $photo->getClientOriginalExtension();
            // getting file extension
            $filename           = 'registry-' . time() . '.' . $extension;
            $photo->move(uploadsDir('front/custom_services/registry_images'), $filename);
        }
        $custom_service->filename = isset($filename) ? $filename : $custom_service->filename;
        $custom_service->save();
        $custom_service->categoryCustomService()->sync($request->category);
        if(Auth::user()->user_type == 1){
            return redirect('view-registry')
            ->with('success', 'Service has been updated successfully.');
        }
        else{
            return redirect('services')
            ->with('success', 'Service has been updated successfully.');
        }
        
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
        CustomService::where('id', $id)->delete();

        return redirect('admin/vendors/'. $request->vendor_id.'/custom_services')
            ->with('success', 'Service was removed successfully!');
    }


    public function serviceListing()
    {

        $custom_services = CustomService::where('vendor_id',Auth::id())->whereNull('deleted_at')->get();
        $userMediaFiles = UserMediaFile::where('user_id',Auth::id())->whereNull('deleted_at')->get();
        return view('front.pages.custom_services.listing',compact('custom_services','userMediaFiles'));
    }

    public function categoryListing(Request $request,$slug)
    {
        // return $slug;
        $check = false;
        $banner = Banner::find(1);
        $categories = Category::whereNull('deleted_at')->orderBy('name')->get();
        $category = Category::where('slug',$slug)->whereNull('deleted_at')->pluck('id');

        $custom_services = CustomService::whereHas('categoryCustomService',function($query) use ($category){
                            return $query->whereIn('category_id',$category);
                        })->where('status',1)
                        ->whereHas('user',function($q){
                            return $q->where('user_type',2)->where('approved',1);
                        })->with('user')
                        ->groupBy('vendor_id')->whereNull('deleted_at')->get();

        return view('front.pages.providers',compact('categories','custom_services','banner'));
    }

    public function addtoregistry(Request $request){
        $user = User::findOrFail(Auth::id());
        $registry_check=[];
        /*if(!$user->stripe_code){

             return redirect('view-registry')
            ->with('error', 'Please connect the stripe account first');

        }*/
        $data = $request->except([
            '_token',
            '_method',
        ]);
        $registry_check = Registry::where('services_id',$request->services_id)->where('user_id',$request->user()->id)->first();

        if(isset($registry_check)&&$registry_check->qty>=10){
            return redirect('view-registry')
            ->with('error', 'This service is already added 10 times in your registry.');           
        }
        else{                           
            if(isset($registry_check)){
                    $qty_remain = 10-$registry_check->qty;
                Registry::where(['user_id'=>$request->user()->id,'services_id'=>$request->services_id])->update(['qty' => (($qty_remain>$request->qty)? ($registry_check->qty+$request->qty) :($registry_check->qty+$qty_remain))]);
            }else{
                    $qty_remain = 10-(isset($registry_check)? $registry_check->qty : 0);
                    //for ($i=1; $i <= (($qty_remain>$request->qty)? $request->qty :$qty_remain); $i++) {
                    $registry = new Registry;
                    $registry->user_id = $request->user()->id;
                    $registry->services_id = $request->services_id;
                    $registry->qty = (($qty_remain>$request->qty)? $request->qty :$qty_remain);
                    $registry->status = 1;
                    $registry->save();
                    //}
            }    
            return redirect('view-registry')
            ->with('success', 'Your registry has been added successfully.');
        }        
    }

    public function registryUpdate(Request $request,$id){
        print_r($id);
    }

    
}
