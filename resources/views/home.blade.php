@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="bg-success text-white text-center font-weight-bold rounded-top px-4 py-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container d-flex justify-content-between flex-row">
        <div class="leftsidebar mt-5 text-center">
            <div class="user-info">
                <img src="/avatars/{{ Auth::user()->avatar }}" width="90" class="rounded-circle">
                <h3 class="p-2">{{ Auth::user()->name }}</h3>
                <h5>Follwing</h5>
                <p>30</p>
                <hr>
                <h5>Follwers</h5>
                <p>100</p>
            </div>
        </div>
        <div class="container">
            <livewire:post-data :data="$data" />
        </div>
        <div class="rightsidebar mt-5 text-center">
            <h4 class="pt-3 p-2">Top Posts</h4>
            <hr>
            <h5>test1</h5>
            <h5>test1</h5>
            <h5>test1</h5>
            <h5>test1</h5>
            <h5>test1</h5>
            <h5>test1</h5>
            <h5>test1</h5>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container text-white">
                        <form class="max-w-lg mx-auto" method="POST" action="{{ url('save-post') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="post_title">Post Title</label>
                                <input class="form-control" id="post_title" type="text" placeholder="Enter post title"
                                    name="post_title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="post_description">Post Description</label>
                                <textarea class="form-control" id="post_description" placeholder="Enter post description" name="post_desc" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="post_image">Post Image</label>
                                <input class="form-control" id="post_image" type="file" name="post_image" required>
                            </div>
                            <div class="mb-3 text-black">
                                <label>Categories:</label>
                                <br>
                                @foreach ($categories as $category)
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                    {{ $category->name }}<br>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary me-md-2" type="submit" value="Create Post">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
