<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Posts;


class PostData extends Component
{
    public $data;
    public $search;

    public function mount()
    {
        $data = Posts::with('Likes.Users')->latest()->get();
        $this->data = $data;
        $this->postUserLike($this->data);
    }

    public function likePost($id)
    {
        $isLiked = Like::where('user_id', Auth::user()->id)->where('post_id', $id)->exists();

        if ($isLiked) {
            Like::where('user_id', Auth::user()->id)->where('post_id', $id)->delete();
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'post_id' => $id
            ]);
        }
        $this->data = Posts::with('Likes.Users')->latest()->get();
        $this->postUserLike($this->data);
    }

    public function postUserLike($data)
    {
        foreach ($data as $post) {
            $islike = false;
            foreach ($post->Likes as $like) {
                if ($like->user_id == Auth::user()->id) {
                    $islike = true;
                    break;
                }
            }
            $post->liked = $islike;
        }
    }

    public function render()
    {
        return view('livewire.post-data');
    }
}
