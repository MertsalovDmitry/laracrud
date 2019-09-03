<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = microtime(true);

        DB::table('positions')->delete();

        $positions = factory(App\Position::class, 100)->create();

        $time = microtime(true) - $start;
        printf("Скрипт выполнялся %.4F сек. \n", $time);
    }
}
