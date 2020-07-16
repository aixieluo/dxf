<?php

namespace App\Exports;

use App\Models\SofaCoverItem;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class MaterialExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = '材料报表.xlsx';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function headings() : array
    {
        return [
            'ID',
            '材料类型',
            '材料名称',
            '材料规格',
            '材料编号',
            '规格编号',
            '耗用材料',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $s = SofaCoverItem::with([
            'sofa'
        ])->select(['*'])->selectSub("select sum(od.width) from orders left join order_design od on orders.id = od.order_id where orders.sofa_cover_item_id = sofa_cover_items.id", 'width')
            ->when($this->request->input('start'), function (Builder $builder) {
                return $builder->whereHas('order', function (Builder $builder) {
                    return $builder->whereDate('created_at', '>=', $this->request->input('start'))->whereDate('created_at', '<=', $this->request->input('end'));
                });
            })->get()->map(function (SofaCoverItem $s) {
                return [
                    'id' => $s->id,
                    'sofa_name' => $s->sofa->name,
                    'name' => $s->name,
                    'color' => $s->color,
                    'uid' => $s->uid,
                    'fid' => $s->fid,
                    'width' => $s->width
                ];
            });
        return $s;
    }
}
