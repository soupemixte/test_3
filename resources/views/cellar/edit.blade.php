@extends('layouts.app')
@section('title', 'Edit cellar')
@section('content')
<main class="flex-center height70">
    <section class="structure flex-col gap10">
    <div class="section-title">
        <h1>Modifier : {{ $cellar->title }}</h1>
    </div>
    <!-- <div class="line"></div>     -->
        <form class="form" method="POST">
            @csrf
            @method('put')
            <div class="form-control">
                <label for="title">@lang('lang.cellar_name')</label>
                <input type="text" name="title" id="title" value="{{ old('title', $cellar->title) }}" placeholder="Entrez le nom...">
                @if ($errors->has('title'))
                <div class="alert_msg">
                    {{$errors->first('title')}}
                </div>
                @endif
            </div>
            <div class="form-control">
                <label for="description">@lang('lang.cellar_desc')</label>
                <textarea name="description" id="description" placeholder="Description de ce cellier....">{{ old('description', $cellar->description) }}</textarea>
                @if ($errors->has('description'))
                <div class="alert_msg">
                    {{$errors->first('description')}}
                </div>
                @endif
            </div>
            <button type="submit" class="btn-icon btn-go flex-al just-between">Modifier<i class="fa-solid fa-pen-to-square"></i></button>
        </form>
        @if(Auth::id() == $cellar->user_id)
        <button type="submit" class="btn-icon btn-remove flex-al just-between" id="delete-btn">supprimer<i class="fa-solid fa-trash"></i></button>
        <div class="popup-overlay hide" id="popup-overlay">
            <div class="popup-delete">
                <div class="message">
                    <h2>Etes-vous sûr de vouloir supprimer ?</h2>
                </div>
                <div class="confirm-buttons">
                    <button id="cancel-btn">Annuler <i class="fa-solid fa-ban"></i></button>
                    <form method="POST" action="{{ route('cellar.destroy', $cellar->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-icon btn-remove flex-al just-between">supprimer<i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </section>
</main>


<script src="{{ asset('js/classes/ConfirmationModal.js') }}"></script>
@endsection
