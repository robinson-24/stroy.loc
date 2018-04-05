<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use Validator;
use Session;
use Route;
use App\Libraries\GeneralFunctions;

use App\Http\Controllers\Contracts\OrderInterface;

class OrderController extends Controller
{

    private $order;

    public function __construct(
        OrderInterface $order
    ){
        $this->order = $order;
        $this->middleware('auth');
    }

    public function show()
    {
        $data = [];
        $orders = $this->order->getOrder();
        
        $data = array_merge($data, [
            'orders' => $orders
        ]);

        return view('home', $data);
    }

    public function countOrder()
    {
        $orders = $this->order->getOrder(['order.visit' => 0]);
        return count($orders);
    }

    public function add()
    {
        $data = [];

        $email = $_POST['email'];
        if(trim($email) != ''){
            $data['email'] = $email;
        }
        $name = $_POST['name'];
        $tel = $_POST['tel'];

        $data = array_merge($data,[
            'name' => $name,
            'tel' => $tel
        ]);

        try {
            $this->order->addOrder($data);
            return 'true';
        } catch (\Exception $e) {
            return 'false';
        }
    }

    public function visit()
    {
        $this->order->updateOrder(['order.id' => $_POST['id']], ['order.visit' => 1]);
    }
}
