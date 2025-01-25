@extends('layouts.app')
@section('title', 'Registration')
@section('content')
<main class="flex-center">
    <section class="structure flex-col-center height60 gap20">
        <form action="{{ route('user.store') }}" method="POST" class="form">
            @csrf
            <div class="form-control">
                <label for="name">@lang('lang.user_name')</label>
                <input type="text" id="name" name="name" value="{{old('name')}}">
                @if ($errors->has('name'))
                    <div class="alert_msg">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="email">@lang('lang.email')</label>
                <input type="text" id="username" name="email"  value="{{old('email')}}">
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        {{$errors->first('email')}}
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="password">@lang('lang.password')</label>
                <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="alert_msg">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="password_confirmation">@lang('lang.password_confirm')</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
                @if($errors->has('password_confirmation'))
                    <div class="alert_msg">
                        {{$errors->first('password_confirmation')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border">@lang('lang.save')</button>
        </form>

        <div class="form_footer">
            <p>@lang('lang.login_member') <a href="{{ route('user.login') }}" class="new_member">@lang('lang.login')</a></p>
        </div>
    </section>
</main>
@endsection