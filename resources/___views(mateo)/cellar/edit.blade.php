@extends('layouts.app')
@section('title', 'Create Cellar')
@section('content')
<main class="edit">
    <section>  
        <h2 class="section-title">@lang('lang.create_cellar')</h2>
        <div class="form">
            <form method="POST">
                @csrf
                @method('put')
                <div class="mb-3 col">
                    <div class="row">
                        <label for="title">Nom du Cellier</label>
                        <input type="text" name="title" value="{{ old('title', $cellar->title) }}" placeholder="Entrez le nom...">
                    </div>
                    @if ($errors->has('title'))
                        <div class="">
                            {{$errors->first('title')}}
                        </div>
                    @endif
                </div>
                <div class="mb-3 col">
                    <div class="row">
                        <label for="description">Nom du Cellier</label>
                        <textarea name="description" placeholder="Description de ce cellier....">{{ old('description', $cellar->description) }}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <div class="">
                            {{$errors->first('description')}}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn-border">Update</button>
            </form>
        </div> 
    </section>
</main>

@endsection