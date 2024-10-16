<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // تحقق من صحة المدخلات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6',
            'DOB' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // إنشاء مستخدم جديد
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'DOB' => $request->DOB,
            'gender' => $request->gender,
        ]);

        return response()->json(['message' => 'تم تسجيل المستخدم بنجاح!', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        // تحقق من صحة المدخلات
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // تحقق من صحة بيانات المستخدم
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'بيانات الاعتماد غير صحيحة.'], 401);
        }
    }
}

