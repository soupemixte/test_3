@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<main class="flex-center height60">
    <section class="structure flex-col gap10">
        <div class="section-title">
            <h1>Modifier mon profil</h1>
        </div>
        <!-- <div class="line"></div>  -->
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
                <input type="text" id="email" name="email"  value="{{old('email', $user->email)}}">
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        {{$errors->first('email')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-icon btn-go flex-al just-between">@lang('lang.update')<i class="fa-solid fa-floppy-disk"></i></button>
        </form>
        @if(Auth::id() == $user->id)
        <button class="btn-icon btn-remove flex-al just-between" id="delete-btn">@lang('lang.delete')<i class="fa-solid fa-trash"></i></button>
        <div class="popup-overlay hide" id="popup-overlay">
            <div class="popup-delete">
                <div class="message">
                    <h2>Etes-vous sûr de vouloir supprimer ?</h2>
                </div>
                <div class="confirm-buttons">
                    <button id="cancel-btn">Annuler <i class="fa-solid fa-ban"></i></button>
                    <form action="{{ route('user.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-icon btn-remove flex-al just-between">@lang('lang.delete')<i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </section>
</main>

<script src="{{ asset('js/classes/ConfirmationModal.js') }}"></script>
@endsection