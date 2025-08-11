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
        Schema::create('admins_roles', function (Blueprint $table) {
            $table->id();
            $table->integer('subadmin_id'); //subadmin_id
            $table->string('module'); //module name
            $table->tinyInteger('view_access'); //view only access
            $table->tinyInteger('edit_access'); //view & edit access
            $table->tinyInteger('full_access'); //full access[view,edit,delete]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins_roles');
    }
};
