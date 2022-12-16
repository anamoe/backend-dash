<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    
    public function getRandomString($panjang = 30)
    {
        $karakter = '0123456789abcdefghiklmnopqrstuvwxyz';
        $panjang_karakter = strlen($karakter);
        $randomString = '';
        for ($i = 0; $i < $panjang; $i++) {
            $randomString .= $karakter[rand(0, $panjang_karakter - 1)];
        }
        return $randomString;
    }

    public function register(Request $request){
        $random = $this->getRandomString();

        $users = User::where('email', $request->email)->whereIn('role',['user'])->first();
 
        if ($users) {
               
            return response()->json([
                'pesan' => 'gagal',
                'message' => "Email sudah terdaftar",
            ]);
           
        }else{

            $req = $request->all();
            $req['password'] = bcrypt($request->password);
            $req['api-token']= $random;
            $req['role'] ='user';



            $u = User::create($req);
            return response()->json([
                'pesan' => 'sukses',
                'user' => $u
            ]);
        

        }


    }

    public function login(Request $request){

        $users = User::where('email', $request->email)->whereIn('role',['user'])->first();
        $random = $this->getRandomString();

   

        if ($users) {
            if (password_verify($request->password, $users->password)) {
               
                $users->update([
                    'api-token' => $random
                ]);

                return response()->json([
                    'pesan' => 'sukses',
                    'user' => $users
                ]);
            }

            return response()->json([
                'pesan' => 'gagal, password anda salah',
                'message' => "Kata sandi salah",
            ]);
        }

        return response()->json([
            'pesan' => 'gagal. Email tidak terdaftar',
            'message' => "Email tidak terdaftar",
        ]);

    }
}
