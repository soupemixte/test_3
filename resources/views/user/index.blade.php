@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <h1 class="">Users</h1>
    <div class="users">

            <div class="">
                <div class="card-header">
                    <h5 class="card-title">Users</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Cellars</th>
                        <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <!-- list of cellars -->
                            <!-- list of bottles -->
                            <td>
                                <a href="{{route('user.edit', $user->id)}}"class="btn btn-sm btn-outline-success">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users }}
                </div>
            </div>
    </div>
@endsection