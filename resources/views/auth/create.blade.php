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

<!---composant pour le titre et la description de la page-->
<!-- <x-header 
    title="{{ __('lang.registration') }}"
    subtitle="{{ __('lang.register_subtitle') }}"
/> -->
<main class="flex-center">
    <section class="structure flex-col-center height60 gap20">
        <form method="POST" class="form">
            @csrf
            <div class="form-control">
                <label for="username" >@lang('lang.email')</label>
                    <input type="text" id="username" name="email" value="{{old('email')}}">
                </div>
                @if ($errors->has('username'))
                    <div class="alert_msg">
                        {{$errors->first('username')}}
                    </div>
                @endif
            <div class="form-control">
                <label for="password">@lang('lang.password')</label>
                <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="alert_msg">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border">@lang('lang.login')</button>
        </form>
        
        <div class="form_footer">
            <p>@lang('lang.register_question')<a href="{{ route('user.create') }}" class="new_member">@lang('lang.register_subtitle')</a></p>
        </div>
        
    </section>
</main>
@endsection