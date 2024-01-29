<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Customer;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\Websitemail;


class CustomerAuthController extends Controller
{
    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('customer')->attempt($credentials)) {
            $user = Auth::guard('customer')->user();

            // Kullanıcının status alanını kontrol et
            if ($user->status === 1) {
                // Hesap onaylı ise token'ı döndür
                $token = $user->token;
                return response()->json(['token' => $token], 200);
            } else {
                // Hesap onaylı değilse hata döndür
                return response()->json(['error' => 'Account not verified.'], 401);
            }
        } else {
            return response()->json(['error' => 'Information is not correct!'], 401);
        }
    }


public function signup_submit(Request $request)

    {

        $request->validate([

            'name' => 'required',

            'surname' => 'required',

            'email' => 'required|email|unique:customers',

            'password' => 'required',

            'retype_password' =>'required|same:password'

        ]);





        $token = hash('sha256', time());

        $password = Hash::make($request->password);

        $verification_link = url('api/signup-verify/'.$request->email.'/'.$token);



        $obj = new Customer();

        $obj->name = $request->name;

        $obj->surname = $request->surname;

        $obj->email = $request->email;

        $obj->password = $password;

        $obj->token = $token;

        $obj->status = 0;

        $obj->save();



        // Send email

        $subject = 'Sign Up Verification';

        $message = 'Please click on the link below to confirm sign up process:<br>';

        $message .= '<a href="'.$verification_link.'">';

        $message .= $verification_link;

        $message .= '</a>';



        \Mail::to($request->email)->send(new Websitemail($subject,$message));



        return redirect()->back()->with('success', 'To complete the signup, please check your email and click on the link');



    }


    public function signup_verify($email, $token)
{
    $customer_data = Customer::where('email', $email)->where('token', $token)->first();

    if ($customer_data) {
        if ($customer_data->status == 1) {
            // Kullanıcı zaten doğrulanmış, isteğinize göre yönlendirin
            return redirect('https://chattrip.net/login')->with('info', 'Your account is already verified.');
        }

        $newtoken = hash('sha256', time());
        $customer_data->token = $newtoken;
        $customer_data->status = 1;
        $customer_data->update();

        return redirect('https://chattrip.net/login')->with('success', 'Your account is verified successfully!');
    } else {
        return redirect('https://chattrip.net/register')->with('warning', 'Activation Could Not Be Completed!');
    }
}



}
