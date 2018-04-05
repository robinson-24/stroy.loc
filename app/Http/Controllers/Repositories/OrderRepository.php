<?php
namespace app\Http\Controllers\Repositories;

use App\Http\Controllers\Contracts\OrderInterface;
use App\Eloquent\Order;

class OrderRepository implements OrderInterface
{
    public function getOrder($where = null)
    {
        $order = new Order();

        if (!empty($where)) {
            foreach ($where as $attribute => $value) {
                $order = $order->where($attribute, $value);
            }
        }

        $order = $order->orderBy('order.created_at', 'desc');

        return $order->get();
    }

    public function addOrder($where)
    {
        $order = new Order();

        foreach ($where as $attribute => $value) {
            $order->$attribute = $value;
        }

        $order->save();

        return $order;
    }

    public function updateOrder($where, $values)
    {
        $order = new Order();

        foreach ($where as $attribute => $value) {
            $order = $order->where($attribute, $value);
        }

        $order = $order->update($values);

        return $order;
    }

    public function deleteOrder($where)
    {
        $order = new Order();

        foreach ($where as $attribute => $value) {
            $order = $order->where($attribute, $value);
        }

        $order->delete();
    }

}