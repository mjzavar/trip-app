<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB ;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trip_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained();
            $table->foreignId('task_id')->unique()->constrained();
            $table->timestamps();
        });

        DB::unprepared(
      'CREATE TRIGGER trip_tasks_insert
            AFTER INSERT ON `trip_tasks` FOR EACH ROW
            BEGIN
                    UPDATE trips SET task_count = task_count + 1 WHERE id = NEW.trip_id;
            END'
        );
        DB::unprepared(
      'CREATE TRIGGER trip_tasks_delete
            AFTER DELETE ON `trip_tasks` FOR EACH ROW
            BEGIN
                    UPDATE trips SET task_count = task_count - 1 WHERE id = OLD.trip_id;
            END'
        );

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_tasks');
    }
};
