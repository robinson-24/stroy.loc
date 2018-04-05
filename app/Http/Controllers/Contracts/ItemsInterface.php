<?php
namespace App\Http\Controllers\Contracts;

interface ItemsInterface
{
    public function getItems($where = null);
    public function addItems($where);
    public function updateItems($where, $values);
    public function deleteItems($where);
}