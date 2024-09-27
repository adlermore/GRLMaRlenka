<?php

namespace App\Utility;

use App\Models\Category;

class CategoryUtility
{
    public static function delete_category($id)
    {
        $category = Category::where('id', $id)->first();
        if (!is_null($category)) {
            CategoryUtility::move_children_to_parent($category->id);
            $category->delete();
        }
    }
}
