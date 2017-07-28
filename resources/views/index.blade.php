@extends('layouts.layout')

@section('content')
    <form action="login" method="post">
        <p><input type="text" name="login" /></p>
        <p><input type="password" name="pwd" /></p>
        <button type="submit">Enter</button>
    </form>
@endsection