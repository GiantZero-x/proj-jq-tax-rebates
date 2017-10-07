@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="/"><i class="fa fa-home"></i> 收款方管理</a></li>
        </ul>
        <section class="panel panel-default">
            <div class="panel-body">
                <div class="pull-left">
                    <form class="form-inline form-horizontal queryForm gcForm m-b-sm">
                        <input type="text" class="form-control" name="keyword" placeholder="输入开户名">
                        <button type="submit" class="btn btn-success m-l-md">查询</button>
                    </form>
                </div>
                <a href="#" class="btn btn-s-md btn-danger m-r-xs pull-right" data-id="0" data-type="2" data-api="finance/remittee?outer=remdetail&tp=call" data-outwidth="800px">新增收款方</a>
                <div data-gctable
                     data-url="remittee"
                     data-label="序号,收款方类型,收款方名称,开户名,收款账号,开户银行,录入人员,录入日期"
                     data-query=".queryForm"
                     data-operate="2|修改|primary|finance/remittee?outer=remdetail&tp=update|800px,3|删除||finance/remittee?tp=del"
                     data-operateFilter=""
                     data-field="serial,remit_type_str,tag,name,number,bank,created_user_name,created_at"
                     data-colWidth="40,80,100,100,100,100,70,100"
                ></div>
            </div>
        </section>
    </section>
</section>
@endsection