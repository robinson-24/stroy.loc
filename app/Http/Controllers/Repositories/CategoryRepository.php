<?php
namespace app\Http\Controllers\Repositories;

use App\Http\Controllers\Contracts\CategoryInterface;
use App\Eloquent\Category;

class CategoryRepository implements CategoryInterface
{
    public function getCategory($where = null)
    {
        $category = new Category();

        if (!empty($where)) {
            foreach ($where as $attribute => $value) {
                $category = $category->where($attribute, $value);
            }
        }

        $category = $category
            ->leftJoin('image', 'category.image', '=', 'image.id')
            ->leftJoin('seo as seo_title', 'category.title', '=', 'seo_title.id')
            ->leftJoin('seo as seo_description', 'category.description', '=', 'seo_description.id')
            ->select(
                    'category.id', 'category.slug', 'category.name', 'category.intro_description',
                    'category.full_description', 'image.name as image_name',
                    'image.alt as image_alt', 'image.id as image_id', 'seo_title.data as title',
                    'seo_title.id as title_id', 'seo_description.id as description_id',
                    'seo_description.data as description', 'category.show'
            )->orderBy('category.name');

        return $category->get();
    }

    public function addCategory($where)
    {
        $category = new Category();

        foreach ($where as $attribute => $value) {
            $category->$attribute = $value;
        }

        $category->save();

        return $category;
    }

    public function updateCategory($where, $values)
    {
        $category = new Category();

        foreach ($where as $attribute => $value) {
            $category = $category->where($attribute, $value);
        }

        $category = $category->update($values);

        return $category;
    }

    public function deleteCategory($where)
    {
        $category = new Category();

        foreach ($where as $attribute => $value) {
            $category = $category->where($attribute, $value);
        }

        $category->delete();
    }

}