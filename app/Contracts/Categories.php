<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Contracts;


use App\Models\Category;

interface Categories
{
    /**
     * @return mixed
     */
    public function all();
    /**
     * @param int $id
     * @return Category
     */
    public function findById(int $id): ?Category;

    /**
     * @param string $name
     * @return Category
     */
    public function findByName(string $name): ?Category;

    /**
     * @param array $names
     * @return array
     */
    public function findByArrayName(array $names):array;

    /**
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category;

    /**
     * @param Category $category
     * @param array $data
     * @return Category
     */
    public function update(Category $category, array $data): Category;

    /**
     * @param Category $category
     * @return bool
     */
    public function delete(Category $category): bool;
}
