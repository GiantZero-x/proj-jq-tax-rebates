@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><i class="fa fa-home"></i> 发票管理</li>
        </ul>
        <section class="panel panel-default">
            <header class="panel-heading text-right bg-light">
                @include('common.status', ['link'=>'invoice'])
                <span class="btn btn-sm btn-info btn-rounded" data-id="0" data-type="2" data-api="invoice?outer=invdetail&tp=add" data-outwidth="980px">登记发票</span>
            </header>
            <div class="panel-body">
                <form class="form-inline queryForm gcForm m-b-sm">
                    <div class="form-group">
                        <label for="contractNumber">订单号：</label>
                        <input type="text" class="form-control m-r-md" id="contractNumber" name="contractNumber">
                        <label for="apply_start_date">收票日期：</label>
                        <input type="text" id="apply_start_date" class="form-control" name="apply_start_date" readonly/>
                        <label for="apply_end_date">-</label>
                        <input type="text" id="apply_end_date" class="form-control" name="apply_end_date" readonly/>
                    </div>
                    <button type="submit" class="btn btn-success m-l-md">查询</button>
                </form>
                <div data-gctable
                     data-url="{{ request()->fullUrl() }}"
                     data-label="序号,订单号,发票号,开票时间,开票金额,收票时间,状态"
                     data-query=".queryForm"
                     data-operate="2|查看|primary|invoice?outer=invdetail&tp=check|980px,2|修改||invoice?outer=invdetail&tp=update|980px,2|审核||invoice?outer=invdetail&tp=examine|980px,3|删除|info|invoice?tp=del"
                     data-operateFilter="c,u,e,d"
                     data-field="serial,clearance.order.number,number,billed_at,sum,received_at,status_str"
                     data-colWidth="70,100,150,100,80,80,80,80">
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