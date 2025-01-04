@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
    <main class="cellar">
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
                    <a href="#" class="">Edit</a>
                    <a href="#" class="">Delete</a>
                </div>
            </div>
        </article>
    </main>
@endsection