@extends('layouts.app')
@section('title', 'Create Cellar')
@section('content')

@if(!$errors->isEmpty())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>                

@endif  

<main class="cellar">
    <section class="structure flex-col-center height80">   
        <form class="form" action="{{ route('cellar.store') }}" method="POST">
            @csrf
            <div class="form-control">
                <label for="title">Nom du Cellier</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Entrez le nom...">
                @if ($errors->has('title'))
                    <div class="">
                        {{$errors->first('title')}}
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="description">Description du Cellier</label>
                <textarea name="description" placeholder="Description de ce cellier....">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <div class="">
                        {{$errors->first('description')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border">Créer le Cellier</button>
        </form>
    </section>
</main>

@endsection