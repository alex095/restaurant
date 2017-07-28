@extends('layouts.layout')
@section('content')
<b>{{ Auth::user()->name }}</b>
<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<a href="orders?waiter={{ Auth::user()->name }}">Your orders</a>
<p>    
    <form method="POST" action="/addOrder">
    {{csrf_field()}}
        <input name="dish" id="dish" type="text" list="dishes" placeholder="Dish name" />
        <datalist id="dishes">
            @foreach ($dishes as $dish)
            <option value="{{$dish->dish_name}}">
            @endforeach
        </datalist>
        <p>
            Table: <input name="tableNum" id="tableNum" type="number" min="1" max="10" value="1" />
        </p>
        <input type="hidden" name="waiter" id="waiter" value="{{ Auth::user()->name }}" />
        <input type="submit" value="Add order" />
    </form>
</p>

@endsection