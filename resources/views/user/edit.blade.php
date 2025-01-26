@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<main class="flex-center">
    <section class="structure flex-col-center height60 gap20">
        <form method="POST" class="form">
            @csrf
            @method('put')
            <div class="form-control">
                <label for="name">@lang('lang.user_name')</label>
                <input type="text" id="name" name="name" value="{{old('name', $user->name)}}">
                @if ($errors->has('name'))
                    <div class="alert_msg">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="email">@lang('lang.email')</label>
                <input type="text" id="username" name="email"  value="{{old('email', $user->email)}}">
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        {{$errors->first('email')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border">@lang('lang.update')</button>
        </form>
    </section>
</main>
@endsection