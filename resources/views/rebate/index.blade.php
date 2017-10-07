@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><i class="fa fa-home"></i> 退税管理</li>
        </ul>
        <section class="panel panel-default">
            <header class="panel-heading text-right bg-light">
                <ul class="nav nav-tabs pull-left">
                    @foreach (App\Rebate::STATUS as $key=>$status)
                        <li><a href="/rebate/{{ $key }}" >{{ $status }}（ {{ array_get($qtys, $key, 0) }} ）</a></li>
                    @endforeach
                </ul>
                <span class="btn btn-sm btn-rounded btn-info" data-id="0" data-type="2" data-api="rebate?outer=rebdetail&tp=add" data-outwidth="900px">退税登记</span>
            </header>
            <div class="panel-body">
                @if (request()->route('status') == 0)
                <form class="form-inline queryForm gcForm m-b-sm">
                    <div class="form-group">
                        <label for="orderNumber">批次：</label>
                        <input type="text" class="form-control m-r-md" id="orderNumber">
                        <label for="apply_start_date">申报日期：</label>
                        <input type="text" id="apply_start_date" class="form-control" name="apply_start_date" readonly/>
                        <label for="apply_end_date">-</label>
                        <input type="text" id="apply_end_date" class="form-control" name="apply_end_date" readonly/>
                    </div>
                    <button type="submit" class="btn btn-success m-l-md">查询</button>
                </form>
                <div data-gctable
                     data-url="{{ request()->fullUrl() }}"
                     data-label="序号,录入日期,批次,申报日期,申报金额,录入人员"
                     data-query=".queryForm"
                     data-operate="2|查看|primary|invoice?outer=invdetail&tp=check|800px,2|退税登记||rebate?outer=rebdetail&tp=update|800px"
                     data-operateFilter="c,u"
                     data-field="serial,apply_name,pro_name,pro_enname,pro_hscode,pro_brand"
                     data-colWidth="70,100,150,100,80,80">
                </div>
                @else
                <form class="form-inline queryForm gcForm m-b-sm">
                    <div class="form-group">
                        <label for="contractNumber">订单号：</label>
                        <input type="text" class="form-control m-r-md" id="contractNumber">
                        <label for="apply_start_date">收票日期：</label>
                        <input type="text" id="apply_start_date" class="form-control" name="apply_start_date" readonly/>
                        <label for="apply_end_date">-</label>
                        <input type="text" id="apply_end_date" class="form-control" name="apply_end_date" readonly/>
                    </div>
                    <button type="submit" class="btn btn-success m-l-md">查询</button>
                </form>
                <div data-gctable
                     data-url="{{ request()->fullUrl() }}"
                     data-label="序号,录入日期,批次,申报日期,退税款金额,票数,退回日期,录入人员"
                     data-query=".queryForm"
                     data-operate="2|查看|primary|rebate?outer=rebdetail&tp=check|800px,2|退税登记||rebate?outer=rebdetail&tp=update|800px"
                     data-operateFilter="c,u"
                     data-field="serial,apply_name,pro_name,pro_enname,pro_hscode,pro_brand,pro_type,pro_package"
                     data-colWidth="70,100,150,100,80,80,80,80">
                </div>
                @endif
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