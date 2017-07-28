@extends('layouts.layout')

@section('content')
<a href="/add">Back</a>
<h3>Your orders:</h3>
<table>
    <tr>
        <td>Dish</td>
        <td>Table</td>
        <td>Waiter</td>
        <td style="width:80px;">Status</td>
        <td>Time</td>
    </tr>
    <form>
    @foreach ($orders as $order)    
    <tr>
        <td>{{$order->dish_name}}</td>
        <td>{{$order->table_num}}</td>
        <td>{{$order->name}}</td>
        <td id="statustdd{{$order->id}}">
        {{$order->status}}
        </td>
        <td class="timer" id="timetd{{$order->id}}">{{$order->time}}</td>
        <span class="timerValue" id="timetdd{{$order->id}}">{{$order->time}}</span>
    </tr>
    @endforeach
    <input id="finishTime" name="finishTime" type="hidden" value="0" />
    </form>
</table>
<script>
changeTimers();
</script>
@endsection