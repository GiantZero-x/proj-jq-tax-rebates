<!--选择产品-->
<div class="panel-body">
    {{--<form class="form-inline queryForm form-horizontal m-b-sm" role="form">
        <input type="text" class="form-control m-l-sm" placeholder="输入产品名称">
        <button type="submit" class="btn btn-success m-l-md">查询</button>
    </form>--}}
    <div data-gctable
         data-url="{{ URL::to('/invoice_clearances', [request()->route( 'id' )]) }}"
         data-label="开票人,订单号"
         data-query=".queryForm"
         data-operate=""
         data-operateFilter=""
         data-field="order.drawer_products[0].drawer.company,order.number"
         data-colWidth="70,100"
         data-minWidth="600px"
         data-save="ordList"
    ></div>
</div>