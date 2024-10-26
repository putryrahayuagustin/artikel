<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function login(Request $request): JsonResponse
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $user = User::where('email', $request->email)->first();

        //cek jika tidak ada pengguna
        if (!$user) {
            return $this->sendError('404', 'Not Found');
        }

        // Memverifikasi password
        if (!Hash::check($request->password, $user->password)) {
            return $this->sendError('401', 'Unauthorized'); // Jika password tidak cocok
        }


        $token = $user->createToken('TokoSkincare')->plainTextToken;
        $name =  $user->name;


        return $this->sendResponse(['token' => $token, 'name' => $name], 'Login successful');
    }
}
