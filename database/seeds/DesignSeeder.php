<?php

use App\Designs\D1;
use App\Designs\D2;
use App\Designs\D3;
use App\Designs\D4;
use App\Designs\D5;
use App\Designs\D6;
use App\Models\Design;
use Illuminate\Database\Seeder;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = collect([
            [
                'name'              => '右沙发套',
                'img'               => '/template/正L.jpg',
                'types'             => ['l', 'w', 'd', 'c', 'h'],
                'model'             => D1::class,
                'accessories'       => '绳子*6米',
                'accessories_count' => 1
            ],
            [
                'name'              => '左沙发套',
                'img'               => '/template/反L.jpg',
                'types'             => ['l', 'w', 'd', 'c', 'h'],
                'model'             => D2::class,
                'accessories'       => '绳子*6米',
                'accessories_count' => 1
            ],
            [
                'name'              => '头枕斤/一片式/扶手巾',
                'img'               => '/template/头枕巾 一片式 扶手巾.jpg',
                'types'             => ['w', 'h', 'l'],
                'model'             => D3::class,
                'accessories'       => '绳子*4米',
                'accessories_count' => 1
            ],
            [
                'name'              => '方形沙发套/靠背',
                'img'               => '/template/坐垫 靠背.jpg',
                'types'             => ['w', 'h', 'l'],
                'model'             => D4::class,
                'accessories'       => '绳子*6米',
                'accessories_count' => 1
            ],
            [
                'name'              => '靠垫',
                'img'               => '/template/靠垫.jpg',
                'types'             => ['w', 'l', 'a', 'b'],
                'model'             => D5::class,
                'accessories'       => '绳子*6米',
                'accessories_count' => 1
            ],
            [
                'name'              => '抱枕',
                'img'               => '/template/抱枕.jpg',
                'types'             => ['w', 'l', 'h'],
                'model'             => D6::class,
                'accessories'       => '绳子*4米',
                'accessories_count' => 1
            ],
        ]);
        DB::table('designs')->truncate();
        $c->map(function ($arr) {
            Design::create($arr);
        });
    }
}
