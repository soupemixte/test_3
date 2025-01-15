@extends('layouts.app')
@section('title', 'Ajouter la bouteille')
@section('content')
<main class="add">
    <section>  
        <h2 class="section-title">@lang('lang.add_cellar')</h2>
        <div class="form">

        </div> 
    <form action="{{ route('cellar.storeBottle') }}" method="POST">
        @csrf
        <div class="mb-3 col">
            <div class="row">
                <label for="bottle_name">@lang('lang.bottle_name')</label>
                <input type="text" name="bottle_name" value="{{ $bottle->title }}" readonly>
            </div>
            @if ($errors->has('bottle_name'))
                <div class="alert_msg">
                    {{ $errors->first('bottle_name') }}
                </div>
            @endif
        </div>

        <div class="mb-3 col">
            <div class="row">
                <label for="cellar_id">@lang('lang.cellar_choose')</label>
                <select name="cellar_id" id="cellar_id" required>
                    <option value="">@lang('lang.choose_name')</option>
                    
                    @if (Auth::user()->cellars && Auth::user()->cellars->count())
                        @foreach (Auth::user()->cellars as $cellar)
                            <option value="{{ $cellar->id }}">{{ $cellar->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>@lang('lang.no_cellar')</option>
                    @endif
                </select>
            </div>
            @if ($errors->has('cellar_id'))
                <div class="alert_msg">
                    {{ $errors->first('cellar_id') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn-border">@lang('lang.add_bottle')</button>
    </form>

    </section>
</main>

@endsection