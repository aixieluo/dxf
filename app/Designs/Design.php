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
            $p->addPoint($point);
        }
        return $p;
    }

    abstract protected function getPoints();

    public function move($points, $x)
    {
        return collect($points)->map(function ($p) use ($x) {
            $p[0] += $x;
            return $p;
        })->toArray();
    }

    abstract public function getWidth();
}
