<?php

use App\Models\SofaCover;
use App\Models\SofaCoverItem;
use Illuminate\Database\Seeder;

class SofaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = SofaCover::firstOrCreate([
            'name' => '浴帽式沙发套'
        ]);
        $s->designs()->sync([1]);
        $s2 = SofaCover::firstOrCreate([
            'name' => '沙发内芯'
        ]);
        $s2->designs()->sync([2]);
        DB::table('sofa_cover_items')->truncate();
        $i1 = new SofaCoverItem();
        $i1->sofa()->associate($s);
        $i1->fill([
            'name' => '亚麻布',
            'uid' => '10987',
            'color' => '黑色',
            'fid' => '01',
            'price' => '89',
            'preview' => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
        ])->save();
    }
}
