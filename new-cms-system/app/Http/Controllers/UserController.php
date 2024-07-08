<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function index(){
        $users = User::all();
        return view("admin.users.index",compact("users"));
    }
    public function show($id){
        $user = User::findOrFail($id);
        $this->authorize('view', $user);
        $roles = Role::all();
        return view("admin.users.profile", compact(["user","roles"]));
    }

    
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validate the request data
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required', 
            'string', 
            'email', 
            'max:255', 
            'unique:users,email,' . $user->id // Ignore the current user's email
        ],
        'avatar' => [
            'nullable', 
            'image', // Validating it as an image file (JPEG, PNG, BMP, GIF, or SVG)
            'max:2048' // Limit size to 2MB
        ],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        'username' => [
            'required', 
            'string', 
            'max:50', 
            'min:3', 
            'unique:users,username,' . $user->id, // Ignore the current user's username
            'regex:/^[a-zA-Z0-9_]+$/' // Alphanumeric and underscores only
        ],
    ]);

    // Update user details
    $user->fill([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'username' => $validatedData['username'],
    ]);

    // Handle avatar upload
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $name = time() . '_' . $file->getClientOriginalName(); // Unique file name with timestamp
        $file->move(public_path('images'), $name);
        $user->avatar = '/images/' . $name;
    }

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    // Save the updated user information
    $user->save();

    // Set a flash message
    Session::flash('profile-update-message', 'User profile updated successfully');

    // Redirect with success message
    return redirect('/admin')->with('success', 'User profile updated successfully');
}

public function attach($userid){
    $user = User::find($userid);
    $user->roles()->attach(request('role'));
    // $user->save();
    return redirect(route('user.profile.show',$user->id))->with('success','');

}

public function destroy($id){
    $user = User::findOrFail($id);
    if(Auth::user()->userHasRoles('Admin') || Auth::user()->id===$id){
        $user->delete();
        Session::flash('user-deleted-message','user deleted successfully');
    }
    else{
        Session::flash('not-authorized-message','you are not authorized to delete user');
    }
    return redirect('/admin/users');
}

public function detach($userid){
    $user = User::findOrFail($userid);

    $user->roles()->detach(request('role'));
    // $user->save();
    return redirect(route('user.profile.show',$user->id))->with('success','');
}
}