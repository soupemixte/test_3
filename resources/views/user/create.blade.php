@extends('layouts.app')
@section('title', 'Registration')
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

<main class="register">
    <section>
        <h2 class="section-title">@lang('lang.register')</h2>
        <div class="form">

       
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3 col">
                <div class="row">
                    <label for="name">@lang('lang.user_name')</label>
                    <input type="text" id="name" name="name" value="{{old('name')}}">
                </div>
                @if ($errors->has('name'))
                    <div class="alert_msg">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
            <div class="mb-3 col">
                <div class="row">
                    <label for="email">@lang('lang.username')</label>
                    <input type="text" id="username" name="email"  value="{{old('email')}}">
                </div>
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        {{$errors->first('email')}}
                    </div>
                @endif
            </div>
            <div class="mb-3 col">
                <div class="row">
                    <label for="password">@lang('lang.password')</label>
                    <input type="password" id="password" name="password">
                </div>
                @if ($errors->has('password'))
                    <div class="alert_msg">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <div class="mb-3 col">
                <div class="row">
                    <label for="password_confirm">@lang('lang.password_confirm')</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
                @if($errors->has('password_confirm'))
                    <div class="alert_msg">
                        {{$errors->first('password_confirm')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="register_btn">@lang('lang.save')</button>
        </form>
        <div>
            <p>@lang('lang.register_question')<a href="{{ route('user.create') }}" class="new_member">@lang('lang.register_subtitle')</a></p>
        </div>
        </div>
    </section>
</main>
@endsection