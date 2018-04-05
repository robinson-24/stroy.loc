<?php
namespace App\Http\Controllers\Contracts;

interface CategoryInterface
{
    public function getCategory($where = null);
    public function addCategory($where);
    public function updateCategory($where, $values);
    public function deleteCategory($where);
}