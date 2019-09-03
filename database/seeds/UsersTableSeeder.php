<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = microtime(true);

        DB::table('users')->delete();

        $positions = factory(App\User::class, 15)->create();

        $time = microtime(true) - $start;
        printf("Скрипт выполнялся %.4F сек. \n", $time);
    }
}
