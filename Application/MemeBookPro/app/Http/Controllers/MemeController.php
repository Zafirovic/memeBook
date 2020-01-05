<?php

namespace App\Http\Controllers;

use App\Favoritecategory;
use App\Http\Requests\MemeStoreRequest;
use App\Repositories\Interfaces\MemeRepositoryInterface;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Meme;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class MemeController extends Controller
{
    private $memeRepository;
    private $categoryRepository;

    public function __construct(MemeRepositoryInterface $memeRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->memeRepository = $memeRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index1()
    {
        $categories = $this->categoryRepository->all();
        $memes = $this->memeRepository->all();
        if(isset (request()->category_id)){
            $category = new Category();
            $category = $category->find(request()->category_id);
            $memes = $category->memes;
        }
        return view('welcome', compact('memes','categories'));
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        $memes = $this->memeRepository->all();
        if(isset (request()->category_id)){
            $category = new Category();
            $category = $category->find(request()->category_id);
            $memes = $category->memes;
        }
        return view('meme', compact('memes','categories'));
    }

    public function detail($id)
    {
        $user = User::find($id);
        //$memes=$this->memeRepository->getByUser($user);
        $memes = $user->memes();
        return view('meme', $memes);
    }

    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('memes.create', compact('categories'));
    }

    public function store(MemeStoreRequest $request)
    {
       $this->memeRepository->store($request);
       return redirect('/');
    }

    public function follow($category_id)
    {
        $contains = Favoritecategory::where([['user_id', auth()->user()->id],
                                             ['category_id', $category_id]])
                                             ->first();
        if($contains == null) 
        {
            Favoritecategory::create([
                'user_id' => auth()->user()->id,
                'category_id' => $category_id
            ]);
        }

       return redirect()->back();
    }

    public function unfollow($category_id)
    {
        $delete = Favoritecategory::where([['user_id',auth()->user()->id],
                                           ['category_id',$category_id]])
                                           ->first();
        if($delete)
        {
            $delete->delete();
        }

        return redirect()->back();
    }
}
