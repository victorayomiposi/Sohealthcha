<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department\SelectCourse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        $Department = SelectCourse::all();
        return view('admin.user.create', compact('Department'));
    }

    public function view()
    {
        $adminuser = User::with('department')->get();
        return view('admin.user.view', compact('adminuser'));
    }

    public function edit($id)
    {
        $User = User::find($id);
        $Department = SelectCourse::all();
        return view('admin.user.edit', compact('Department', 'User'));
    }

    public function save_user(Request $request)
    {
        // Validation rules
        $rules = [
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'type' => 'required|in:Non-Academic,Academic',
            'depertment_id' => 'required|exists:departments,id',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Check if the username already exists
        $userExist = User::where('username', $validatedData['username'])->first();
        if ($userExist) {
            return back()->with('error', $validatedData['username'] . ' already exists');
        }

        // Create the user
        $user = User::create([
            'fullname' => $validatedData['fullname'],
            'username' => $validatedData['username'],
            'type' => $validatedData['type'],
            'depertment_id' => $validatedData['depertment_id'],
            'email' => $validatedData['email'],
            'status' => 1,
            'whoami' => 0,
            'login_count' => 0,
            'password' => Hash::make($validatedData['password']),
        ]);

        if ($user) {
            return back()->with('success', 'User created successfully');
        }

        return back()->with('error', 'An error occurred while creating the user');
    }


    public function update_user(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'type' => 'required|in:Non-Academic,Academic',
            'depertment_id' => 'required|exists:course_selection,id',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->type = $request->type;
        $user->depertment_id = $request->depertment_id;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            return redirect()->route('view_user')->with('success', 'User updated successfully');
        }

        return back()->with('error', 'An error occurred while updating the user');
    }




    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return back()->with('success', 'User deleted successfully');
        }

        return back()->with('error', 'An error occurred while deleting the user');
    }
}
