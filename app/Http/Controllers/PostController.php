<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Http\Controllers;

use App\Contracts\Categories;
use App\Contracts\Channels;
use App\Contracts\Posts;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\ChannelService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Categories $categories, Posts $posts)
    {

        $per_page = $request->get('per_page');
        $cat_selected = $request->get('category');

        $objCategories = $categories->all();
        $optionCategories = [];
        foreach ($objCategories as $itemCategory) {
            $optionCategories[$itemCategory->id] = $itemCategory->name;
        }

        $posts = $posts->list($cat_selected, $per_page);

        return view('posts.index', compact('posts', 'per_page', 'optionCategories', 'cat_selected'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(Channels $channelService, Categories $categoryService)
    {
        $channels = $channelService->all();
        $categories = $categoryService->all();

        return view('posts.create', compact('channels', 'categories'));
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return mixed
     */
    public function store(PostRequest $request, Post $post)
    {
        $data = $request->all();
        if ($data['category_id']) {
            $data['category_id'] = ','.implode(',', $data['category_id']).',';
        }
        $data['user_id'] = auth()->user()->id;
        $post->create($data);

        return redirect()->route('post.index')->withStatus(__('Post successfully created.'));
    }

    /**
     * Display the specified resource.
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post, Channels $channelService, Categories $categoryService)
    {
        $channels = $channelService->all();
        $categories = $categoryService->all();

        return view('posts.edit', compact('post', 'channels', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Post $post
     * @return Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();
        if (!empty($data['category_id'])) {
            $data['category_id'] = ','.implode(',', $data['category_id']).',';
        }

        $post->update($data);

        return redirect()->route('post.index')->withStatus(__('Post successfully updated.'));
    }

    /**
     * @param Post $post
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.index')->withStatus(__('Post successfully deleted.'));
    }
}
