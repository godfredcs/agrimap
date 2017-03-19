<?php

namespace App\Http\Controllers;

use Validator;
use Hash;
use Auth;
use URL;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\UserStatus;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Create a new users controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verify_activation', ['except' => ['activate', 'updatePassword']]);
        $this->middleware('redirect_if_activated', ['only' => ['activate', 'updatePassword']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $statuses = UserStatus::all();

        $users = User::with('role', 'status');

        if ($request->has('role')) {
            $users->where('role_id', $request->role);
        }

        if ($request->has('status')) {
            $users->where('status_id', $request->status);
        }

        $users = $users->orderBy('name', 'asc')->paginate(20);

        if ($request->ajax()) {
            return view('users.table', [
                'users'     => $users, 
                'roles'     => $roles,
                'role_id'   => $request->has('role') ? $request->role : '', 
                'statuses'  => $statuses,
                'status_id' => $request->has('status') ? $request->status : '',
            ])->render();
        }

        return view('users.index', [
            'users'     => $users, 
            'roles'     => $roles,
            'role_id'   => $request->has('role') ? $request->role : '', 
            'statuses'  => $statuses,
            'status_id' => $request->has('status') ? $request->status : '',
        ])->render();
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|min:3',
            'name' => 'required|min:2|max:255',
            'password' => 'required|confirmed',
            'role_id' => 'required'
        ];

        $errorMessages = [
            'role_id.required' => 'The user role field is required.',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules, $errorMessages);

        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        $data['status_id'] = UserStatus::where('name', 'Pending Activation')->first()->id;
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id='')
    {
        // This is for manage users page
        if ($request->Ajax()) {
            $user = User::find($id);
            $isActivated = $user->isActivated();

            if (is_null($user)) {
                return ['errors' => ['There is no user with such ID']];
            }

            return [
                'user' => $user, 
                'isActivated' => $isActivated
            ];
        }

        // This is for my account page
        $user = User::find(Auth::user()->id);

        return view('users.edit', compact('user'));
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
        $user = User::find($id);

        if (is_null($user)) {
            return redirect()->back()->withErrors('There is no user with such ID.');
        }

        $rules = [
            'name' => 'required|max:255',
        ];

        if ($request->exists('role_id')) {
            $rules['role_id']  = 'required';
        }

        if ($request->exists('status_id')) {
            $rules['status_id'] = 'required';
        }
        
        // If user wants to change password validate it
        if ($request->has('password')) {
            $rules['password'] = 'required|confirmed|min:6';

            if (!$request->has('admin_edit')) {
                $rules['old_password'] = 'required'; 
            }
        }

        if ($request->has('email')) {
            $rules['email'] = 'email';
        }

        // These are the special error messages for the new password
        $errorMessages = [
            'password.required' => 'The new password field is required.',
            'role_id.required' => 'The user role field is required.',
            'status_id.required' => 'The user status field is required.',
            'password.confirm'  => 'The new password confirmation does not match.',
            'password.min'      => 'The new password must be at least 6 characters.',
            'old_password.required' => 'The current password field is required.',
        ];

        // Validating the request
        $validator = Validator::make($request->all(), $rules, $errorMessages);

        // If validations fail go back to the form with the errors
        if ($validator->fails()) {
            if ($request->ajax()) {
                return ['errors' => $validator->messages()];
            }

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        // If user wants to change either the password
        if ($request->has('password')) {
            //Check by password
            if ($request->has('old_password')) {
                if (!Hash::check($request->input('old_password'), $user->password)) {
                    if ($request->ajax()) {
                        return ['errors' => ['Specified current password is invalid']];
                    }

                    // Redirect the user back to the previous route with the error status
                    return redirect()->back()->withErrors('Specified current password is invalid.');
                }
            }
        }

        /*
         * Assigning the user attributes with the sent request
         * Checking their existence and making sure they are not empty. This
         * is done to prevent errors when using mass assignment. 
         */
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('role_id')) {
            $user->role_id = $request->role_id;
        }

        if ($request->has('status_id')) {
            $user->status_id = $request->status_id;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        // Updating the user's account
        $user->save();

        if ($request->ajax()) {
            return;
        }
    
        // Return back to the previous page with session success
        return redirect()->back()->with('status', 'Account was updated successfully.');
    }

    /**
     * Display user activation form
     * 
     * @return \Illuminate\Http\Response
     */
    public function activate()
    {
        return view('auth.activate');
    }

    public function updatePassword(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'username' => 'required|min:3',
            'name' => 'required|min:2|max:255',
            'password' => 'required|confirmed',
        ]);

        // Update user account
        Auth::user()->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'status_id' => UserStatus::where('name', 'Active')->first()->id,
        ]);

        return redirect()->intended();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return ['errors' => ['There is no user with such ID.']];
        }

        $user->status_id = UserStatus::where('name', 'Inactive')->first()->id;
        $user->save();

        return;
    }
}
