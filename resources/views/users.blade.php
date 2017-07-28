@extends('layouts.layout')
@section('content')
    <table>
        <tr class="tableHeaders">
            <td onclick="sortTable('userName')">Name</td>
            <td onclick="sortTable('email')">Email</td>
            <td onclick="sortTable('date')">Created</td>
        </tr>
        @foreach ($users as $user)
        <tr class="tableData">
            <td class="userName">{{$user->name}}</td>
            <td class="email">{{$user->email}}</td>
            <td class="date">{{$user->created_at}}</td>
        </tr>
        @endforeach
    </table>
    <input type="hidden" id="sort" value="0" />

@endsection