<?php namespace NiaInteractive\NiaCalendar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNiainteractiveNiacalendarCategories extends Migration
{
    public function up()
    {
        Schema::table('niainteractive_niacalendar_categories', function($table)
        {
            $table->string('color', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('niainteractive_niacalendar_categories', function($table)
        {
            $table->dropColumn('color');
        });
    }
}
