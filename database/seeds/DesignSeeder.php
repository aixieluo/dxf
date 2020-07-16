<?php

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
                'name' => '测试案例1',
                'img'  => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
                'types' => ['A', 'B', 'C', 'D']
            ],
            [
                'name'  => '测试案例2',
                'img'   => '/design/80F031F593B4C67AAACC5DF41514913E.jpg',
                'types' => ['E', 'B', 'C', 'D']
            ],
        ]);
        DB::table('designs')->truncate();
        $c->map(function ($arr) {
            Design::create($arr);
        });
    }
}
