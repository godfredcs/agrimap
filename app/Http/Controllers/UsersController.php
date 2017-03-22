<?php

namespace App\Http\Controllers;

use App\Models\User;

use Hash;
use Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id)
    {
    	$user = User::find($id);

    	return view('users.my_account', compact('user'));
    }

    /**
     * Update the profile of speicifed user.
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
        
        // If user wants to change password validate password
        if ($request->has('password') && $request->password == "") {
            $rules['password'] = 'required|confirmed|min:6';

            if (!$request->has('admin_edit')) {
                $rules['old_password'] = 'required'; 
            }
        }

        // If user wants to change username, validate password
        if($request->has('username_edited') && $request->username_edited == 'true'){
        	$rules['old_password'] = 'required';
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

        // If user wants to change the either the password or username
        if ($request->has('password') || $request->username_edited == 'true') {
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
        if($request->has('username')){
        	$user->username = $request->username;
        }

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
}
