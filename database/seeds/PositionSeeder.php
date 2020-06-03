<?php

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            collect(Position::$positionMaps)->map(function ($unset, $name) {
                $p = Position::where(compact('name'))->first();
                if (! $p) {
                    app(Position::class)->fill(compact('name'))->save();
                }
            });
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
    }
}
