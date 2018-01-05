<?php

use Illuminate\Database\Migrations\Migration;

class CreateViewVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW `vw_visits` AS 
            SELECT `visits`.`dt` AS `dt`,
            COUNT(`visits`.`id`) AS `number_of_visits`,
            SUM(`product_visit`.`amount`) AS `y` 
            FROM (`visits` join `product_visit`) 
            WHERE ((`visits`.`id` = `product_visit`.`visit_id`) and (`product_visit`.`amount` = 0)) group by `visits`.`dt` order by `visits`.`dt` 
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW vw_visits');
    }
}
