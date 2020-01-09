<?php


namespace App\Services;


use App\Contracts\Posts;
use App\Models\Category;
use App\Models\Post;

class PostService implements Posts
{
    /**
     * @inheritDoc
     */
    public function list($category, $per_page)
    {
        if ($per_page < 0) {
            $per_page = 5;
        }

        return Post::where('category_id', 'like', "%{$category}%")
            ->paginate($per_page)
            ->appends([
                'category' => $category,
                'per_page' => $per_page
            ]);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Post
    {
        return Post::find($id);
    }

    /**
     * @inheritDoc
     */
    public function findByCategoryId(int $categoryId): ?array
    {
        return Post::where('category_id', '=', $categoryId)->get();
    }

    /**
     * @inheritDoc
     */
    public function findByChannelId(int $channelId): ?array
    {
        return Post::where('channel_id', '=', $channelId)->get();
    }

    /**
     * @inheritDoc
     */
    public function findByName(string $name): ?Post
    {
        return Post::where('name', '=', $name)->first();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Post
    {
        $post = new Post();
        if ($data) {
            $post->fill($data);
            $post->save();
        }
        return $post;
    }

    /**
     * @inheritDoc
     */
    public function update(Post $post, array $data): Post
    {
        if ($data) {
            $post->fill($data);
            $post->save();
        }
        return $post;
    }

    /**
     * @inheritDoc
     */
    public function delete(Post $post): bool
    {
        return $post->delete();
    }
}
