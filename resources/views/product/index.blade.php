@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><i class="fa fa-home"></i> 产品管理</li>
        </ul>
        <section class="panel panel-default">
            <header class="panel-heading text-right bg-light">
                @include('common.status', ['link'=>'product'])
                <span class="btn btn-sm btn-info btn-rounded" data-id="0" data-type="2" data-api="product?outer=prodetail&tp=add" data-outwidth="1000px">添加产品</span>
            </header>
            <div class="panel-body">
                <form class="form-inline queryForm gcForm m-b-sm">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="searchName" placeholder="输入申请人或产品名称">
                    </div>
                    <button type="submit" class="btn btn-success m-l-md">查询</button>
                </form>
                <div data-gctable
                     data-url="{{ request()->fullUrl() }}"
                     data-label="申请人,产品名称,产品英文名称,HSCode,品牌,型号,包装,材质,成分/含量,退税率,货号"
                     data-query=".queryForm"
                     data-operate="2|查看|primary|product?outer=prodetail&tp=check|1000px,2|修改||product?outer=prodetail&tp=update&df=y|1000px,2|审核||product?outer=prodetail&tp=examine|1000px,3|删除|info|product?tp=del"
                     data-operateFilter="c,u,e,d"
                     data-field="created_user_name,name,en_name,hscode,brand,standard,package,material,component,rate,number"
                     data-colWidth="70,100,190,100,80,100,70,70,100,60,60"
                ></div>
            </div>
        </section>
    </section>
</section>
@endsection