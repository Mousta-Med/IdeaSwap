<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body>
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="bg-green-500 text-white text-center font-bold rounded-t px-4 py-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <form class="max-w-lg mx-auto" method="POST" action="{{ url('edite-post') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_id" value="{{ $data->id }}">
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="post_title">
                Post Title
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="post_title" type="text" placeholder="Enter post title" name="post_title"
                value="{{ $data->post_title }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="post_description">
                Post Description
            </label>
            <textarea
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="post_description" type="text" placeholder="Enter post description" name="post_desc">{{ $data->post_description }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="post_image">
                Post Image
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="post_image" type="file" name="post_image">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="post_category">
                Post Category
            </label>
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="post_category" name="post_category">
                <option @if ($data->post_category === 'sport') selected @endif value="Sport">Sport</option>
                <option @if ($data->post_category === 'Kitchen') selected @endif value="Kitchen">Kitchen</option>
                <option @if ($data->post_category === 'gaming') selected= @endif value="gaming">gaming</option>
                <option @if ($data->post_category === 'tech') selected @endif value="tech">tech</option>
            </select>
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"type="submit">Update
                Post</button>
            <a href="{{ url('posts') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
        </div>
    </form>

</body>

</html>
