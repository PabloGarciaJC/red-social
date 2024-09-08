<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarColumnaFollowers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->dropColumn('notification_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->string('notification_id');
        });
    }
}

// Borra sin Perder los Registros
// php artisan make:migration eliminar_columna_ejemplo_tabla
// php artisan migrate

// Devuelvo la Migracion
// php artisan migrate:rollback
