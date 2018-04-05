<?php
namespace App\Http\Controllers\Contracts;

interface OrderInterface
{
    public function getOrder($where = null);
    public function addOrder($where);
    public function updateOrder($where, $values);
    public function deleteOrder($where);
}