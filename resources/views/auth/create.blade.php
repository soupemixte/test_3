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


<x-header 
    title="{{ __('lang.registration') }}"
    subtitle="{{ __('lang.register_subtitle') }}"
/>
<main class="flex-center">
    <section class="structure flex-col-center height60 gap20">
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
        
    </section>
</main>
@endsection