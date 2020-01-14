<?php
namespace App\Repositories;
use App\Category;
use App\Http\Requests\MemeStoreRequest;
use App\Repositories\Interfaces\MemeeRepositoryInterface;
use App\Meme;
use App\User;
use Image;
use Illuminate\Support\Facades\Session;

class MemeRepository implements MemeeRepositoryInterface
{

    public function all()
    {
        return Meme::all();
    }


    public function store(MemeStoreRequest $request)
    {
        $data=$request->all();
        $data['user_id']=auth()->user()->id;
        unset($data['_token']);

        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $img=Image::make($file);
            $img_name="/".time()."_".$file->getClientOriginalName(); //koristimo kako ne bi bilo poklapanja imena slika
            $path=public_path('images/memes'); //ovde se sejvaju slike
            $img->save($path.$img_name);
        }
        $data['image']=$img_name;
        $meme=Meme::create($data);
        Session::flash('success','Meme added successfully');
        return $meme->id;
        //return redirect('/');
    }
}
