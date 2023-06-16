<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\infoprofile;

class ProfileController extends Controller
{
    //authorize session from user type
    public function loadProfile($id)
    {
        $category = Auth::user()->category;
        $user = User::find($id);

        if ($category == 'Student') {
            return view('profile.studentprofile', ['user' => $user]);
        }
        if ($category == 'Staff') {
            return view('profile.staffprofile', ['user' => $user]);
        }
        if ($category == 'Admin') {
            //dd(Auth::user()->id);
            return view('profile.adminprofile', ['user' => $user]);
        }
        
    }

    public function updateProfile(Request $request, $id) //request apa value input from user untk update, insert
    {
        $user = User::find($id);

        $oldPassword = $request->input('oldPsw');

        if (password_verify($oldPassword, $user->password)) {
            // The old password is correct

            $newPassword = $request->input('newPsw');
            $confirmPassword = $request->input('confirmPsw');

            if ($newPassword === $confirmPassword) {
            // The new password matches the confirmed password
                $user->password = bcrypt($newPassword);

            // Proceed with updating other attributes and saving the profile picture
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->numPhone = $request->input('numPhone');
                $user->matric = $request->input('matric');
                $user->course_group = $request->input('course');

                if ($request->hasFile('image'))
                {
                    $user->profilePic = $request->file('image');

                    // Renaming and storing the profile picture file
                    $filename = time() . '.' . $user->profilePic->getClientOriginalExtension();
                    $request->image->move('assets', $filename);
                    $user->profilePic = $filename;
                }

                $user->update();
        
                return redirect()->back()->with('message', 'Profile Updated Successfully');
            } else {
            // The new password and confirm password do not match
                return redirect()->back()->with('error', 'New password and confirm password do not match. Profile update failed.');
            }
        } else {
            // The old password is incorrect
            return redirect()->back()->with('error', 'Incorrect old password. Profile update failed.');
        }
    }

    public function updateProfileAdmin(Request $request, $id) //request apa value input from user untk update, insert
    {
        $user = User::find($id);

        $oldPassword = $request->input('oldPsw');

        if (password_verify($oldPassword, $user->password)) {
            // The old password is correct

            $newPassword = $request->input('newPsw');
            $confirmPassword = $request->input('confirmPsw');

            if ($newPassword === $confirmPassword) {
            // The new password matches the confirmed password
                $user->password = bcrypt($newPassword);

            // Proceed with updating other attributes and saving the profile picture
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->numPhone = $request->input('numPhone');
                $user->matric = $request->input('matric');

                if ($request->hasFile('image'))
                {
                    $user->profilePic = $request->file('image');

                    // Renaming and storing the profile picture file
                    $filename = time() . '.' . $user->profilePic->getClientOriginalExtension();
                    $request->image->move('assets', $filename);
                    $user->profilePic = $filename;
                }

                $user->update();
        
                return redirect()->back()->with('message', 'Profile Updated Successfully');
            } else {
            // The new password and confirm password do not match
                return redirect()->back()->with('error', 'New password and confirm password do not match. Profile update failed.');
            }
        } else {
            // The old password is incorrect
            return redirect()->back()->with('error', 'Incorrect old password. Profile update failed.');
        }
    }
}
