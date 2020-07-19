<?php

namespace App\Designs;

class D3 extends Design
{
    protected function getPoints()
    {
        try {
            $w = $this->lengths['w'];
            $h = $this->lengths['h'];
            $l = $this->lengths['l'];
        } catch (\Exception $exception) {
            throw new \Exception('参数不正确，无法生成');
        }
        if (($w + 2) > 144 and ($l + 2) <= 144) {
            // 1
        } elseif (($w + 2) <= 144 and ($l + 2) > 144) {
            list($w, $l) = [$l, $w];
            // 1
        } elseif (($w + 2) <= 144 and ($l + 2) <= 144) {
            if ($w > $l) {
                list($w, $l) = [$l, $w];
            }
            // 1
        } else {
            throw new \Exception('你提供的尺寸暂时无法定做！');
        }
        return [[0, 0], [$w + 2, 0], [$w + 2, $l + 2], [0, $l + 2], [0, 0]];
    }
}