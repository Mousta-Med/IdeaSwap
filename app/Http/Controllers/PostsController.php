<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class PostsController extends Controller
{
    public function index()
    {
        $data = Posts::get();
        return view('Posts', compact('data'));
    }
    public function addpost()
    {
        return view('addpost');
    }
    public function savepost(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'image' => 'required',
        //     'description' => 'required',
        //     'category' => 'required',
        // ]);

        $image_extension = $request->post_image->getClientOriginalExtension();
        $image = time() . '.' . $image_extension;
        $path = 'img';
        $request->post_image->move($path, $image);
        $title = $request->post_title;
        $description = $request->post_desc;
        $category = $request->post_category;

        $post = new Posts();
        $post->post_title = $title;
        $post->post_description = $description;
        $post->post_category = $category;
        $post->post_image = $image;
        $post->post_reacts = 0;
        $post->post_owner = "test";
        $post->save();

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
        if (!$data) {
            abort("404");
        } else {
            return view('updatepost', compact('data'));
        }
    }
    public function editepost(Request $request)
    {
        if (isset($request->post_image)) {
            $image_extension = $request->post_image->getClientOriginalExtension();
            $image = time() . '.' . $image_extension;
            $path = 'img';
            $request->post_image->move($path, $image);
        }
        $title = $request->post_title;
        $description = $request->post_desc;
        $category = $request->post_category;
        $id = $request->post_id;

        if (isset($image)) {
            Posts::where('id', '=', $id)->update([
                'post_title' => $title,
                'post_description' => $description,
                'post_category' => $category,
                'post_image' => $image,
                'post_reacts' => 0,
                'post_owner' => "test"
            ]);
        } else {
            Posts::where('id', '=', $id)->update([
                'post_title' => $title,
                'post_description' => $description,
                'post_category' => $category,
                'post_reacts' => 0,
                'post_owner' => "test"
            ]);
        }

        return redirect()->back()->with('success', 'post updated successfuly');
    }
}
