@extends('layouts.app')
@section('title', 'Create Cellar')
@section('content')
<main class="edit">
    <section class="structure flex-col-center height70">   
        <form class="form" method="POST">
            @csrf
            @method('put')
            <div class="form-control">
                <label for="title">Nom du Cellier</label>
                <input type="text" name="title" value="{{ old('title', $cellar->title) }}" placeholder="Entrez le nom...">
                @if ($errors->has('title'))
                    <div class="alert_msg">
                        {{$errors->first('title')}}
                    </div>
                @endif
            </div>
            <div class="form-control">
                <label for="description">Nom du Cellier</label>
                <textarea name="description" placeholder="Description de ce cellier....">{{ old('description', $cellar->description) }}</textarea>
                @if ($errors->has('description'))
                    <div class="alert_msg">
                        {{$errors->first('description')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border">Update</button>
        </form>
    </section>
</main>

@endsection