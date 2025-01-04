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

            <form action="" method="POST" class="form form-control" enctype="multipart/form-data">
            @csrf
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
            <label for="quantity">
                Quantite
                <input type="number" name="quantity" >
            </label>
            <label for="image">
                Photo
                <input type="file" name="image"  />
            </label>
            
            <label for="Cellier_idCellier">
                <!-- Id cellier -->
                <input hidden type="number" name="Cellier_idCellier" value="1" >
            </label>
            <label for="Bottle_id">
                <!-- Id bottle -->
                <input   type="text" name="Bottle_id" value="{{ session('qte_bouteille')+1 }}" >
            </label>
            <label for="a_commander">
                <!-- A commander -->
                <input hidden type="number" name="a_commander" value="0" >
            </label>
            <label for="bu">
                <!-- Bu -->
                <input hidden  type="number" name="bu" value="0" >
            </label>
           
          
                <input type="submit" value="Ajouter au cellier">
            </form>

</main>
@endsection