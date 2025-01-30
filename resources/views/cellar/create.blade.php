@extends('layouts.app')
@section('title', 'Create Cellar')
@section('content')
<main class="flex-center height60">
    <section class="structure flex-col-center gap10">
    <div class="section-title">
        <h1>Créer un cellier</h1>
    </div>   
    <!-- <div class="line"></div>  -->
        <form class="form" action="{{ route('cellar.store') }}" method="POST">
            @csrf
            <div class="form-control">
                <label for="title">@lang('lang.cellar_name')</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Entrez le nom...">
                @if ($errors->has('title'))
                    <div class="alert_msg">
                        {{$errors->first('title')}}
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="description">@lang('lang.cellar_desc')</label>
                <textarea name="description" id="description" placeholder="Description de ce cellier....">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <div class="alert_msg">
                        {{$errors->first('description')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-icon btn-go flex-al just-between">@lang('lang.save')<i class="fa-solid fa-floppy-disk"></i></button>
        </form>
    </section>
</main>

@endsection