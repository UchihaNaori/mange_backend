<?php
    namespace App\Repositories;

    use App\Models\User;

    class UserRepository extends BaseRepository {

        public function model()
        {
            // TODO: Implement model() method.
            return User::class;
        }

        public function login($request)
        {
            $email = $request->email;
            $user = User::where('email', $email)->get();

            if ($user->count() > 0) {
                if ($user[0]->password == md5($request->password)) {
                    session()->put('user', $user[0]);

                    return [
                        'message' => true,
                        'userId' => $user[0]->id
                    ];
                }
            }

            return [
                'message' => false,
            ];
        }

        public function logout()
        {
            session()->forget('user');
        }
    }
?>
