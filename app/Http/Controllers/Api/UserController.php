<?php

namespace App\Http\Controllers\Api;

use App\Helper\HttpResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function register(RegisterRequest $request)
    {
        $data=$request->all();
        $user=$this->userService->register($data);
        return apiResponse('ToDo',HttpResponse::HTTP_OK,['user'=>$user]);
    }

    public function login(LoginRequest $request)
    {
        $user=$this->userService->login($request->only(['email','password']));
        if($user){
            $token=$user->createToken('api_case')->accessToken;
            return apiResponse('Login Success',HttpResponse::HTTP_OK,['token'=>$token,'user'=>$user]);
        }
        return apiResponse('UNAUTHORIZED',HttpResponse::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request)
    {
        if(Auth::guard('api')->check()){ //Eğer kullanıcı giriş yapmışsa true, aksi halde false döner.
            Auth::guard('api')->user()->token()->revoke(); //Şu an giriş yapan kullanıcınin erisim tokenini iptal eder.
            return apiResponse('Logout Success',HttpResponse::HTTP_OK,['user'=>auth()->user()]);
        } else {
            return apiResponse('Error',HttpResponse::HTTP_NOT_FOUND);
        }
    }

    public function myProfile(Request $request)
    {
        return $user=new UserResource($this->userService->user());
    }

    


}
