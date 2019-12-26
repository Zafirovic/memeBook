<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return view('category', $categories);
    }

    public function detail($id)
    {
        $category = $this->getByID($id);

        return view('category', $category);
    }

    public function addCategory(Request $category)
    {
        $this->categoryRepository->add($category);
    }

    public function deleteCategory($id)
    {
        $this->categoryRepository->delete($id);
    }

    public function updateCategory(Request $category, $id)
    {
        $this->categoryRepository->update($category, $id);
    }
}
