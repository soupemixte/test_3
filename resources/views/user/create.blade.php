@extends('layouts.app')
@section('title', 'Registration')
@section('content')
    @if(!$errors->isEmpty())
    <div class="" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>                
    @endif
    

    <main class="flex-center">
        <section class="structure flex-col-center height90 gap20">
            <form action="{{ route('user.store') }}" method="POST" class="form">
                @csrf
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                        <div class="form_input_error">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="form-control">
                    <label for="email">Username</label>
                    <input type="text" id="username" name="email"  value="{{old('email')}}">
                    @if ($errors->has('email'))
                        <div class="form_input_error">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    @if ($errors->has('password'))
                        <div class="form_input_error">
                            {{$errors->first('password')}}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn-border">Save</button>
            </form>

            <div class="form_footer">
                <p>Pas encore membre ? <a href="{{ route('user.create') }}">Créer un compte</a></p>
            </div>
        </section>
    </main>
@endsection