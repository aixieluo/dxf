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
        $p = new Polyline();
        foreach ($points as $point) {
            $p->addPoint($point)->move([$x, 0]);
        }
        return $p;
    }

    abstract protected function getPoints();

    public function getWidth()
    {
        $points = $this->getPoints();
        $max = 0;
        $min = 0;
        foreach ($points as $point) {
            /** @var array $point */
            $x = $point[0];
            if ($x > $max) {
                $max = $x;
            }
            if ($x < $min) {
                $min = $x;
            }
        }
        return $max - $min;
    }
}
