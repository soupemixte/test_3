@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
    <main class="cellars">
        <h1>Cellar</h1>
        <article class="card_cellar">
            <div class="card-body">
                <div class="card-title">
                    <h3>{{ $cellar->title }}</h3>
                </div>
                <div class="description">
                    <p>{{ $cellar->description }}</p>
                </div>
                <div>
                    <a href="{{ route('cellar.edit', $cellar->id) }}" class="hidden">@lang('lang.edit')</a>
                    <a href="{{ route('cellar.delete', $cellar->id) }}" class="hidden">@lang('lang.delete')</a>
                </div>
            </div>
        </article>
    </main>
@endsection
