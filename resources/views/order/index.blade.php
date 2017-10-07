@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><i class="fa fa-home"></i> 订单管理</li>
        </ul>
        <section class="panel panel-default">
            <header class="panel-heading text-right bg-light">
                @include('common.status', ['link'=>'order'])
                <span class="btn btn-sm btn-rounded btn-info">导入excel</span>
                <span class="btn btn-sm btn-rounded btn-info" data-id="0" data-type="2" data-api="order?outer=orddetail&tp=add" data-outwidth="855px">添加订单</span>
            </header>
            <div class="panel-body">
                <form class="form-inline queryForm gcForm m-b-sm">
                    <div class="form-group">
                        <label for="orderNumber">订单号：</label>
                        <input type="text" name="order_number" class="form-control m-r-md" id="orderNumber">
                        <label for="apply_start_date">下单日期：</label>
                        <input type="text" id="apply_start_date" class="form-control" name="apply_start_date" readonly/>
                        <label for="apply_end_date">-</label>
                        <input type="text" id="apply_end_date" class="form-control" name="apply_end_date" readonly/>
                    </div>
                    <button type="submit" class="btn btn-success m-l-md">查询</button>
                </form>
                <div data-gctable
                     data-url="{{ request()->fullUrl() }}"
                     data-label="订单号,报关状态,报关详情,收汇状态,收汇详情,订单状态,下单时间"
                     data-query=".queryForm"
                     data-operate="2|查看|primary|order?outer=orddetail&tp=check|855px,2|修改||order?outer=orddetail&tp=update|855px,2|审核||order?outer=orddetail&tp=examine|855px,3|删除|info|order?tp=del,3|结案||order?tp=over"
                     data-operateFilter="c,u,e,d,f"
                     data-field="number,pro_name,pro_enname,pro_hscode,pro_brand,status_str,created_at"
                     data-colWidth="100,100,150,80,100,80,100">
                </div>
            </div>
        </section>
    </section>
</section>
<script>
    $(function(){
      // 查询日期设置
      setDateRange();
    });
</script>
@endsection