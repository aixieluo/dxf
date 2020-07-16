<?php

namespace App\Repositories;

use App\Models\SofaCover;
use App\Models\SofaCoverItem;
use Arr;

class SofaRepository extends Repository
{
    public function sofas()
    {
        return SofaCover::all();
    }

    /**
     * @param $id
     *
     * @return SofaCover
     */
    public function id($id)
    {
        return SofaCover::findOrFail($id);
    }

    public function createSofa(array $all)
    {
        $sofa = new SofaCover();
        $sofa->fill($all)->save();
        $sofa->designs()->sync(Arr::get($all, 'templates'));
        return true;
    }

    public function updateSofa(SofaCover $sofa, array $all)
    {
        $sofa->designs()->sync(Arr::get($all, 'templates'));
        return $sofa->fill($all)->save();
    }

    public function items(SofaCover $sofa)
    {
        return $sofa->items;
    }

    /**
     * @param SofaCover $sofa
     * @param           $id
     *
     * @return SofaCoverItem
     */
    public function item(SofaCover $sofa, $id)
    {
        return $sofa->items()->findOrFail($id);
    }

    public function createSofaItem(SofaCover $sofa, array $all)
    {
        $item = new SofaCoverItem();
        $item->sofa()->associate($sofa);
        $item->fill($all)->save();
        return true;
    }

    public function updateSofaItem(SofaCoverItem $item, array $all)
    {
        return $item->fill($all)->save();
    }
}
