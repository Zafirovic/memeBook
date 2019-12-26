<?php 

namespace App\Repositories\Interfaces;

use App\Category;

interface CategoryRepositoryInterface
{
    public function all();
    public function getByID($id);
    public function addCategory(Request $category);
    public function add($category);
    public function delete($id);
    public function update($category, $id);
}