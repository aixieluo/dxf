<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class UserExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = '人员订单报表.xlsx';

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
            '人员',
            '订单数',
            '订单金额',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::withCount([
            'orders'
        ])->selectSub("select sum(total) from orders left join order_design od on orders.id = od.order_id where user_id = users.id", 'total')
            ->when($this->request->input('start'), function (Builder $builder) {
                return $builder->whereHas('order', function (Builder $builder) {
                    return $builder->whereDate('created_at', '>=', $this->request->input('start'))->whereDate('created_at', '<=', $this->request->input('end'));
                });
            })->get()->map(function (User $user) {
            return [
                'id'    => $user->id,
                'name'  => $user->name,
                'count' => $user->orders_count,
                'total' => $user->total,
            ];
        });
    }
}
