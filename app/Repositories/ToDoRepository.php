<?php
namespace App\Repositories;
use App\Models\ToDo;

class ToDoRepository
{

    //Repository katmanı, veritabanı ile etkileşimi sağlar.

    protected $model;

    public function __construct(ToDo $model)
    {
        $this->model=$model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->where('id',$id)->first();
    }

    public function store($data)
    {
        return $this->model->create([
            'name'=>$data['name'],
            'completed' => $data['completed'],
        ]);
    }
    public function update($id,$data)
    {
        return $this->model->where('id',$id)->update([
            'name'=>$data['name'],
            'completed' => $data['completed'],
        ]);
    }
    public function delete($id)
    {
        return $this->model->where('id',$id)->delete();
    }
}