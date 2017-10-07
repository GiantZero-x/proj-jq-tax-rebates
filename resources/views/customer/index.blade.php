@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="/"><i class="fa fa-home"></i> 客户管理</a></li>
        </ul>
        <section class="panel panel-default">
            <div class="panel-body">
                <div class="pull-left">
                    <form class="form-inline form-horizontal queryForm gcForm m-b-sm">
                        <div class="form-group">
                            {{--<label for="customerName" class="col-lg-4 control-label">客户名称</label>--}}
                            <div class="col-lg-7 m-r-md">
                                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="输入客户名称">
                            </div>
                        </div>
                        {{--<div class="form-group">
                            <label for="salesConfirm" class="col-lg-4 control-label">业务员</label>
                            <div class="col-lg-7 m-r-md">
                                <input type="text" class="form-control" id="salesConfirm" name="salesConfirm">
                            </div>
                        </div>--}}
                        <button type="submit" class="btn btn-success m-l-md">查询</button>
                    </form>
                </div>
                <div class="pull-right">
                    <a href="#" class="btn btn-s-md btn-danger pull-right allotBatch" data-type="2" data-api="chosalesman?outer=chooseCus&tp=allot" data-outwidth="800px">批量分配客户</a>
                    <a href="#" class="btn btn-s-md btn-danger m-r-xs pull-right" data-id="0" data-type="2" data-api="customer?outer=cusdetail&tp=call" data-outwidth="1000px">新增客户</a>
                </div>
                <div data-gctable
                     data-url=" {{ request()->fullUrl() }}"
                     data-label="客户名称,创建时间,联系人,地址,联系电话,业务员,创建人"
                     data-query=".queryForm"
                     data-check="true"
                     data-operateFilter=""
                     data-operate="2|查看|primary|customer?outer=cusdetail&tp=check|1000px,2|修改||customer?outer=cusdetail&tp=update&df=n|1000px,2|下单|info|order?outer=orddetail&tp=ord|855px,2|分配|danger|chosalesman?outer=chooseCus&tp=allot|800px"
                     data-field="name,created_at,linkman,address,telephone,user.name,created_user_name"
                     data-colWidth="100,80,80,100,100,70,70"
                ></div>
            </div>
        </section>
    </section>
</section>

<script>
    $(function(){
      $('.allotBatch').click(function(){
        var ids=[];
        $('[data-gctable] tbody tr input[type=checkbox]:checked').each(function(){
          ids.push($(this).closest('tr').data('id'))
        });
        $(this).data('id',ids);
        if (ids.length == 0){
          layer.msg('至少勾选一项');
          return false;
        }
      })
    })
</script>
@endsection