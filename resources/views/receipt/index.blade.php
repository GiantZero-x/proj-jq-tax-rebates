@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="/"><i class="fa fa-home"></i> 收汇管理</a></li>
        </ul>
        <section class="panel panel-default">
            <div class="panel-body">
                <div class="pull-left">
                    <form class="form-inline form-horizontal queryForm gcForm m-b-sm">
                        <input type="text" class="form-control" name="" placeholder="输入客户名称或汇款人">
                        <button type="submit" class="btn btn-success m-l-md">查询</button>
                    </form>
                </div>
                <a href="#" class="btn btn-s-md btn-danger m-r-xs pull-right" data-id="0" data-type="2" data-api="finance/receipt?outer=recdetail&tp=call" data-outwidth="1000px">新增收汇</a>
                <div data-gctable
                     data-url="receipt"
                     data-label="序号,客户名称,收汇日期,收汇金额,币别,汇率,人民币金额,汇款人,录入人员,录入日期"
                     data-query=".queryForm"
                     data-check="true"
                     data-operate="2|查看|primary|finance/receipt?outer=recdetail&tp=check|1000px,3|删除||finance/receipt?tp=del"
                     data-operateFilter=""
                     data-field="serial,name,created_at,linkman,address,telephone,user_id,user_id,user_id,created_by"
                     data-colWidth="70,100,80,80,100,100,70,70,80,80"
                ></div>
            </div>
        </section>
    </section>
</section>
@endsection