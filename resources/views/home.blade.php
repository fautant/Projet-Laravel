@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Bouton Ajouter une Sauce -->
    <a href="{{ route('create') }}" class="btn btn-primary mb-3">ADD SAUCE</a><br>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <!-- Affichage du message de statut -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Liste des sauces -->
                    <ul class="list-group">
                        @foreach ($sauces as $sauce)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <!-- Image de la sauce en haut -->
                                <div class="text-center mb-3">
                                    <img src="{{ asset('images/' . $sauce->name . '.png') }}" 
                                         alt="Image de la sauce" 
                                         style="width: 100px; height: 100px;">
                                </div>

                                <!-- Informations de la sauce -->
                                <div class="text-center">
                                    <p class="font-weight-bold mb-1">{{ $sauce->name }}</p>
                                    <p>Heat : {{ $sauce->heat }}/10</p>
                                    @if ($sauce->userHasLiked)
                                        <!-- image like done -->
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        <!-- image dislike -->
                                        <a href="{{ route('dislike', $sauce->id) }}"><i class="fa-regular fa-thumbs-down"></i></a>
                                        <p>{{ $sauce->likes }} likes & {{ $sauce->dislikes }} dislikes </p>
                                    @elseif ($sauce->userHasDisliked)
                                    <!-- image like -->
                                    <a href="{{ route('like', $sauce->id) }}"><i class="fa-regular fa-thumbs-up"></i></a>
                                          
                                    <!-- image dislike done -->
                                        <i class="fa-solid fa-thumbs-down"></i>
                                        <p>{{ $sauce->likes }} likes & {{ $sauce->dislikes }} dislikes </p>  
                                        
                                    @else
                                        <a href="{{ route('like', $sauce->id) }}"><i class="fa-regular fa-thumbs-up"></i></a>
                                        <a href="{{ route('dislike', $sauce->id) }}"><i class="fa-regular fa-thumbs-down"></i></a>
                                        <p>{{ $sauce->likes }} likes & {{ $sauce->dislikes }} dislikes </p>
                                    @endif
                                </div>

                                <!-- Boutons actions sous les informations -->
                                <div class="button-group text-center">
                                    <a href="{{ route('destroy', $sauce->id) }}" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sauce ?')">
                                        Supprimer
                                    </a>
                                    <a href="{{ route('edit', $sauce->id) }}" 
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ route('show', $sauce->id) }}" 
                                       class="btn btn-info btn-sm">
                                        Show
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Pagination -->
                    <div class="pagination-container mt-3">
                        {!! $sauces->links('pagination::bootstrap-4') !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
