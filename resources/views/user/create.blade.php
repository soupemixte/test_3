@extends('layouts.app')
@section('title', 'Registration')
@section('content')

<main class="register">
    <section class="registration">
        <h2 class="section-title">@lang('lang.register')</h2>
        <div class="form">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3 col">
                    <label for="email">@lang('lang.email')</label>
                    <!-- <p id="form-email">@lang('lang.email')</p> -->
                    <input type="text" id="email" name="email" value="{{old('email')}}" placeholder="@lang('lang.email_msg')">
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        {{$errors->first('email')}}
                    </div>
                @endif
            </div>


            <div class="mb-3 col">
                    <label for="password">@lang('lang.password')</label>
                    <!-- <p id="form-password">@lang('lang.password')</p> -->
                    <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="alert_msg">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <div class="mb-3 col">
                    <label for="password_confirm">@lang('lang.password_confirm')</label>
                    <!-- <p id="form-password_confirm">@lang('lang.password_confirm')</p> -->
                    <input type="password" id="password_confirm" name="password_confirm">
                @if ($errors->has('password_confirm'))
                    <div class="alert_msg">
                        {{$errors->first('password_confirm')}}
                    </div>
                @endif
            </div>
            <div class="mb-3 col">
                    <label for="name">@lang('lang.user_name')</label>
                    <!-- <p id="form-name">@lang('lang.user_name')</p> -->
                    <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="@lang('lang.name_msg')">
                @if ($errors->has('name'))
                    <div class="alert_msg">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
            
            <button type="submit" class="register_btn">@lang('lang.save')</button>
        </form>
        <div class="new">
            <p>@lang('lang.register_question')<a href="{{ route('user.create') }}" class="new_member">@lang('lang.register_subtitle')</a></p>
        </div>
        </div>
    </section>
</main>
@endsection