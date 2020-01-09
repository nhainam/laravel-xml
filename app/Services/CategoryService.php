<?php


namespace App\Services;


use App\Contracts\Categories;
use App\Models\Category;

class CategoryService implements Categories
{

    /**
     * @return Category[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return Category::all();
    }
    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function findByName(string $name): ?Category
    {
        return Category::where('name', '=', $name)->first();
    }

    public function findByArrayName(array $names): array
    {
        return Category::whereIn('name', $names)->get();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Category
    {
        $category = new Category();
        if ($data) {
            $category->fill($data);
            $category->save();
        }
        return $category;
    }

    /**
     * @inheritDoc
     */
    public function update(Category $category, array $data): Category
    {
        if ($data) {
            $category->fill($data);
            $category->save();
        }
        return $category;
    }

    /**
     * @inheritDoc
     */
    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
