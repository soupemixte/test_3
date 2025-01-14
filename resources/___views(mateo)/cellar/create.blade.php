@extends('layouts.app')
@section('title', 'Create Cellar')
@section('content')

<!-- @if(!$errors->isEmpty())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>                

@endif   -->

<main class="cellar">
    <section>
        <h2 class="section-title">@lang('lang.register_cellar')</h2>
        <div class="form">
            <form action="{{ route('cellar.store') }}" method="POST">
                @csrf
                <div class="mb-3 col">
                    <div class="row">
                        <label for="title">@lang('lang.cellar_name')</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Entrez le nom...">
                    </div>
                    @if ($errors->has('title'))
                        <div class="alert_msg">
                            <p>
                                {{$errors->first('title')}}
                            </p>
                        </div>
                    @endif
                </div>
                <div class="mb-3 col">
                    <div class="row">
                        <label for="description">@lang('lang.cellar_desc')</label>
                        <textarea name="description" placeholder="Description de ce cellier....">{{ old('description') }}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <div class="alert_msg">
                            <p>
                                {{$errors->first('description')}}
                            </p>
                        </div>
                    @endif
                </div>
                <button type="submit" class="cellar_btn">@lang('lang.cellar_create')</button>
            </form>
        </div>   
    </section>
</main>

@endsection