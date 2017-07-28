@extends('layouts.layout')

@section('content')
<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<h3>Orders:</h3>
<table>
    <tr class="tableHeaders">
        <td onclick="sortTable('dishName')">Dish</td>
        <td onclick="sortTable('tableNum')">Table</td>
        <td onclick="sortTable('waiterName')">Waiter</td>
        <td onclick="sortTable('status')" style="width:80px;">Status</td>
        <td>Change status</td>
        <td onclick="sortTable('timerValue')">Time</td>
        <td>Set timer</td>
        <td></td>
    </tr>
    <form>
    {{ csrf_field() }}
    @foreach ($orders as $order)    
    <tr class="tableData">
        <td class="dishName">{{$order->dish_name}}</td>
        <td class="tableNum">{{$order->table_num}}</td>
        <td class="waiterName">{{$order->name}}</td>
        <td class="status" id="statustd{{$order->id}}">{{$order->status}}</td>
        <td>
        <select onchange="changeStatus({{$order->id}}, '{{ csrf_token() }}')" id="chngStatus{{$order->id}}">
            <option value="kitchen">-</option>
            <option value="is preparing">is preparing</option>
            <option value="ready">ready</option>
        </select>
        </td>
        <td class="timer" id="timetd{{$order->id}}">{{$order->time}}</td>
        <td>
            <input type="text" name="time" id="time{{$order->id}}" size="3">
            <input onclick="setTimer({{$order->id}}, '{{ csrf_token() }}')" type="button" value="Set" />
        </td>
        <td class='timerValue' id="timetdd{{$order->id}}" >{{$order->time}}</td>
    </tr>
    @endforeach
    <input id="finishTime" name="finishTime" type="hidden" value="0" />
    </form>
</table>
<input type="hidden" id="sort" value="0" />

<script>
changeTimers();
    



</script>
@endsection