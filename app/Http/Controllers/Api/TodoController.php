<?php

namespace App\Http\Controllers\Api;

use App\Helper\HttpResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ToDoService;
use App\Models\ToDo;
use App\Http\Resources\ToDoResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ToDoRequest;

class TodoController extends Controller
{

    //HTTP isteklerini karşılar ve Service katmanından gelen verileri JSON formatında döndürür.

    protected $todoService; //property
    public function __construct(ToDoService $todoService)
    {
        //$this-> ile başlayanlar sınıfın içindeki property’yi temsil eder.
        //$this, şu an içinde bulunduğumuz sınıfı temsil eder.
        //this->todoService, bu sınıfın içinde bulunan todoService property’sine erişimi sağlar.
        $this->todoService=$todoService;
    }


    public function index(Request $request)
    {
        $todos=ToDoResource::collection($this->todoService->getAll());
        return apiResponse('ToDo',HttpResponse::HTTP_OK,$todos);

    }

    public function store(ToDoRequest $request)
    {
        $data=$request->all();
        $todo=$this->todoService->store($data);
        return apiResponse('ToDo',HttpResponse::HTTP_OK,$todo);
    }

    public function edit($id,Request $request)
    {
        return $this->todoService->find($id);
        return "Single todo";
    }

    public function update($id,ToDoRequest $request)
    {
        $data=$request->all();
        $this->todoService->update($id,$data);
        $todo=$this->todoService->find($id);
        return apiResponse('ToDo',HttpResponse::HTTP_OK,$todo);
    }
    
    public function destroy($id,Request $request)
    {
        $this->todoService->delete($id);
        $todo=$this->todoService->find($id);
        return apiResponse('Deleted todo:',HttpResponse::HTTP_OK,$todo);
    }
}
