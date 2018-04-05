<?php
namespace App\Http\Controllers\Contracts;

interface SeoInterface
{
   public function getSeo($where = null);
    public function addSeo($where);
    public function updateSeo($where, $values);
    public function deleteSeo($where);
}