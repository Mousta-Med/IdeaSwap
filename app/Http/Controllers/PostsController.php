<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use App\Models\Like;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::withCount('Likes')
            ->orderByDesc('likes_count')
            ->get();
        $data = Posts::with('Likes.Users')->latest()->get();
        $categories = Categories::get();

        return view('home', compact('data', 'categories', 'posts'));
    }
    public function addpost()
    {
        return view('addpost');
    }
    public function savepost(Request $request)
    {
        $request->validate([
            'post_title' => 'required|string',
            'post_image' => 'required|image',
            'post_desc' => 'required|string',
            'categories' => 'required|array',
        ]);

        $image_extension = $request->post_image->getClientOriginalExtension();
        $image = time() . '.' . $image_extension;
        $path = 'img';
        $request->post_image->move($path, $image);
        $title = $request->post_title;
        $description = $request->post_desc;
        $categories = $request->categories;
        $user = Auth::id();

        $post = new Posts();
        $post->post_title = $title;
        $post->post_description = $description;
        $post->post_image = $image;
        $post->user_id = $user;
        $post->save();
        $post->Categories()->attach($categories);

        return redirect()->back()->with('success', 'post added successfuly');
    }

    public function deletepost($id)
    {
        Posts::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'post deleted successfuly');
    }
    public function updatepost($id)
    {
        $data = Posts::where('id', '=', $id)->first();
        $categories = Categories::get();
        if (!$data) {
            abort("404");
        } else {
            return view('updatepost', compact('data', 'categories'));
        }
    }
    public function editepost(Request $request)
    {
        $id = $request->post_id;
        $request->validate([
            'post_title' => 'required|string',
            'post_desc' => 'required|string',
        ]);

        if (!$post = Posts::find($id)) {
            return redirect()->back()->with('danger', 'Post not found');
        }

        $image = $post->post_image;
        if ($request->hasFile('post_image')) {
            $request->validate([
                'post_image' => 'image',
            ]);
            $image_extension = $request->post_image->getClientOriginalExtension();
            $image = time() . '.' . $image_extension;
            $path = 'img';
            $request->post_image->move($path, $image);
        }

        $title = $request->post_title;
        $description = $request->post_desc;
        $categories = $request->input('categories');
        $user = Auth::id();

        $post->post_title = $title;
        $post->post_description = $description;
        $post->post_image = $image;
        $post->user_id = $user;
        $post->save();

        $post->Categories()->sync($categories);

        return redirect()->back()->with('success', 'Post updated successfully');
    }
}
