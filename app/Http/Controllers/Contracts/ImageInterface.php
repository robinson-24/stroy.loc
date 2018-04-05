<?php
namespace App\Http\Controllers\Contracts;

interface ImageInterface
{
    //public function getImage($where = null);
    public function addImage($where);
    public function updateImage($where, $values);
    public function deleteImage($where);
}