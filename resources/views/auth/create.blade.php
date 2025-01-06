@extends('layouts.app')
@section('title', 'Login')
@section('content')

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
<main class="login">        
    <section>
        <h2 class="section-title">Authentification</h2>
        <div class="login_form">
        <form method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="email"  value="{{old('email')}}">
                </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="login_btn">Login</button>
            </form>
        <div>
            <p>Pas encore membre ? <a href="{{ route('user.create') }}" class="new_member">Créer un compte</a></p>
        </div>
        </div>
    </section>

</main>
@endsection