@extends('layouts.app')
@section('title', 'Edit cellar')
@section('content')
<main class="flex-center">
    <section class="structure flex-col-center height80">
    <div class="section-title">
        <h2>Formulaire modification du cellier : {{ $cellar->title }}.</h2>
    </div>   
        <form class="form" method="POST">
            @csrf
            @method('put')
            <div class="form-control">
                <label for="title">@lang('lang.cellar_name')</label>
                <input type="text" name="title" value="{{ old('title', $cellar->title) }}" placeholder="Entrez le nom...">
                @if ($errors->has('title'))
                <div class="alert_msg">
                    {{$errors->first('title')}}
                </div>
                @endif
            </div>
            <div class="form-control">
                <label for="description">@lang('lang.cellar_desc')</label>
                <textarea name="description" placeholder="Description de ce cellier....">{{ old('description', $cellar->description) }}</textarea>
                @if ($errors->has('description'))
                <div class="alert_msg">
                    {{$errors->first('description')}}
                </div>
                @endif
            </div>
            <button type="submit" class="btn-border btn-icon btn-go flex-al just-between gap5">@lang('lang.cellar_create')<i class="fa-solid fa-pen-to-square"></i></button>
        </form>
        @if(Auth::id() == $cellar->user_id)
        <button type="submit" class="btn-border btn-icon btn-remove flex-al just-between gap5" id="delete-btn">supprimer<i class="fa-solid fa-trash"></i></button>
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
                        <button type="submit" class="btn-border btn-icon btn-remove flex-al just-between gap5">supprimer<i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </section>
</main>


<script src="{{ asset('js/classes/ConfirmationModal.js') }}"></script>
@endsection
