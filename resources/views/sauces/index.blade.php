@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Bouton Ajouter une Sauce -->
    <a href="{{ route('sauces.create') }}" class="btn btn-primary mb-3">Ajouter une sauce</a><br>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @foreach ($sauces as $sauce)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/sauces/' . $sauce->name . '.png') }}" 
                                        alt="Image de la sauce" 
                                        style="width: 100px; height: 100px;">
                                </div>

                                <div class="text-center">
                                    <p class="font-weight-bold mb-1">{{ $sauce->name }}</p>
                                    <p>Heat : {{ $sauce->heat }}/10</p>
                                    
                                    <a href="{{ route('like', $sauce->id) }}"><i class="fa-regular fa-thumbs-up"></i></a>
                                    <a href="{{ route('dislike', $sauce->id) }}"><i class="fa-regular fa-thumbs-down"></i></a>
                                    <p>{{ $sauce->likes }} likes & {{ $sauce->dislikes }} dislikes </p>
                                </div>

                                <div class="button-group text-center">
                                    <form action="{{ route('sauces.destroy', $sauce->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette sauce ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                    <a href="{{ route('sauces.edit', $sauce->id) }}" class="btn btn-warning btn-sm">
                                        Modifier
                                    </a>
                                    <a href="{{ route('sauces.show', $sauce->id) }}" class="btn btn-info btn-sm">
                                        Voir le détail
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="pagination-container mt-3">
                        {!! $sauces->links('pagination::bootstrap-4') !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection