<?php 

namespace App\Repositories;

use App\Category;
use App\Repositores\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function getByID($id)
    {
        return Category::find($id)->first();
    }

    public function add($category)
    {
        $category = new Category;

        $category->name = $request->name;

        $category->save();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
    }

    public function update($category, $id)
    {
        $cat = Category::find($id);

        $cat->name = $category->name;

        $cat->save();
    }
}