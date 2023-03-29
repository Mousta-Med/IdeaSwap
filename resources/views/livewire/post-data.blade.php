<div class="">
    <div class="d-flex justify-content-center">
        <div class="share_post d-flex justify-content-between mt-5">
            <img src="/avatars/{{ Auth::user()->avatar }}" width="50" class="rounded-circle">
            <div class="">
                <input class="form-control me-1" type="search" wire:model="search" placeholder="Search">
            </div>
            <div class="me-1">
                <select class="form-control" id="category" wire:model="category">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create
                Post</button>
        </div>
    </div>
    @foreach ($data as $post)
        <div class="row d-flex align-items-center justify-content-center my-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center">
                            <img src="/avatars/{{ $post->User->avatar }}" width="50" class="rounded-circle">
                            <div class="mx-3 d-flex flex-column">
                                <span class="username">{{ $post->User->name }}</span>
                                <small class="text-primary"><i class="fas fa-clock"></i>
                                    {{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @if ($post->user_id == Auth::user()->id)
                            <div class="d-flex align-items-center mt-1 ellipsis">
                                <div class="dropdown">
                                    <a class="dropdown-toggle dots" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a href="{{ url('delete-post/' . $post->id) }}"
                                                class="dropdown-item">delete</a>
                                        </li>
                                        <li><a href="{{ url('update-post/' . $post->id) }}"
                                                class="dropdown-item">edite</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->post_title }}</h5>
                        <p class="card-text">{{ $post->post_description }}.</p>
                    </div>
                    <img src="/img/{{ $post->post_image }}" class="img-fluid">
                    <div class="p-2">
                        <div class="categories d-flex justify-content-evenly flex-col flex-wrap">
                            @foreach ($post->categories as $category)
                                <div class="category me-3">
                                    {{ $category->name }}
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <button wire:click.prevent="likePost({{ $post->id }})" class="border-0 bg-transparent fs-5"
                            style="color:red;">
                            @if ($post->liked)
                                <i class="fa fa-heart"></i>
                            @else
                                <i class="far fa-heart"></i>
                            @endif
                        </button>
                        <span>{{ $post->Likes->count() }} {{ Str::plural('like', $post->Likes->count()) }}</span>
                        <hr>
                        <div class="commnet-section">
                            <form wire:submit.prevent="addComment({{ $post->id }})">
                                <div class="comment-input mb-3 input-group">
                                    <input type="text" class="form-control" placeholder="Add a comment..."
                                        wire:model="newComment">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button"
                                            wire:click="addComment({{ $post->id }})">Post</button>
                                    </div>
                                </div>
                            </form>
                            <div class="comments">
                                @foreach ($post->comments as $comment)
                                    <div class="comment d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row mb-2">
                                            <img src="/avatars/{{ $comment->Users->avatar }}" width="40"
                                                class="rounded-image">
                                            <div class="d-flex flex-column ml-2">
                                                <div>
                                                    <span class="name">{{ $comment->Users->name }}</span>
                                                    <small class="text-primary"><i class="fas fa-clock"></i>
                                                        {{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                                <small class="comment-text">{{ $comment->comment }}</small>
                                            </div>
                                        </div>
                                        @if ($comment->user_id == Auth::user()->id)
                                            <div class="btn" wire:click="deleteComment({{ $comment->id }})">
                                                <i class="fas fa-trash" style="color: #0d6efd"></i>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
