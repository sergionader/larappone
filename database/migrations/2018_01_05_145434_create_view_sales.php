<?php

use Illuminate\Database\Migrations\Migration;

class CreateViewSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW `vw_sales` AS 
            SELECT `visits`.`dt` AS `dt`,
            COUNT(`visits`.`id`) AS `number_of_sales`,
            SUM(`product_visit`.`amount`) AS `y` 
            FROM (`visits` join `product_visit`) 
            where ((`visits`.`id` = `product_visit`.`visit_id`) 
            AND (`product_visit`.`amount` > 0)) GROUP BY `visits`.`dt` order by `visits`.`dt` 
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW vw_sales');
    }
}
