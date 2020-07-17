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
                'name' => '正L型沙发笠',
                'img'  => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
                'types' => ['l', 'w', 'd', 'c', 'h'],
                'model' => D1::class
            ],
            [
                'name'  => '反L型沙发笠',
                'img'   => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
                'types' => ['l', 'w', 'd', 'c', 'h'],
                'model' => D2::class,
            ],
            [
                'name'  => '头枕斤/一片式/扶手巾',
                'img'   => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
                'types' => ['w', 'h', 'l'],
                'model' => D3::class,
            ],
            [
                'name'  => '坐垫/靠背',
                'img'   => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
                'types' => ['w', 'h', 'l'],
                'model' => D4::class,
            ],
            [
                'name'  => '靠垫',
                'img'   => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
                'types' => ['w', 'l', 'a', 'b'],
                'model' => D5::class,
            ],
            [
                'name'  => '抱枕',
                'img'   => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
                'types' => ['w', 'l', 'h'],
                'model' => D6::class,
            ],
        ]);
        DB::table('designs')->truncate();
        $c->map(function ($arr) {
            Design::create($arr);
        });
    }
}
