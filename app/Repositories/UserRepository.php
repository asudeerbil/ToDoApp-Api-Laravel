<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model=$model;
    }

    public function register($data)
    {
        try{
            return $this->model->create([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>Hash::make($data['password']),
            ]);
        } catch(QueryException $e){
            if($e->errorInfo[1]==1062){
                return response()->json(['error'=>'The email address is already in use.'],400);
            }
            throw $e;
        }

    }

    public function login($data)
    {
        //auth()->attempt() metodu kullanılarak, $data dizisinde gelen email ve password değerleri Laravel’in kimlik doğrulama sistemi üzerinden kontrol ediliyor.
        //Eğer giriş başarılı olursa auth()->user() metodu çağrılarak giriş yapan kullanıcı nesnesi döndürülüyor.
        if(auth()->attempt(['email'=> $data['email'],'password'=>$data['password']])){
            return auth()->user();
        }

        return null;
    }

    public function find($userId)
    {
        return $this->model->find($userId);
    }

    public function user()
    {
        return auth()->guard('api')->user();
    }

   

}