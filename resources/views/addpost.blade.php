@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="bg-success text-white text-center font-weight-bold rounded-top px-4 py-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container">
        <form class="max-w-lg mx-auto" method="POST" action="{{ url('save-post') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="post_title">Post Title</label>
                <input class="form-control" id="post_title" type="text" placeholder="Enter post title" name="post_title"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="post_description">Post Description</label>
                <textarea class="form-control" id="post_description" placeholder="Enter post description" name="post_desc" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="post_image">Post Image</label>
                <input class="form-control" id="post_image" type="file" name="post_image" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="post_category">Post Category</label>
                <select class="form-select" id="post_category" name="post_category" required>
                    <option value="Sport">Sport</option>
                    <option value="Kitchen">Kitchen</option>
                    <option value="gaming">gaming</option>
                    <option value="tech">tech</option>
                </select>
            </div>
            <div class="d-flex justify-content-between px-2">
                <input type="submit" class="btn btn-primary me-md-2" type="submit" value="Create Post">
                <a href="{{ url('posts') }}" class="btn btn-danger">Back</a>
            </div>
        </form>
    </div>
@endsection
