<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomService;
use Mail;


class UsersController extends Controller
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
        $data = User::where(['user_type' => 1])->get();

        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        $email = $data['email'];

        Mail::send(
            'emails.admin.userAccountCreated', 
            [
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'email'      => $data['email'],
                'password'   => $data['password'],
                'user_type'  => 'User',
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

        $data['password']  = bcrypt($data['password']);
        $data['user_type'] = 1;

        User::create($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User has been added successfully.');
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
        
        return view('admin.users.show', compact('data'));
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

        return view('admin.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
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
                    'user_type'  => 'User',
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
            ->route('admin.users.index')
            ->with('success', 'User updated sucessfully.');
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
            ->route('admin.users.index')
            ->with('success', 'User was removed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, Requests $request)
    {
        //User::where('id', $id)->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User status changed successfully!');
    }


    public function listing($id)
    {
        $user = User::where('user_type',1)->where('approved',1)->findOrFail($id);
        $custom_services = CustomService::where('vendor_id',$id)->whereNull('deleted_at')->get();

        return view('admin.registry_services.user_listing', compact('user','custom_services','id'));
    }

    public function registryListing($id)
    {
        $user = User::findOrFail($id);

        return view('admin.registries.user_listing', compact('user','id'));
    }
}
