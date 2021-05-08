<?php

namespace App;

use Auth;
use App\Category;
use App\User;
use App\Comment;
use App\Vote;
use App\MemeReport;
use App\MessageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Meme extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'user_id', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function reports()
    {
        return $this->hasMany('App\MemeReport');
    }

    public function getAllMemes()
    {
        $memes = Meme::with(['votes', 'user', 'category'])->orderBy('created_at', 'desc')
                                                          ->paginate(5);
        if (!empty($memes)) {
            $memes = $this->fillMemeData($memes);
        }
        return $memes;
    }

    public function getAllMemesForCategory($category_id)
    {
        $memes = Meme::where('category_id', $category_id)->with(['votes', 'user', 'category'])
                                                         ->orderBy('created_at', 'desc')
                                                         ->paginate(5);
        if (!empty($memes)) {
            $memes = $this->fillMemeData($memes);
        }
        return $memes;
    }

    public function getAllMemesForUser($user_id)
    {
        $memes = Meme::where('user_id', $user_id)->orderBy('created_at', 'desc')
                                                 ->paginate(5);
        if (!empty($memes)) {
            $memes = $this->fillMemeData($memes);
        }
        return $memes;
    }

    public function getMeme($meme_id)
    {
        $meme = Meme::with('category')->findOrFail($meme_id);
        $this->fillMemeData($meme);

        return $meme;
    }

    public function addMeme($data, $img_name)
    {
        $created = Meme::create([
            'image' => $img_name,
            'user_id' => Auth::user()->id,
            'category_id' => $data->category_id
        ]);
        if ($created) {
            return MessageHelper::Success('CreateMemeSuccess');
        } else {
            return MessageHelper::Error('CreateMemeFail');
        }
    }

    public function updateMeme(Request $request, $meme_id)
    {
        $meme = Meme::find($meme_id);
        $meme->title = $request->title;
        $meme->body = $request->body;
        $updated = $meme->save();
        
        if ($updated) {
            return MessageHelper::Success('UpdateMemeSuccess');
        } else {
            return MessageHelper::Error('UpdateMemeFail');
        }
    }

    public function deleteMeme($meme_id)
    {
        $meme = Meme::findOrFail($meme_id);
        $deleted = $meme->delete();

        if ($deleted) {
            return MessageHelper::Success('DeleteMemeSuccess');
        } else {
            return MessageHelper::Error('DeleteMemeFail');
        }
    }

    private function fillMemeData($memes)
    {
        $auth_user = Auth::user();
        if ($memes instanceof LengthAwarePaginator) {
            foreach ($memes as $meme) {
                $meme->sourceImage = $this->checkImageSource($meme);
                $meme->username = $meme->user->name;
                $vote = $meme->votes->first(function ($vote) {
                    return Auth::user() ? $vote->user_id === Auth::user()->id : null;
                });
                $meme->numOfVotes = $meme->votes->sum('vote');
                $meme->voted = $auth_user ? $this->memeIsVotedByUser($vote)
                    : array('upvoted' => '#f0f0f0', 'downvoted' => '#f0f0f0');
            };
        } else {
            $memes->sourceImage = $this->checkImageSource($memes);
            $memes->username = $memes->user->name;
            $vote = $memes->votes->first(function ($vote) {
                return Auth::user() ? $vote->user_id === Auth::user()->id : null;
            });
            $memes->numOfVotes = $memes->votes->sum('vote');
            $memes->voted = $auth_user ? $this->memeIsVotedByUser($vote)
                : array('upvoted' => '#f0f0f0', 'downvoted' => '#f0f0f0');
        }
        return $memes;
    }

    private function checkImageSource($meme)
    {
        return strpos($meme->image, "imgflip") !== false ? $meme->image
                                                : URL::to('/') . '/images/memes/' . $meme->image;
    }

    private function memeIsVotedByUser($meme_vote)
    {
        if ($meme_vote === null) {
            return array('upvoted' => '#f0f0f0', 'downvoted' => '#f0f0f0');
        }
        return $meme_vote->vote === 1 ? array('upvoted' => '#99CCFF', 'downvoted' => '#f0f0f0')
            : array('upvoted' => '#f0f0f0', 'downvoted' => '#99CCFF');
    }
}
