<?php
namespace App\Services;
use App\Repositories\ToDoRepository;

use App\Models\ToDo;

class ToDoService
{

    //Service katmanı, iş mantığını yönetir ve controller ile repository arasındaki köprü olur.
    // Controller doğrudan veritabanıyla etkileşime girmez, böylece kod daha modüler olur.
    protected $todoRepository;

    public function __construct(ToDoRepository $todoRepository)
    {
        $this->todoRepository=$todoRepository;
    }

    public function getAll()
    {
        return $this->todoRepository->getAll();
    }
    public function find($id)
    {
        return $this->todoRepository->find($id);
    }
    public function store($data)
    {
        return $this->todoRepository->store($data);
    }
    public function update($id,$data)
    {
        return $this->todoRepository->update($id,$data);
    }
    public function delete($id)
    {
        return $this->todoRepository->delete($id);
    }
}