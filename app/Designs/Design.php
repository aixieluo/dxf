<?php

namespace App\Designs;

use DXFighter\lib\Polyline;

abstract class Design
{
    /**
     * @var array
     */
    protected $lengths;

    /**
     * Design constructor.
     *
     * @param array $lengths
     */
    public function __construct(array $lengths)
    {
        $this->lengths = $lengths;
    }

    /**
     * @param $x
     *
     * @return Polyline
     */
    public function make($x)
    {
        $points = $this->getPoints();
        $points = $this->move($points, $x);
        $p = new Polyline();
        foreach ($points as $point) {
            // 输进来的单位是cm，实际图是单位是mm，所以要乘10倍
            $point = array_map(function ($item) {
                return $item * 10;
            }, $point);
            $p->addPoint($point);
        }
        return $p;
    }

    // 具体用料长度
    public function offset()
    {
        $points = collect($this->getPoints());
        return $points->max(function ($p) {
            return head($p);
        }) - $points->min(function ($p) {
            return head($p);
        });
    }

    abstract protected function getPoints();

    public function move($points, $x)
    {
        return collect($points)->map(function ($p) use ($x) {
            $p[0] += $x;
            return $p;
        })->toArray();
    }

    // 具体模型用料多少，而不是用料宽度，这块命名有歧义是因为后期需求更改不方面改方法名字
    abstract public function getWidth();
}
