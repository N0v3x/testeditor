<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('Subject')->insert([
            'name' => 'Програмування інтернет'
            ]);
        DB::table('Subject')->insert([
            'name' => 'Бази даних'
        ]);
        DB::table('Subject')->insert([
            'name' => 'Якість програмного забезпечення'
        ]);
        DB::table('Subject')->insert([
            'name' => 'Теорія обчислювальних систем і структур'
        ]);
        DB::table('Subject')->insert([
            'name' => 'Аналіз та алгоритми даних'
        ]);

    }
}
