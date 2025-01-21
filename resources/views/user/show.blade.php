@extends('layouts.app')
@section('title', 'User Profile')
@section('content')

<main class="flex-center height80">
    <section class="structure">
        <h2>{{ $user->name }}</h2>
        <div class="info">
            <p>{{ $user->email }}</p>
        </div>
        <section class="grid mt-20 mb-10">
            @foreach ($cellars as $cellar)
            <article class="card_cellar">
                <h4>{{ $cellar->title }}</h4>
            </article>
            @endforeach
        </section>
    </section>
</main>

@endsection