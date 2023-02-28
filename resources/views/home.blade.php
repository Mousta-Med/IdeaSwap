@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="bg-success text-white text-center font-weight-bold rounded-top px-4 py-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <h1 class="text-3xl font-bold">Posts</h1>
    <a href="{{ url('add-post') }}"><button
            class="btn btn-primary text-white font-weight-bold py-2 px-4 rounded">ADD</button></a>
    @foreach ($data as $post)
        <div class="container mt-5 mb-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="d-flex justify-content-between p-2 px-3">
                            <div class="d-flex flex-row align-items-center">
                                <img src="https://pixlr.com/images/index/remove-bg.webp" width="50"
                                    class="rounded-circle">
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold">{{ $post->post_owner }}</span>
                                    <small class="text-primary">{{ $post->post_category }}</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-1 ellipsis">
                                <small class="mr-2">{{ $post->created_at->diffForHumans() }}</small>
                                <div class="dropdown">
                                    <a class="dropdown-toggle dots" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a href="{{ url('delete-post/' . $post->id) }}" class="dropdown-item">delete</a>
                                        </li>
                                        <li><a href="{{ url('update-post/' . $post->id) }}" class="dropdown-item">edite</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <img src="/img/{{ $post->post_image }}" class="img-fluid">
                        <div class="p-2">
                            <p class="text-justify">{{ $post->post_description }}.</p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row icons d-flex align-items-center">
                                    <i class="fa fa-heart"></i>
                                </div>
                                <div class="d-flex flex-row muted-color">
                                    <p>{{ $post->post_reacts }}</p>
                                    <a href=""><i class="fas fa-share"></i></a>
                                    <a href=""><i class="fas fa-comment"></i></a>
                                </div>
                            </div>
                            <hr>
                            <div class="comments">
                                <div class="d-flex flex-row mb-2">
                                    <img src="https://burst.shopifycdn.com/photos/woman-dressed-in-white-leans-against-a-wall.jpg?width=1200&format=pjpg&exif=0&iptc=0"
                                        width="40" class="rounded-image">
                                    <div class="d-flex flex-column ml-2"> <span class="name">Elizabeth goodmen</span>
                                        <small class="comment-text">Thanks for sharing!</small>
                                        <div class="d-flex flex-row align-items-center status"> <small>Like</small>
                                            <small>Reply</small> <small>Translate</small> <small>8 mins</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-input">
                                    <input type="text" class="form-control">
                                    <div class="fonts">
                                        <a href=""><i class="fas fa-paper-plane"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
