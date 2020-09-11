<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;

Route::get('/', function () {
    return view('index');
});

Route::get('order/{id}/print', function ($id) {
    $order = Order::with([
        'orderDesigns' => function (HasMany $builder) {
            $builder->orderBy('design_id');
        }
    ])->find($id);
    return view('print', compact('order'));
});
