<?php

use Illuminate\Database\Migrations\Migration;

class CreateViewProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW `vw_profiles` AS 
            SELECT `profiles`.`name` AS `Profile`,
            `types`.`name` AS `type`,
            `subtypes`.`name` AS `Subtype` 
            FROM ((`profiles` join `types`) 
            JOIN `subtypes`) 
            WHERE ((`types`.`id` = `profiles`.`type_id`) 
            AND (`subtypes`.`id` = `profiles`.`subtype_id`))
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW vw_profiles');
    }
}
