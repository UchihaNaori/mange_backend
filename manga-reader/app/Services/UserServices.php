<?php
     namespace App\Services;
     use App\Models\PasswordReset;
     use App\Repositories\UserRepository;
     use App\Models\User;
     use Illuminate\Support\Facades\Mail;
     use Illuminate\Support\Str;
     use Symfony\Component\Console\Input\Input;

class UserServices {
         protected $userRepository;

         public function __construct(UserRepository $userRepository)
         {
             $this->userRepository = $userRepository;
         }

         public function fillData($request)
         {
             return [
                 'name' => $request->name,
                 'email' => $request->email,
                 'phone' => $request->phone,
                 'password' => md5($request->password),
                 'image' => 'uploads/user_avatars/default.jpeg',
                 'account_type' => 0
             ];
         }

         public function register($request)
         {
             $data = $this->fillData($request);
             $user = User::where('email', $data['email'])->count();

             if ($user > 0) {
                 return 'Error';
             }
             $user = $this->userRepository->create($data);
             if($request->file('image')) {
                 $file = $request->file('image');
                 //you also need to keep file extension as well
                 $name = $file->getClientOriginalName();
                 $file->move(public_path().'/uploads/user_avatars/', $name);
                 $user->image= 'uploads/user_avatars/'. $name;
                 $user->save();
             }

             return 'Success';
         }

         public function login($request)
         {
             return $checkLogin = $this->userRepository->login($request);
         }

         public function logout()
        {
            $this->userRepository->logout();
        }

        public function forgetPassword($request)
        {
            $email = $request->input('email');
            $customer = User::where('email', $request->input('email'))->first();

            if ($customer) {
                $token = Str::random(64);

                PasswordReset::create([
                    'email' => $email,
                    'token' => $token
                ]);

                Mail::send('log_res.auth.content_email', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->input('email'));
                    $message->subject('Reset Password');
                });

                return back()->with('success', 'Send email reset password success !');
            } else {
                return back()->with('error', 'Email does not exits !');
            }
        }

         public function resetPassword($request)
         {
             $updatePassword = PasswordReset::where('email', $request->input('email'))->where('token', $request->token)->first();

             if (!$updatePassword) {
                 return back()->with('error', 'Invalid token!');
             }

             $customer = User::where('email', $request->input('email'))->first();

             if (!$customer) {
                 return back()->with('error', 'Email does not exits !');
             }

             $customer->password = md5($request->input('password'));
             $customer->update();
             session()->put('user', $customer);
             PasswordReset::where('email', $request->input('email'))->delete();

             return redirect()->route('comic.index')->with('success', 'Reset password successfully !');
         }

     }
?>
