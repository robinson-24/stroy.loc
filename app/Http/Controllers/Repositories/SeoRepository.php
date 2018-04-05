<?php
namespace app\Http\Controllers\Repositories;

use App\Http\Controllers\Contracts\SeoInterface;
use App\Eloquent\Seo;

class SeoRepository implements SeoInterface
{
    public function getSeo($where = null)
    {
        $seo = new Seo();

        if (!empty($where)) {
            foreach ($where as $attribute => $value) {
                $seo = $seo->where($attribute, $value);
            }
        }

        return $seo->get();
    }

    public function addSeo($where)
    {
        $seo = new Seo();

        foreach ($where as $attribute => $value) {
            $seo->$attribute = $value;
        }

        $seo->save();

        return $seo;
    }

    public function updateSeo($where, $values)
    {
        $seo = new Seo();

        foreach ($where as $attribute => $value) {
            $seo = $seo->where($attribute, $value);
        }

        $seo = $seo->update($values);

        return $seo;
    }

    public function deleteSeo($where)
    {
        $seo = new Seo();

        foreach ($where as $attribute => $value) {
            $seo = $seo->where($attribute, $value);
        }

        $seo->delete();
    }
}