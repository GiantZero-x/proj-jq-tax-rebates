<!--选择产品-->
<div class="panel-body">
    {{--<form class="form-inline queryForm form-horizontal m-b-sm" role="form">
        <input type="text" class="form-control m-l-sm" placeholder="输入产品名称">
        <button type="submit" class="btn btn-success m-l-md">查询</button>
    </form>--}}
    <div data-gctable
         data-url="/order/3"
         data-label="订单号,客户,报关金额,下单日期,提单号"
         data-query=".queryForm"
         data-operate=""
         data-operateFilter=""
         data-field="number,customer_id,customer_id,created_at,customer_id"
         data-colWidth="70,70,70,70,70"
         data-minWidth="800px"
         data-save="ordList"
    ></div>
</div>