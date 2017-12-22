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
        for($i=20;$i<30;$i++){
            $block = new Block();
            $block->id = 'h'.$i.'_s';
            $block->name = $i.'年春';
            $block->save();
        }

        for($i=20;$i<30;$i++){
            $block = new Block();
            $block->id = 'h'.$i.'_a';
            $block->name = $i.'年秋';
            $block->save();
        }
    }
}
