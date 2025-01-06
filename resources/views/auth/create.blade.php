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

<!--composant pour donner le titre et le sous-titre à la page-->
<x-header 
         title="{{ __('lang.login') }}"
        subtitle="{{ __('lang.login_subtitle') }}"
/>

<main class="flex-center"> 
    <div class="structure flex-col-center height60 gap20">
      
            <div class="card">
                <div class="card-body">
                    <form  method="POST" class="form">
                        @csrf
                        <div class="form-control">
                            <label for="username" >Username</label>
                                <input type="text" id="username" name="email"  value="{{old('email')}}">
                            </div>
                        <div class="form-control">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <footer class="form_footer">
                        <p>Pas encore membre ? <a href="{{ route('user.create') }}">Créer un compte</a></p>
                    </footer>
                </div>
            </div>
    </div>
</main>
@endsection