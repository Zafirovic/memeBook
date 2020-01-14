<?php

namespace App\Http\Controllers;

use App\Favoritecategory;
use App\Http\Requests\MemeStoreRequest;
use App\Repositories\MemeRepository;
use App\Repositories\NotificationRepository;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Meme;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class MemeController extends Controller
{
    protected $memeRepository;
    protected $categoryRepository;
    protected $notification;
    public function __construct(MemeRepository $memeRepository,CategoryRepository $categoryRepository,NotificationRepository $notification)
    {
        $this->memeRepository=$memeRepository;
        $this->categoryRepository=$categoryRepository;
        $this->notification=$notification;
    }

    public function index()
    {
        $categories=$this->categoryRepository->all();
        $memes=$this->memeRepository->all();
        if(isset(request()->category_id)){
            $category=new Category();
            $category=$category->find(request()->category_id);
            $memes=$category->memes;
        }
        return view('meme',compact('memes','categories'));
    }

    public function detail($id)
    {
        $user=User::find($id);
        //$memes=$this->memeRepository->getByUser($user);
        $memes=$user->memes();
        return view('meme',$memes);
    }
    public function create()
    {
        $categories=$this->categoryRepository->all();
        return view('memes.create',compact('categories'));
    }

    public function store(MemeStoreRequest $request)
    {
        $meme=$this->memeRepository->store($request);
        $user_following_categories=Favoritecategory::where('category_id',$request->category_id)->pluck('user_id'); //vadim samo user_id iz te tabele
        $category=Category::find($request->category_id);
        $cat_name=$category->name;
        $this->notification->store($user_following_categories,$meme,$cat_name);
        return $meme;
//
//       Session::flash('success','Meme success uploaded');
//       return redirect('/');
    }

    public function follow($category_id)
    {
     $contains=Favoritecategory::where([['user_id',auth()->user()->id],['category_id',$category_id]])->first();
     if($contains == null ) {
         Favoritecategory::create([
             'user_id' => auth()->user()->id,
             'category_id' => $category_id
         ]);
     }

     return redirect()->back();
    }

    public function unfollow($category_id)
    {
        $delete=Favoritecategory::where([['user_id',auth()->user()->id],['category_id',$category_id]])->first();
        if($delete)
        {
            $delete->delete();
        }

        return redirect()->back();
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

    public function single(Meme $meme)
    {
        $is_followed=auth()->user()->is_followed_category($meme->category_id);
        if($is_followed) {
            $meme->category_name=$meme->category->name;
            return $meme;
        }
    }
}
