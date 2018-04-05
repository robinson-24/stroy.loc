<?php
namespace app\Http\Controllers\Repositories;

use App\Http\Controllers\Contracts\ImageInterface;
use App\Eloquent\Image;

class ImageRepository implements ImageInterface
{
    /*public function getImage($where = null)
    {
        $category = new Image();

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
                    'image.alt as image_alt', 'seo_title.data as title',
                    'seo_description.data as description', 'category.show'
                );

        return $category->get();
    }*/

    public function addImage($where)
    {
        $image = new Image();

        foreach ($where as $attribute => $value) {
            $image->$attribute = $value;
        }

        $image->save();

        return $image;
    }

    public function deleteImage($where)
    {
        $image = new Image();

        foreach ($where as $attribute => $value) {
            $image = $image->where($attribute, $value);
        }

        $image->delete();
    }

    public function updateImage($where, $values)
    {
        $image = new Image();

        foreach ($where as $attribute => $value) {
            $image = $image->where($attribute, $value);
        }

        $image = $image->update($values);

        return $image;
    }

/*    public function updateCategory($where, $values);
    public function deleteCategory($where);*/
}