@extends('layouts.app')
@section('title', 'User Profile')
@section('content')

<!--
    TODO: UX/UI
    TODO: if cellars->isEmpty()
-->

<main class="flex-center heigth80">
    <section class="structure">
        <h1 class="page-title">Here we will implement the user Profile</h1>
        
        <div class="results">
            <h2>@lang('lang.user_name') : {{ $user->name }}</h2>
            <p>@lang('lang.email') : {{ $user->email }}</p>
            <p>@lang('lang.created') : {{ $user->created_at }}</p>
            <div class="buttons">
            <a href="{{ route('user.edit', $user->id) }}" class="">@lang('lang.edit')</a>
            <form action="{{ route('user.destroy', $user->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="">@lang('lang.delete')</button>
        </form>
            </div>
        </div>
        <section class="gid mt-20 mb-10">
        
        @foreach ($cellars as $cellar)
            <article class="card_cellar">
                <div class="card-title">
                    <h2>{{ $cellar->title}}</h2>
                </div>
            </article>
        </section>
        @endforeach
    </section>
</main>

@endsection