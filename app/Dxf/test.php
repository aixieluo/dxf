<?php

namespace App\Dxf;

use DXFighter\lib\Polyline;

class test
{
    public $l = 98;
    public $w = 160;
    public $d = 69;
    public $c = 30;
    public $h = 16 + 13;

    public function points()
    {
        return [
            [0, $this->h],
            [0, $this->h + $this->d],
            [$this->h, $this->h + $this->d],
            [$this->h, $this->h + $this->d + $this->h],
            [$this->h + $this->w - $this->c, $this->h + $this->d + $this->h],
            [$this->h + $this->w - $this->c, $this->h + $this->d + $this->h - $this->l + $this->d],
            [$this->h + $this->w - $this->c, $this->h + $this->d + $this->h + 1],
            [$this->h + $this->w, $this->h + $this->d + $this->h + 1],
            [$this->h + $this->w, $this->h + $this->d + $this->h],
            [$this->h + $this->w + $this->h, $this->h + $this->d + $this->h],
            [$this->h + $this->w + $this->h, $this->h],
            [$this->h + $this->w, $this->h],
            [$this->h + $this->w, 0],
            [$this->h, 0],
            [$this->h, $this->h],
        ];
    }

    public function p1()
    {
        $p = new Polyline();
        $p->addPoint([$this->h + $this->w + $this->h, $this->h + $this->d + $this->h]);
        $p->addPoint([$this->h + $this->w + $this->h, $this->h + $this->d + $this->h + 1]);
        $p->addPoint([$this->h + $this->w + $this->h + $this->h + 1, $this->h + $this->d + $this->h + 1]);
        $p->addPoint([$this->h + $this->w + $this->h + $this->h + 1, $this->h + $this->d + $this->h]);
        $p->addPoint([$this->h + $this->w + $this->h + $this->h, $this->h + $this->d + $this->h]);
        $p->addPoint([$this->h + $this->w + $this->h + $this->h, $this->h + $this->d + $this->h - $this->c]);
        $p->addPoint([$this->h + $this->w + $this->h, $this->h + $this->d + $this->h - $this->c]);
        return $p;
    }

    public function p2()
    {
        $p = new Polyline();
        $p->addPoint([$this->h + $this->w + $this->h, $this->h + $this->d + $this->h - $this->c]);
        $p->addPoint([$this->h + $this->w + $this->h + $this->h + 2, $this->h + $this->d + $this->h - $this->c]);
        $p->addPoint([$this->h + $this->w + $this->h + $this->h + 2, $this->h + $this->d + $this->h - $this->c - 2]);
        $p->addPoint([$this->h + $this->w + $this->h + $this->h, $this->h + $this->d + $this->h - $this->c - 2]);
        $p->addPoint([$this->h + $this->w + $this->h + $this->h, $this->h + $this->d + $this->h - $this->c - 2 - $this->l + $this->d - 2]);
        $p->addPoint([$this->h + $this->w + $this->h, $this->h + $this->d + $this->h - $this->c - 2 - $this->l + $this->d - 2]);
        return $p;
    }
}
