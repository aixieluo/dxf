@inject('op', 'App\Repositories\OrderRepository')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $order->id }}</title>
    <link rel="stylesheet" href="/css/bulma.min.css">
    <style>
    </style>
</head>
<body>
<section class="section">
    <div class="container">
        <div style="border-bottom: 1px solid #ccc; display: flex;flex-direction: row-reverse">
            <div>内部订单号：{{ $order->id }}</div>

        </div>
        <div class="section">
            <div class="columns">
                <div class="column is-flex">
                    <div class="title is-5">淘宝订单号：</div>
                    <div class="title is-6">{{ $order->oid }}</div>
                </div>
                <div class="column is-flex">
                    <div class="title is-5">订单创建时间：</div>
                    <div class="title is-6">{{ $order->created_at->format('Y年m月d日') }}</div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-flex">
                    <div class="title is-5">布料：</div>
                    <div class="is-flex is-justify-center">
                        <figure class="image is-32x32">
                            <img src="{{ env('APP_URL').$order->sofaItem->preview }}">
                        </figure>
                        <div style="margin-left: 20px" class="title is-6">{{ $order->sofaItem->name }}</div>
                    </div>
                </div>
                <div class="column is-flex">
                    <div class="title is-5">材料编码：</div>
                    <div class="title is-6">{{ $order->sofaItem->uid }}</div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-flex">
                    <div class="title is-5">产品类别：</div>
                    <div class="title is-6">{{ $order->sofa->name }}</div>
                </div>
                <div class="column is-flex">
                    <div class="title is-5">订单创建人：</div>
                    <div class="title is-6">{{ $order->user->name }}</div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-flex">
                    <div class="title is-5">客户地址：</div>
                    <div class="title is-6">{{ $order->recipient_information }}</div>
                </div>
                <div class="column is-flex">
                    <div class="title is-5">辅料总数：</div>
                    <div class="title is-6">{{ $op->accessoriesTotal($order) }}</div>
                </div>
            </div>
        </div>
        <div class="section">
            @foreach($order->orderDesigns as $od)
                <div class="columns" style="border-bottom: 1px solid #ccc">
                    <div class="column">
                        <figure class="image is-128x128">
                            <img src="{{ $od->design->url }}">
                        </figure>
                    </div>
                    <div class="column">
                        <div class="title is-4">{{ $od->design->name }}</div>
                        <div class="subtitle is-5">{{ "数量：{$od->count}个" }}</div>
                        <div class="subtitle is-5">{{ $od->lengths_text }}</div>
                    </div>
                </div>
            @endforeach
            <div class="columns">
                <div class="column"> </div>
                <div class="column">
                    <div class="subtitle is-5">{{ "合计数量：{$order->orderDesigns->sum('count')}个" }}</div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-flex">
                    <div class="title is-5">订单备注：</div>
                    <div class="title is-6">{{ $order->note }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
<script type="application/javascript">
    // window.print()
</script>
</html>
