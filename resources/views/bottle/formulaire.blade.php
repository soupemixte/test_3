@extends('layouts.app')
@section('title', 'Détails')
@section('content')

<!-- <x-header 
    image="{{ asset('img/header/header.jpg') }}" 
    title="Découvrez notre collection" 
    subtitle="C'est ce dont nous sommes fiers" 
/> -->

<main class="flex-center">


            <!-- -------- ajout de form ---------- -->

            <form action="" method="POST" class="form form-control">
            @csrf
            <label for="quantity">
                Quantite
                <input type="number" name="quantity" >
            </label>
            <label for="Cellier_idCellier">
                Id cellier
                <input type="number" name="Cellier_idCellier" value="" >
            </label>
            <label for="Bottle_id">
                Id bottle
                <input  type="number" name="Bottle_id" value="" >
            </label>
            <label for="a_commander">
                A commander
                <input  type="number" name="a_commander" value="0" >
            </label>
            <label for="bu">
                Bu
                <input   type="number" name="bu" value="0" >
            </label>
            <label for="title">
                Nom Bouteille
                <input   type="text" name="title" value="" >
            </label>
            <label for="price">
                Prix Bouteille
                <input type="number" name="price" value="" >
            </label>
            <label for="annee">
                Annee Bouteille
                <input   type="text" name="annee" value="" >
            </label>
            <label for="region">
                Region
                <input   type="text" name="region" value="" >
            </label>
            <label for="country">
                Pays
                <input   type="text" name="country" value="" >
            </label>
            <label for="color">
                Couleur
                <input   type="text" name="color" value="" >
            </label>
            <label for="size">
                Volume
                <input   type="text" name="size" value="" >
            </label>
            <label for="image">
                Photo
                <input   type="file" name="image" value="" >
            </label>
                <input type="submit" value="Ajouter au cellier">
            </form>

</main>
@endsection