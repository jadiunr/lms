<?php

use Illuminate\Database\Seeder;
use App\User;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'realname' => '亜土民 遊三',
            'password' => bcrypt('aaaaaa'),
            'email' => 'admin@example.jp',
            'admin' => 1
        ]);

        for($i=1;$i<16;$i++) {
            User::create([
                'name' => 'DummyUser'.$i,
                'realname' => 'RealName'.$i,
                'password' => bcrypt('aaaaaa'),
                'email' => $i.'@example.jp',
                'admin' => 0
            ]);
        }
    }
}
