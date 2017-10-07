@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><i class="fa fa-home"></i> 开票人管理</li>
        </ul>
        <section class="panel panel-default">
            <header class="panel-heading text-right bg-light">
                @include('common.status', ['link'=>'drawer'])
                <span class="btn btn-sm btn-info btn-rounded" data-id="0" data-type="2" data-api="drawer?outer=dradetail&tp=add" data-outwidth="820px">添加开票人</span>
            </header>
            <div class="panel-body">
                <form class="form-inline queryForm gcForm m-b-sm">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="searchName" placeholder="输入开票人名称或纳税人识别号">
                    </div>
                    <button type="submit" class="btn btn-success m-l-md">查询</button>
                </form>
                <div data-gctable
                     data-url="{{ URL::full() }}"
                     data-label="开票人公司名称,纳税人识别号,提交时间,状态,客户名称"
                     data-query=".queryForm"
                     data-operate="2|查看|primary|drawer?outer=dradetail&tp=check|820px,2|修改||drawer?outer=dradetail&tp=update|820px,2|审核||drawer?outer=dradetail&tp=examine|820px,3|删除|info|drawer?tp=del"
                     data-operateFilter="c,u,e,d"
                     data-field="company,tax_id,created_at,status_str,customer_name"
                     data-colWidth="150,150,100,80,100"
                ></div>
            </div>
        </section>
    </section>
</section>
@endsection