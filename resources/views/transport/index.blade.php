@extends('layouts.app')

@section('content')
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><i class="fa fa-home"></i> 运费登记</li>
            </ul>
            <section class="panel panel-default">
                <header class="panel-heading text-right bg-light">
                    @include('common.status', ['link'=>'finance/transport'])
                    <span class="btn btn-sm btn-rounded btn-info" data-id="0" data-type="2" data-api="finance/transport?outer=tradetail&tp=call" data-outwidth="850px">添加</span>
                </header>
                <div class="panel-body">
                    <form class="form-inline queryForm gcForm m-b-sm">
                        <div class="form-group">
                            <input type="text" class="form-control m-r-md" placeholder="可输入合同号、发票名称或发票号码">
                        </div>
                        <button type="submit" class="btn btn-success m-l-md">查询</button>
                    </form>
                    <div data-gctable
                         data-url="{{ request()->fullUrl() }}"
                         data-label="序号,申请日期,订单号,款项类型,金额"
                         data-query=".queryForm"
                         data-operate="2|查看|primary|finance/transport?outer=tradetail&tp=check|850px,2|修改||finance/transport?outer=tradetail&tp=update|850px,2|审核||finance/transport?outer=tradetail&tp=examine|850px"
                         data-operateFilter="c,u,e"
                         data-field="serial,applied_at,order.number,type_str,money"
                         data-colWidth="70,100,150,100,80,80,80">
                    </div>
                </div>
            </section>
        </section>
    </section>
@endsection