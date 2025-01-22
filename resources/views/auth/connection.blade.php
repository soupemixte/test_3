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
        <form  method="POST">
            @csrf
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-tab-panel" type="button" role="tab" aria-controls="user-tab-panel" aria-selected="true">@lang('lang.user')</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="englsih-tab" data-bs-toggle="tab" data-bs-target="#admin-tab-panel" type="button" role="tab" aria-controls="admin-tab-panel" aria-selected="false">@lang('lang.admin')</button>
                </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="" id="user-tab-panel" role="tabpanel" aria-labelledby="user-tab" tabindex="0">
                        <div class="form-control">
                        <label for="email_user">@lang('lang.email')</label>
                            <input type="text" class="form-control" id="email_user" name="email_user" value="{{old('email_user')}}">
                            @if($errors->has('email_user'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('email_user')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-control">
                            <label for="password_user">@lang('lang.password')</label>
                            <input type="password" id="password_user" name="password_user">
                            @if ($errors->has('password_user'))
                                <div class="alert_msg">
                                    {{$errors->first('password_user')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="" id="admin-tab-panel" role="tabpanel" aria-labelledby="admin-tab"  tabindex="0">
                    <div class="form-control">
                        <label for="email_admin">@lang('lang.email')</label>
                            <input type="text" class="form-control" id="email_admin" name="email_admin" value="{{old('email_admin')}}">
                            @if($errors->has('email_admin'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('email_admin')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-control">
                            <label for="password_admin">@lang('lang.password')</label>
                            <input type="password" id="password" name="password_admin">
                            @if ($errors->has('password_admin'))
                                <div class="alert_msg">
                                    {{$errors->first('password_admin')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            
            
            <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
        </form>
    </div>
</main>

@endsection