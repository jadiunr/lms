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

            $block = new Block();
            $block->id = 'h25_s';
            $block->name = '25年春';
            $block->save();


            $block = new Block();
            $block->id = 'h25_a';
            $block->name = '25年秋';
            $block->save();

    }
}
