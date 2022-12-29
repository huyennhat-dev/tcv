<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Rating;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $email = $request->email;
        $pass  = md5($request->password);
        $checkEmail = Account::where('email', $email)->first();
        if ($checkEmail != null) {
            return response()->json([
                'success' => false,
                'msg' => 'Email already exists!'
            ]);
        } else {
            $register = new Account();
            $register->email = $email;
            $register->password = $pass;
            $register->username = 'User' . date('mdYhis');
            $register->save();
            $result = Account::where('email', $email)->where('password', $pass)->first();
            if ($result == true) {
                return response()->json([
                    'success' => true,
                    'user' => $result
                ]);
            }
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $pass = md5($request->password);
        $result = Account::where('email', $email)->where('password', $pass)->first();

        if ($result == true) {
            return response()->json([
                'success' => true,
                'user' => $result
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Mật khẩu hoặc email ko đúng!'
            ]);
        }
    }

    public function showAccount($cus_id)
    {
        $account = Account::find($cus_id);
        return $account;
    }


    public function uploadProfile(Request $request, $cus_id)
    {
        $account = Account::findOrFail($cus_id);

        $input = $request->all();
        $account->username = $input['username'];
        $account->numberphone = $input['numberphone'];
        $account->introduce = $input['desc'];
        $account->yearofbirth = $input['yearofbirth'];
        if ($input['image'] != '') {

            if ($account->avatar != null) {
                $path = public_path('uploads/cus_avt/' . $account->avatar);
                if (File::exists($path)) {
                    unlink($path);
                }
            }
            $folderPath = public_path('uploads/cus_avt/');
            $image_base64 = base64_decode($input['image']);
            $file = $folderPath . 'IMG_' . date('mdYhisa') . '.webp';
            $fileName =  'IMG_' . date('mdYhisa') . '.webp';
            file_put_contents($file, $image_base64);
            $account->avatar = $fileName;

            $rating = Rating::where('u_id', $cus_id)->get();

            for ($i = 0; $i < count($rating); $i++) {
                $rating[$i]->avt = $fileName;
                $rating[$i]->save();
            }
        }
        $account->update();
        return $account;
    }

    public function changePass(Request $request)
    {
        $input = $request->all();
        $email = $input['email'];
        $password = md5($input['password']);
        $newPass = md5($input['newPass']);

        $account = Account::where('email', $email)->where('password', $password)->first();
        if ($account != null) {
            $account->password = $newPass;
            $account->update();
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function googleSignIn(Request $request)
    {
        $input = $request->all();
        $checkAccount = Account::where('email', $input['email'])->first();
        if ($checkAccount != null) {
            return response()->json([
                'success' => true,
                'user' => $checkAccount
            ]);
        } else {
            $register = new Account();
            $register->email = $input['email'];
            $register->password = md5($input['password']);
            $register->username = $input['username'];

            $url = $input['imageUrl'];
            if ($url != null) {
                $folderPath = public_path('uploads/cus_avt/');
                $file = $folderPath . 'IMG_' . date('mdYhisa') . '.webp';
                $fileName =  'IMG_' . date('mdYhisa') . '.webp';

                file_put_contents($file, file_get_contents($url));
                $register->avatar = $fileName;
            }

            $register->save();
            $result =  Account::where('email', $input['email'])->first();
            if ($result != null) {
                return response()->json([
                    'success' => true,
                    'user' => $result
                ]);
            }
        }
    }
}
