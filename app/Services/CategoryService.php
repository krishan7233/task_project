<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Models\Category;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepo->create($data);
    }

    public function update($id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);
        return $category;
    }



    public function getAll()
    {
        return $this->categoryRepo->getAll();
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }

}
