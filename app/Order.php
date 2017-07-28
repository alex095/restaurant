<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    public $timestamps = false;

    public function addOrder($dish, $tableNum, $waiter){
        $order = new Order;
        $order->table_num = $tableNum;
        //var_dump($order->getDishId($dish));
        $order->dish_id = $order->getDishId($dish)[0]->id;
        $order->waiter_id = $order->getWaiterId($waiter)[0]->id;
        $order->status_id = 4;
        $order->time = 0;
        $order->save();
    }

    public function sendEmail($to, $topic, $message){
        Mail::raw($message, function($message){
            $message->from('info@restaurant.com', $topic);
            $message->to($to);
        });
    }

    public function getWaitersOrders($waiter){
        return DB::select('SELECT a.id, b.dish_name, c.name, d.status, a.table_num, a.time
                            FROM orders AS a
                            INNER JOIN dishes AS b ON a.dish_id = b.id
                            INNER JOIN users AS c ON a.waiter_id = c.id
                            INNER JOIN statuses AS d ON a.status_id = d.id
                            WHERE c.name = ?', [$waiter]);
    }

    public function getDishId($dishName){
        return DB::select('SELECT id FROM dishes WHERE dish_name = ?', [$dishName]);
    }

    public function getDishStatus($status){
        return DB::select('SELECT status FROM statuses WHERE status = ?', [$status]);
    }

    public function getWaiterId($waiter){
        return DB::select('SELECT id FROM users WHERE name = ?', [$waiter]);
    }


    public function getWaiterName($id){
        return DB::select('SELECT c.name
                            FROM orders AS a
                            INNER JOIN users AS c ON a.waiter_id = c.id
                            WHERE c.id = ? LIMIT 1', [$id]);
        
    }

    public function getDishes(){
        return DB::select('SELECT dish_name FROM dishes');
    }

    public function getKitchenInfo(){
        return DB::select('SELECT a.id, b.dish_name, c.name, d.status, a.table_num, a.time
                            FROM orders AS a
                            INNER JOIN dishes AS b ON a.dish_id = b.id
                            INNER JOIN users AS c ON a.waiter_id = c.id
                            INNER JOIN statuses AS d ON a.status_id = d.id
                            WHERE d.id != 1');
    }

    public function saveTimeData($id, $timestamp){
        DB::table('orders')->where('id', $id)->update(['time' => $timestamp]);
    }

    public function saveStatusData($orderId, $statusId){
        DB::table('orders')->where('id', $orderId)->update(['status_id' => $statusId]);
    }

}
