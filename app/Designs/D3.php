<?php

namespace App\Designs;

class D3 extends Design
{
    public function getWidth()
    {
        try {
            $l = collect($this->lengths);
            return $l->get('w') * $l->get('l') / 100 + 10;
        } catch (\Exception $exception) {
            throw new \Exception('参数不正确');
        }
    }

    protected function getPoints()
    {
        try {
            $w = $this->lengths['w'];
            $h = array_get($this->lengths, 'h');
            $l = $this->lengths['l'];
        } catch (\Exception $exception) {
            throw new \Exception('参数不正确，无法生成');
        }
        if (($w + 2) > 147 and ($l + 2) <= 147) {
            // 1
        } elseif (($w + 2) <= 147 and ($l + 2) > 147) {
            list($w, $l) = [$l, $w];
            // 1
        } elseif (($w + 2) <= 147 and ($l + 2) <= 147) {
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
