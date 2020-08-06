<?php

namespace App\Designs;

class D5 extends Design
{
    protected function getPoints()
    {
        try {
            $w = $this->lengths['w'];
            $l = $this->lengths['l'];
            $a = $this->lengths['a'];
            $b = $this->lengths['b'];
        } catch (\Exception $exception) {
            throw new \Exception('参数不正确，无法生成');
        }
        if ((($l + 2 * $b + 28) > ($w + $a + $b + 28)) && (144 >= ($l + 2 * $b + 28))) {
            return $this->p1($w, $l, $a, $b);
        } elseif ((($w + $a + $b + 28) > ($l + 2 * $b + 28)) && (144 >= ($w + $a + $b + 28))) {
            return $this->p2($w, $l, $a, $b);
        } elseif ((($l + 2 * $b + 28) > 144) && (144 >= ($w + $a + $b + 28))) {
            return $this->p2($w, $l, $a, $b);
        } elseif ((($w + $a + $b + 28) > 144) && (($l + 2 * $b + 28))) {
            return $this->p1($w, $l, $a, $b);
        } elseif ((($w + $a + $b + 28) > ($l + 2 * $b + 28)) && ($l + 2 * $b + 28) > 144) {
            if (($w + $a + 17) <= 144) {
                if (($l + 2) <= 144) {
                    return $this->p3($w, $l, $a, $b);
                } else {
                    return $this->p4($w, $l, $a, $b);
                }
            } else {
                throw new \Exception('该尺寸请咨询产品主管！');
            }
        } elseif ((($l + 2 * $b + 28) > ($w + $a + $b + 28)) && (($w + $a + $b + 28) > 144)) {
            if (($w + $a + 17) <= 144) {
                if (($l + 2) <= 144) {
                    return $this->p3($w, $l, $a, $b);
                } else {
                    return $this->p4($w, $l, $a, $b);
                }
            } else {
                throw new \Exception('该尺寸请咨询产品主管！');
            }
        }
        throw new \Exception('你提供的尺寸暂时无法定做！');
    }

    protected function p1($w, $l, $a, $b)
    {
        return [
            [$b + 13, 0],
            [$b + $w + 15, $b - $a],
            [$b + $w + 15, $b + 13],
            [$b + $a + $w + 28, $b + 13],
            [$b + $a + $w + 28, $b + $l + 15],
            [$b + $w + 15, $b + $l + 15],
            [$b + $w + 15, $b + $a + $l + 28],
            [$b + 13, $b + $b + $l + 28],
            [$b + 13, $b + $l + 15],
            [0, $b + $l + 15],
            [0, $b + 13],
            [$b + 13, $b + 13],
            [$b + 13, 0]
        ];
    }

    protected function p2($w, $l, $a, $b)
    {
        return [
            [$b + 13, 0],
            [$b + $l + 15, 0],
            [$b + $l + 15, $a + 13],
            [$b + $a + $l + 28, $a + 13],
            [2 * $b + $l + 28, $a + $w + 15],
            [$b + $l + 15, $a + $w + 15],
            [$b + $l + 15, $a + $b + $w + 28],
            [$b + 13, $a + $b + $w + 28],
            [$b + 13, $a + $w + 15],
            [0, $a + $w + 15],
            [$b - $a, $a + 13],
            [$b + 13, $a + 13],
            [$b + 13, 0]
        ];
    }

    protected function p3($w, $l, $a, $b)
    {
        return [
            [$b + 13, 0],
            [$b + 14, 0],
            [$b + 14, 1],
            [$b + $l + 15, 1],
            [$b + $l + 15, 2],
            [2 * $b + $l + 28, 2],
            [2 * $b + $l + 28, 0],
            [3 * $b + $l + 42, 0],
            [3 * $b + $l + 42, $l + 1],
            [3 * $b + $l + 43, $l + 1],
            [3 * $b + $l + 43, $l + 2],
            [2 * $b + $l + 28, $l + 2],
            [2 * $b + $l + 28, 2],
            [$b + $a + $l + 28, $w + 4],
            [$b + $l + 15, $w + 4],
            [$b + $l + 15, $w + $a + 17],
            [$b + 13, $w + $a + 17],
            [$b + 13, $w + 4],
            [$b - $a, $w + 4],
            [0, 2],
            [$b + 13, 2],
            [$b + 13, 0]
        ];
    }

    protected function p4($w, $l, $a, $b)
    {
        return [
            [$b + 13, 0],
            [$b + 14, 0],
            [$b + 14, 1],
            [$b + $l + 15, 1],
            [$b + $l + 15, 2],
            [2 * $b + $l + 28, 2],
            [2 * $b + $l + 28, 0],
            [2 * $b + 2 * $l + 30, 0],
            [2 * $b + 2 * $l + 30, $b + 14],
            [2 * $b + $l + 29, $b + 14],
            [2 * $b + $l + 29, $b + 15],
            [2 * $b + $l + 28, $b + 15],
            [2 * $b + $l + 28, 2],
            [$b + $a + $l + 28, $w + 4],
            [$b + $l + 15, $w + 4],
            [$b + $l + 15, $w + $a + 17],
            [$b + 13, $w + $a + 17],
            [$b + 13, $w + 4],
            [$b - $a, $w + 4],
            [0, 2],
            [$b + 13, 2],
            [$b + 13, 0]
        ];
    }
}
