<?php

namespace App\Designs;

class D6 extends Design
{
    public function getWidth()
    {
        try {
            $l = collect($this->lengths);
            return $l->get('w') * $l->get('l') * 2 / 100 + 10;
        } catch (\Exception $exception) {
            throw new \Exception('参数不正确');
        }
    }

    protected function getPoints()
    {
        try {
            $w = $this->lengths['w'];
            $l = $this->lengths['l'];
            $h = array_get($this->lengths, 'h');
        } catch (\Exception $exception) {
            throw new \Exception('参数不正确，无法生成');
        }
        if ((2 * $l + 6) <= 144) {
            return $this->p1($w, $h, $l);
        } else {
            if (($w + 4) <= 144) {
                return $this->p2($w, $h, $l);
            } else {
                throw new \Exception('你提供的尺寸暂时无法定做！');
            }
        }
    }

    public function p1($w,$h,$l)
    {
        return [
            [0, 0],
            [1, 0],
            [1, 1],
            [$w + 4, 1],
            [$w + 4, 2 * $l + 5],
            [1, 2 * $l + 5],
            [1, 2 * $l + 6],
            [0, 2 * $l + 6],
            [0, 0]
        ];
    }

    public function p2($w, $h, $l)
    {
        return [
            [1, 0],
            [2 * $l + 5, 0],
            [2 * $l + 5, $w + 3],
            [2 * $l + 6, $w + 3],
            [2 * $l + 6, $w + 4],
            [0, $w + 4],
            [0, $w + 3],
            [1, $w + 3],
            [1, 0]
        ];
    }
}
