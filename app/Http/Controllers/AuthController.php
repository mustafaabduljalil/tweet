<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->maxAttempts      = config('auth.attemp_count');
        $this->decayMinutes     = config('auth.attemp_throttle_time');
    }


    /**
     * Regitser
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [date] birth_date
     * @param  [file] image
     * @return [object] user data
     * @throws \SMartins\PassportMultiauth\Exceptions\MissingConfigException
     */
    public function register(RegisterRequest $request)
    {
        // create new user
        $user = $this->userService->store($request->validated());
        $data = $this->loggedUserReponse($user);
        return response()->json(['data' => $data],Response::HTTP_CREATED);
    }

    /**
     * Login
     *
     * @param  [string] email
     * @param  [string] password
     * @return [object] user data
     * @throws \SMartins\PassportMultiauth\Exceptions\MissingConfigException
     */
    public function login(LoginRequest $request)
    {

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return response()->json(['message' => __('messages.too_many_requests')],Response::HTTP_TOO_MANY_REQUESTS);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = $this->userService->getUser('email',$request->email);
            $data = $this->loggedUserReponse($user);
            return response()->json(['data' => $data],Response::HTTP_OK);
        }else{
            // increment login attempts
            $this->incrementLoginAttempts($request);
        }

        return response()->json(['message' => __('messages.incorrect_email_or_password')],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [array] msg
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => __('messages.logout_successfully')],Response::HTTP_OK);
    }

    // return logged user
    protected function loggedUserReponse($user){
        $data['user'] = new UserResource($user);
        $data['access_token'] = $user->createToken("tweet")->plainTextToken;
        return $data;
    }
}
