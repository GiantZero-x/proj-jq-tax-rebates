@extends('layouts.app')

@section('content')
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><i class="fa fa-home"></i> 付款管理</li>
            </ul>
            <section class="panel panel-default">
                <header class="panel-heading text-right bg-light">
                    @include('common.status', ['link'=>'finance/pay'])
                    <span class="btn btn-sm btn-rounded btn-info" data-id="0" data-type="2" data-api="finance/pay?outer=paydetail&tp=call" data-outwidth="850px">添加</span>
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
                         data-label="序号,申请日期,合同号,款项类型,款项内容,收款单位,金额"
                         data-query=".queryForm"
                         data-operate="2|查看|primary|finance/pay?outer=tradetail&tp=check|850px,2|修改||finance/pay?outer=tradetail&tp=update|850px,2|审核||finance/pay?outer=tradetail&tp=examine|850px"
                         data-operateFilter="c,u,e"
                         data-field="apply_name,pro_name,pro_enname,pro_hscode,pro_brand,pro_type,pro_package"
                         data-colWidth="70,100,150,100,80,80,80">
                    </div>
                </div>
            </section>
        </section>
    </section>
@endsection