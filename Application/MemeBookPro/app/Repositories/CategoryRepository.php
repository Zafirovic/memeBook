<?php
namespace App\Repositories;
use App\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function all()
    {
        return Category::all();
    }

    public function getByID($id)
    {
        return Category::find($id);
    }

//    public function add($category)
//    {
//        $category=new Category;
//        $category->save();
//    }
//
//    public function update($category, $id)
//    {
//        // TODO: Implement update() method.
//    }
}
