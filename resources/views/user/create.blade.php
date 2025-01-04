@extends('layouts.app')
@section('title', 'Registration')
@section('content')
    @if(!$errors->isEmpty())
    <div class="" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>                
    @endif
    <h1 class="">Registration</h1>
    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    <h5 class="">Registration</h5>
                </div>
                <div class="">
                    <form  method="POST">
                        @csrf
                        <div class="">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>
                        <div class="">
                            <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="email"  value="{{old('email')}}">
                            </div>
                        <div class="">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection