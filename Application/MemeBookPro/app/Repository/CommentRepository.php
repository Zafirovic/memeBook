<?php
namespace App\Repository;

use App\Meme;
use Illuminate\Database\Eloquent\Model;

class CommentRepository implements CommentInterface
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
        $comm=$this->find($id);
        return $comm->update($data);
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
