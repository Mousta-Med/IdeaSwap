@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="bg-success text-white text-center font-weight-bold rounded-top px-4 py-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container text-white">
        <h1 class="text-center">Update Your Post</h1>
        <form class="" method="POST" action="{{ url('edite-post') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="post_id" value="{{ $data->id }}">
            <div class="mb-3">
                <label class="form-label fw-bold" for="post_title">Post Title</label>
                <input class="form-control" id="post_title" type="text" placeholder="Enter post title" name="post_title"
                    value="{{ $data->post_title }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" for="post_description">Post Description</label>
                <textarea class="form-control" id="post_description" type="text" placeholder="Enter post description"
                    name="post_desc">{{ $data->post_description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" for="post_image">Post Image</label>
                <input class="form-control" id="post_image" type="file" name="post_image">
            </div>
            <div class="mb-3">
                <label>Categories:</label>
                <br>
                @foreach ($categories as $category)
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                        @if ($data->categories->pluck('id')->contains($category->id)) checked @endif>
                    {{ $category->name }}<br>
                @endforeach
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary me-md-2" type="submit">Update Post</button>
                <a href="{{ url('') }}" class="btn btn-danger">Back</a>
            </div>
        </form>
    </div>
@endsection
