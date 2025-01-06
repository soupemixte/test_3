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
            <div class="mb-3">
                <label for="name">@lang('lang.user_name')</label>
                <input type="text" id="name" name="name" value="{{old('name')}}">
                @if ($errors->has('name'))
                    <div class="form_input_error">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="email">@lang('lang.username')</label>
                <input type="text" id="username" name="email"  value="{{old('email')}}">
                @if ($errors->has('email'))
                    <div class="form_input_error">
                        {{$errors->first('email')}}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="password">@lang('lang.password')</label>
                <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="form_input_error">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <div class="mb-3 col">
                <label for="password_confirm">@lang('lang.password_confirm')</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
                @if($errors->has('password_confirm'))
                    <div class="form_input_error">
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