<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWastesTable extends Migration
{
    public function up()
    {
        Schema::create('wastes', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Tanggal penginputan
            $table->string('category'); // Kategori sampah
            $table->string('type'); // Jenis sampah
            $table->float('kg'); // Jumlah dalam kg
            $table->decimal('debet', 15, 2); // Debet
            $table->decimal('kredit', 15, 2); // Kredit
            $table->decimal('saldo', 15, 2); // Saldo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wastes');
    }
}
