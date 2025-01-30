@extends('layouts.app')
@section('title', 'Login')
@section('content')

<main class="flex-center height60">
    <section class="structure flex-col gap10">
        <div class="section-title">
            <h1>Connexion utilisateur</h1>
        </div>
        <!-- <div class="line"></div> -->
        <form method="POST" class="form" action="{{ route('user.login.submit') }}">
            @csrf
            <div class="form-control">
                <label for="username" >@lang('lang.email')</label>
                <input type="text" id="username" name="email" value="{{old('email', $user->email ?? '')}}">
                
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        <p>
                            {{$errors->first('email')}}
                        </p>
                    </div>
                @endif
                </div>
            <div class="form-control">
                <label for="password">@lang('lang.password')</label>
                <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="alert_msg">
                        <p>
                            {{$errors->first('password')}}
                        </p>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-icon btn-go flex-al just-between">@lang('lang.login')<i class="fa-solid fa-right-to-bracket"></i></button>
        </form>
        
        <div class="form_footer">
            <p>@lang('lang.register_question') <a href="{{ route('user.create') }}" class="new_member">@lang('lang.register_subtitle')</a></p>
        </div>
        
    </section>
</main>
@endsection