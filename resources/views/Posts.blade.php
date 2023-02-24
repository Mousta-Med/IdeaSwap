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
    <div class="position-relative overflow-auto shadow-sm rounded-lg">
        <table class="w-100 small text-left text-secondary text-dark-gray">
            <thead class="text-uppercase small text-gray-700 bg-light bg-dark text-secondary">
                <tr>
                    <th>id</th>
                    <th>post_title</th>
                    <th>post_description</th>
                    <th>post_image</th>
                    <th>post_category</th>
                    <th>post_reacts</th>
                    <th>post_owner</th>
                    <th>created_at</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $post)
                    <tr class="bg-white border-bottom border-dark dark:bg-dark">
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->post_title }}</td>
                        <td>{{ $post->post_description }}</td>
                        <td><img src="/img/{{ $post->post_image }}" width="50" height="50" alt=""></td>
                        <td>{{ $post->post_category }}</td>
                        <td>{{ $post->post_reacts }}</td>
                        <td>{{ $post->post_owner }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a href="{{ url('delete-post/' . $post->id) }}"
                                class="btn btn-primary text-white font-weight-bold py-2 px-4 rounded">delete</a>
                            <a href="{{ url('update-post/' . $post->id) }}"
                                class="btn btn-primary text-white font-weight-bold py-2 px-4 rounded">edite</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
