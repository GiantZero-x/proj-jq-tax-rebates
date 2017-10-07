@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><i class="fa fa-home"></i> 报关管理</li>
        </ul>
        <section class="panel panel-default">
            {{--<header class="panel-heading text-right bg-light">
                <ul class="nav nav-tabs pull-left">
                    @foreach ($statuses as $key=>$status)
                        <li><a href="/clearance/{{ $key }}" >{{ $status }}（ {{ $qtys[$key] ?? 0 }}）</a></li>
                    @endforeach
                </ul>
                <span class="badge bg-info" data-id="0" data-type="2" data-api="drawer?outer=dradetail&tp=add" data-outwidth="820px"><a href="#">添加开票人</a></span>
            </header>--}}
            <div class="panel-body">
                <form class="form-inline form-horizontal queryForm gcForm m-b-sm">
                    <div class="form-group">
                        <div class="col-md-10 m-r-md">
                            <input type="text" class="form-control" name="searchName" placeholder="输入订单号、经营单位或客户名称">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">查询</button>
                </form>
                <div data-gctable
                     data-url="{{ request()->fullUrl() }}"
                     data-label="订单号,经营单位,报关详情,报关单号,提单号,收汇状态,收汇详情,订单状态"
                     data-query=".queryForm"
                     data-operateFilter=""
                     data-operate="2|查看|primary|clearance?outer=orddetail&tp=check|800px,2|报关文件||clearance/file?outer=fildetail&tp=checkFile|1000px"
                     data-field="order.number,order.sales_unit,bg_detail,bg_number,td_number,sh_status,sh_detail,order.status_str"
                     data-colWidth="70,100,190,100,100,80,100,70"
                ></div>
            </div>
        </section>
    </section>
</section>
@endsection