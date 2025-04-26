<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function create(array $data)
    {
        return Category::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'status' => 1, // default active
        ]);
    }

    public function getAll()
    {
        $perPage = request()->input('per_page', 10); // Default 10

        return Category::where('status', 1)->paginate($perPage);
    }
}
