<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Contracts;

use App\Models\Post;

/**
 * Interface Posts
 * @package App\Contracts
 */
interface Posts
{
    /**
     * @param string $category
     * @param string $per_page
     * @return mixed
     */
    public function list(string $category, string $per_page);

    /**
     * Find a post by Id
     * @param int $id
     * @return Post
     */
    public function findById(int $id): ?Post;

    /**
     * Find all posts by Category Id
     * @param int $categoryId
     * @return array|null
     */
    public function findByCategoryId(int $categoryId):?array;

    /**
     * Find all posts by Channel Id
     * @param int $channelId
     * @return array|null
     */
    public function findByChannelId(int $channelId):?array;

    /**
     * @param string $name
     * @return Post|null
     */
    public function findByName(string $name):?Post;

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post;

    /**
     * @param Post $post
     * @param array $data
     * @return Post
     */
    public function update(Post $post, array $data):Post;

    /**
     * @param Post $post
     * @return bool
     */
    public function delete(Post $post):bool;
}
