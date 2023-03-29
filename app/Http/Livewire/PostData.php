<?php

namespace App\Http\Livewire;

use App\Models\Categories;
use App\Models\Comments;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Posts;


class PostData extends Component
{
    public $data;
    public $search;
    public $category;
    public $categories;
    public $newComment;


    public function mount()
    {
        $this->categories = Categories::all();
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

    public function addComment($postId)
    {
        $user = Auth::user();
        $content = $this->newComment;
        $comment = new Comments();
        $comment->comment = $content;
        $comment->user_id = $user->id;
        $comment->post_id = $postId;
        $comment->save();
        $this->newComment = "";
    }
    public function deleteComment($commentId)
    {
        $comment = Comments::findOrFail($commentId);

        // Check if the current user is authorized to delete the comment
        if ($comment->user_id !== Auth::user()->id) {
            // Throw an exception or display an error message here
            return;
        }

        // Delete the comment
        $comment->delete();
    }
    public function render()
    {
        $data = Posts::with('Likes.Users', 'Comments.Users')->latest();

        if ($this->search) {
            $data->where('post_title', 'like', '%' . $this->search . '%');
        }
        if ($this->category) {
            $data->whereHas('categories', function ($query) {
                $query->where('name', $this->category);
            });
        }

        $this->data = $data->get();
        $this->postUserLike($this->data);
        return view('livewire.post-data', ['data' => $this->data]);
    }
}
