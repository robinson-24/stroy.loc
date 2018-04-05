<?php
namespace app\Http\Controllers\Repositories;

use App\Http\Controllers\Contracts\ItemsInterface;
use App\Eloquent\Items;

class ItemsRepository implements ItemsInterface
{
    public function getItems($where = null)
    {
        $items = new Items();

        if (!empty($where)) {
            foreach ($where as $attribute => $value) {
                $items = $items->where($attribute, $value);
            }
        }

        $items = $items
            ->leftJoin('image', 'items.image', '=', 'image.id')
            ->leftJoin('category', 'items.category', '=', 'category.id')
            ->leftJoin('seo as seo_title', 'items.title', '=', 'seo_title.id')
            ->leftJoin('seo as seo_description', 'items.description', '=', 'seo_description.id')
            ->select(
                    'items.id', 'items.slug', 'items.name', 'items.characteristics',
                    'image.name as image_name', 'category.name as category',
                    'image.alt as image_alt', 'image.id as image_id', 'seo_title.data as title',
                    'seo_title.id as title_id', 'seo_description.id as description_id',
                    'seo_description.data as description', 'items.show', 'items.existence',
                    'items.price', 'items.category as category_id'
            )->orderBy('items.created_at', 'desc');

        return $items->get();
    }

    public function addItems($where)
    {
        $items = new Items();

        foreach ($where as $attribute => $value) {
            $items->$attribute = $value;
        }

        $items->save();

        return $items;
    }

    public function updateItems($where, $values)
    {
        $items = new Items();

        foreach ($where as $attribute => $value) {
            $items = $items->where($attribute, $value);
        }

        $items = $items->update($values);

        return $items;
    }

    public function deleteItems($where)
    {
        $items = new Items();

        foreach ($where as $attribute => $value) {
            $items = $items->where($attribute, $value);
        }

        $items->delete();
    }

}