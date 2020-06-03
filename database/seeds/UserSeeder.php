<?php

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = Position::where('name', Position::POSITION_ADMIN)->first();
        $u = User::firstOrNew(['nickname' => 'admin'], ['password' => bcrypt('123123'), 'name' => 'Admin']);
        $u->position()->associate($p);
        $u->save();
    }
}
