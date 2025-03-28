@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="mb-4">Ajouter une nouvelle sauce</h1>
        <form action="{{ route('sauces.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="manufacturer" class="form-label">Manufactureur</label>
                <input type="text" name="manufacturer" id="manufacturer" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="mainPepper" class="form-label">Piment principal</label>
                <input type="text" name="mainPepper" id="mainPepper" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="imageUrl" class="form-label">Image</label>
                <input type="file" name="imageUrl" id="imageUrl" class="form-control" accept="image/*"
                    onchange="previewImage(event)">
            </div>

            <div class="mb-3">
                <label for="heat" class="form-label">Niveau de piquant (1-10)</label>
                <input type="number" name="heat" id="heat" class="form-control" min="1" max="10" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Creer la sauce</button>
        </form>
    </div>

@endsection
