<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sauces', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId'); // Identifiant unique de l'utilisateur
            $table->string('name'); // Nom de la sauce
            $table->string('manufacturer'); // Fabricant de la sauce
            $table->string('description'); // Description de la sauce
            $table->string('mainPepper'); // Ingrédient épicé principal
            $table->string('imageUrl'); // URL de l'image de la sauce
            $table->integer('heat'); // Niveau de piquant (1-10)
            $table->integer('likes')->default(0); // Nombre de likes
            $table->integer('dislikes')->default(0); // Nombre de dislikes
            $table->json('usersLiked')->nullable(); // Tableau des userId qui ont liké
            $table->json('usersDisliked')->nullable(); // Tableau des userId qui ont disliké
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sauces');
    }
};
