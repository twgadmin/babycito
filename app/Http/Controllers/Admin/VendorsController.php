<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreVendorRequest;
use App\Http\Requests\Admin\UpdateVendorRequest;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomService;
use Mail;


class VendorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where(['user_type' => 2])->get();

        return view('admin.vendors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method',
        ]);

        $email = $data['email'];
        
        Mail::send(
            'emails.admin.userAccountCreated',
            [
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'email'      => $data['email'],
                'password'   => $data['password'],
                'user_type'  => 'Vendor',
            ],
            function ($message) use ($email) {

                $email = $email;
                $message->to($email, $email);
                if (config('mail.bcc.address') != '') {
                    $message->bcc(config('mail.bcc.address'), config('mail.bcc.name'));
                }

                $message->replyTo(config('mail.from.address'), config('mail.from.name'));
                $subject = "Account Created.";
                $message->subject($subject);
            }
        );

        $data['password'] = bcrypt($data['password']);
        $data['user_type'] = 2;

        User::create($data);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);        
        return view('admin.vendors.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);

        return view('admin.vendors.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            $request->password ? '' : 'password'
        ]);


        if ($request->password) {

            $email = $data['email'];

            Mail::send(
                'emails.admin.userPasswordChanged', 
                [
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'email'      => $data['email'],
                    'password'   => $data['password'],
                    'user_type'  => 'Vendor',
                ],
                function ($message) use ($email) {

                    $email = $email;
                    $message->to($email, $email);
                    if (config('mail.bcc.address') != '') {
                        $message->bcc(config('mail.bcc.address'), config('mail.bcc.name'));
                    }

                    $message->replyTo(config('mail.from.address'), config('mail.from.name'));
                    $subject = "Password Changed.";
                    $message->subject($subject);
                }
            );

            $data['password'] = bcrypt($request->password);
        }

        $data['approved'] = $request->approved == "on" ? 1 : 0;
        $data['approved_at'] = date("Y-m-d H:i:s");

        User::where('id', $id)->update($data);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor updated sucessfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor was removed successfully!');
    }


    public function listing($id)
    {
        User::where('user_type',2)->where('approved',1)->findOrFail($id);
        $custom_services = CustomService::where('vendor_id',$id)->whereNull('deleted_at')->get();

        return view('admin.custom_services.index', compact('custom_services','id'));
    }
}
