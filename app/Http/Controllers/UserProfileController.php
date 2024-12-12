<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

enum Gender
{
    case male;
    case female;
}

class UserProfileController extends Controller
{
    public function get(Request $request){
        $user = auth()->user();
        $profile = $user->profile;
        return response()->json(compact('profile'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_pic' => 'string|max:255|nullable',
            'bio' => 'required|string|max:160|nullable',
            'gender' => [Rule::enum(Gender::class), 'nullable'],
        ]);

        $user = auth()->user();

        $user->profile->update([
            "profile_pic"=>$request->get('profile_pic'),
            "bio"=>$request->get('bio'),
            "gender"=>$request->get('gender'),
        ]);

        $profile = $user->profile;

        return response()->json(compact('profile'));
    }
}
