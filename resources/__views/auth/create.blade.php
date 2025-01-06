@extends('layouts.app')
@section('title', 'Login')
@section('content')
<main class="flex-center">
@if(!$errors->isEmpty())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>                
    @endif          
    <!-- <section class="structure flex-col-center height90 gap20">
        <form method="POST" class="form">
            @csrf
            <div class="form-control">
                <label for="username" >Username</label>
                    <input type="text" id="username" name="email"  value="{{old('email')}}">
                </div>
                @if ($errors->has('username'))
                    <div class="">
                        {{$errors->first('username')}}
                    </div>
                @endif
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border">Login</button>
        </form>
        
        <div class="form_footer">
            <p>Pas encore membre ? <a href="{{ route('user.create') }}">Créer un compte</a></p>
        </div>
        
    </section> -->

    <div class="structure flex-col-center height90 gap20">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Login</h5>
                </div>
                <div class="card-body">
                    <form  method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="email"  value="{{old('email')}}">
                            </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <div>
                        <p>Pas encore membre ? <a href="{{ route('user.create') }}">Créer un compte</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection