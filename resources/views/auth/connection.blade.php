@extends('layouts.app')
@section('title', 'Choisissez le rôle à connecter')
@section('content')

<main class="flex-center height80">
    <div class="structure flex-col-center gap20">
        <h1 class="page-title">Sélectionnez votre rôle pour vous connecter.</h1>
        <a href="{{ route('user.login') }}">
            <div class="link-card">
                <img src="{{asset('img/icons/user.png') }}">
                <p>Utilisateur</p>
            </div>
        </a>
        <a href="{{ route('admin.login') }}">
            <div class="link-card">
                <img src="{{asset('img/icons/admin.png') }}">
                <p>Administrateur</p>
            </div>
        </a>
    </div>
</main>

@endsection