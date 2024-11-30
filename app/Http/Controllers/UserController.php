<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::with('roles')->get();
    }
    public function update(Request $request, User $user)
    {
        switch ($request->role){
            case "Admin":
                $user->syncRoles('Admin');
                return 'This user is Admin';
                break;
            case "Visitor":
                $user->syncRoles('Visitor');
                return 'This user is Visitor';
                break;
            default:
                return 'sth went wrong';
        }
    }

    public function verify(Request $request)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'phone' => 'required|iran_mobile:true',
        ],[
            'phone.required' => 'phone number is required',
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $verify = Verify::create([
                'phone' => $request->phone,
                'code' => '1111'
            ]);
            return $verify->code;
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
}
