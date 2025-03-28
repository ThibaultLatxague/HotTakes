@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nom:</strong> {{ $sauce->name }}<br>
            <strong>Manufacturer:</strong> {{ $sauce->manufacturer }}<br>
            <strong>Description:</strong> {{ $sauce->description }}<br>
            <strong>Image:</strong> <img src="{{ asset('storage/sauces/' . $sauce->name . '.png') }}" alt="Image de la sauce" style="width: 100px; height: 100px;"><br>
            <strong>Heat:</strong> {{ $sauce->heat }}<br>
            <strong>Likes:</strong> {{ $sauce->likes }}<br>
            <strong>Dislikes:</strong> {{ $sauce->dislikes }}<br>
            <strong>Users liked:</strong> {{ $sauce->usersLiked }}<br>
            <strong>Users disliked:</strong> {{ $sauce->usersDisliked }}<br>
        </div>
    </div>
</div>
@endsection