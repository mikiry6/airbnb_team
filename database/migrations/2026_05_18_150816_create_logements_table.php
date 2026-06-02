<?php

use App\Models\Hotel;
use App\Models\ImageLogement;
use App\Models\Localisation;
use App\Models\Pays;
use App\Models\User;
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
        Schema::create('logements', function (Blueprint $table) {

            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Hotel::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Pays::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Localisation::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(ImageLogement::class)->nullable()->constrained()->nullOnDelete();
            $table->enum('type_logement' ,['cabane', 'chambre', 'appartement', 'bungalow', 'villa', 'autre']);
            $table->string('titre');
            $table->text('description');
            $table->integer('prix');
            $table->integer('nb_chambre');
            $table->integer('nb_douche');
            $table->integer('nb_wc');
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->boolean('is_free')->default(true);
            $table->boolean('is_prenium')->default(false);
            $table->boolean('is_boosted')->default(false);
            $table->boolean('is_ban')->default(false);
            $table->dateTime('boostEnd')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logements');
    }
};
