<?php

use App\Models\Master;
use App\Models\Skill;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_skill', function (Blueprint $table) {
            $table->foreignIdFor(Master::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Skill::class)->constrained()->onDelete('cascade');
            $table->primary(['master_id', 'skill_id']);

            $table->index('master_id');
            $table->index('skill_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_skill');
    }
};
