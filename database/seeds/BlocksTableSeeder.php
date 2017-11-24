<?php

use Illuminate\Database\Seeder;
use App\Block;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            $block = new Block();
            $block->id = 'block'. $i;
            $block->name = 'blockname'. $i;
            $block->save();
        }
    }
}
