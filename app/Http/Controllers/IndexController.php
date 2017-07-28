<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Order;
use App\User;

class IndexController extends Controller
{
    public function add(){
        if(Auth::user()->name === 'kitchen'){
            return redirect('kitchen');
        }
        $model = new Order();
        $dishes = $model->getDishes();
        //var_dump($dishes);
        return view('add', ['dishes' => $dishes]);
    }

    public function addOrder(){
        $dish = request('dish');
        $tableNum = request('tableNum');
        $waiterName = request('waiter');
        $model = new Order();
        $model->addOrder($dish, $tableNum, $waiterName);
        $model1 = new User();
        $model->sendEmail($model1->getUserEmail('kitchen'), 'New order', 'A new order has arrived');
        return redirect('/orders?waiter=' . $waiterName);
    }

    public function showOrders(){
        $model = new Order();
        $orders = $model->getKitchenInfo();
        return view('kitchen', ['orders' => $orders]);
    }

    public function showWaitersOrders(){
        $model = new Order();
        $waiter = request('waiter');
        $orders = $model->getWaitersOrders($waiter);

        return view('orders', ['orders' => $orders]);
    }


    public function saveTime(){
        $model = new Order();
        $model->saveTimeData(request('id'), request('time'));
    }

    public function saveStatus(){
        $model = new Order();
        $orderId = request('orderId');
        $model->saveStatusData($orderId, request('statusId'));
        $waiterName = $model->getWaiterName($orderId);
        $model->sendEmail($model1->getUserEmail($waiterName), 'Status', 'Status changed. Order id:' . $orderId);
    }


    public function showUsers(){
        $model = new User();
        $users = $model->getUsers();
        return view('users', ['users' => $users]);
    }


}
