@extends('layouts.app')
@section('title', 'Registration')
@section('content')


<main class="flex-center height60">
    <section class="structure flex-col gap10">
        <div class="section-title">
            <h1>Formulaire création d'usager.</h1>
        </div>
        <!-- <div class="line"></div>  -->
        <form action="{{ route('user.store') }}" method="POST" class="form">
            @csrf
            <div class="form-control">
                <label for="name">@lang('lang.user_name')</label>
                <input type="text" id="name" name="name" value="{{old('name')}}">
                @if ($errors->has('name'))
                    <div class="alert_msg">
                        <p>
                            {{$errors->first('name')}}
                        </p>
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="email">@lang('lang.email')</label>
                <input type="text" id="email" name="email"  value="{{old('email')}}">
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
                <p>Au moins une lettre, au moins une majuscule ET une minuscule, doit contenir au moins un chiffre.</p>
                {{$errors->first('password')}}
                   
                    </div>
                @endif
            </div>

            <button type="submit" class="btn-icon btn-go flex-al just-between">@lang('lang.save')<i class="fa-solid fa-floppy-disk"></i></button>
        </form>

        <div class="form_footer">
            <p>@lang('lang.login_member') <a href="{{ route('user.login') }}" class="new_member">@lang('lang.login')</a></p>
        </div>
    </section>
</main>
@endsection