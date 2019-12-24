<?php
namespace App\Repository;

use App\Meme;
use Illuminate\Database\Eloquent\Model;

class MemeRepository implements UserInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model=$model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $meme=$this->find($id);
        return $meme->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->FindOrFail($id);
    }

    public function get()
    {
        return $this->model;
    }
}
