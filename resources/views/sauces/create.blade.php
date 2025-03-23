@extends('layouts.app')

@section('content') 
<form action="{{ route('store') }}" method="POST" class="container my-4" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 offset-md-3"> <!-- Centrer le formulaire -->
            <div class="form-group mb-3">
                <strong>Name</strong>
                <input type="text" name="name" class="form-control" placeholder="Saisir un nom">
            </div>
        
            <div class="form-group mb-3">
                <strong>Manufacturer</strong>
                <input type="text" name="manufacturer" class="form-control" placeholder="Saisir un manufacturer">
            </div>
        
            <div class="form-group mb-3">
                <strong>Description</strong>
                <input type="text" name="description" class="form-control" placeholder="Saisir un description">
            </div>
        
            <div class="form-group mb-3">
                <input type="file" id="imageUrl" name="imageUrl" accept="image/png, image/jpeg" />
            </div>
        
            <div class="form-group mb-3">
                <strong>Main Pepper Ingredient</strong>
                <input type="text" name="mainPepper" class="form-control" placeholder="Saisir un ou plusieurs ingrédients">
            </div>
        
            <div class="form-group mb-3">
                <strong>Heat</strong>
                <input type="number" name="heat" class="form-control" placeholder="Saisir un nombre" max=10 min=0>
            </div>
        
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </div>
</form>
@endsection