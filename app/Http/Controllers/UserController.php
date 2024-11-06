<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
    public function addMentor(Request $request) {
        $request->validate([
            'nama_user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $filePath = public_path('uploads');
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName= $request->file('image')->move($filePath, $imageName);
            $imageName = basename($imageName);
        }
        

        
        

        $user = User::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
            'last_accesed' => now(),
        ]);

        $user->assignRole('mentor');
        session()->flash('success', 'Mentor added successfully!');


        return redirect('/managae_users' );
    }

    public function addStudent(Request $request) {
        $request->validate([
            'nama_user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $filePath = public_path('uploads');
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Get the extension of the uploaded image
            $request->file('image')->move($filePath, $imageName);
        }
        

        $user = User::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
            'last_accesed' => now(),
        ]);

        $user->assignRole('student');
        session()->flash('success', 'Student added successfully!');


        return redirect('/managae_users' );
    }

    public function allUser()
    {
        $users = User::with('roles')->latest()->paginate(5);
        // dd($users);
        return view('admins.managae_users', compact('users'));
    }




    public function singleUser($id)
    {
        $user = User::find($id);
        return view('admins.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image
        ]);
    
        $user = User::findOrFail($id);
        $user->nama_user = $request->nama_user;
        $user->email = $request->email;
    
        // Check for a new image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image) {
                // Delete old image from public/uploads
                File::delete(public_path('uploads/' . $user->image));
            }
    
            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $user->image = $imageName; // Update image field in user record
        }
    
        $user->save(); // Save user updates
    
        session()->flash('success', 'User updated successfully!');
        return redirect('/managae_users'); // Adjust redirect as needed
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        File::delete(public_path('uploads/'. $user->image));

        $user->delete();
        session()->flash('success', 'User '. $user->nama_user .' Hass Been Deleted');
        return redirect('/managae_users');
    }
}
