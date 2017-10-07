@extends('layouts.app')

@section('content')
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><i class="fa fa-home"></i> 申报管理</li>
        </ul>
        <section class="panel panel-default">
            <header class="panel-heading text-right bg-light">
                @include('common.status', ['link'=>'filing'])
                <span class="btn btn-sm btn-rounded btn-info" data-id="0" data-type="2" data-api="filing?outer=fildetail&tp=add" data-outwidth="850px">申报登记</span>
            </header>
            <div class="panel-body">
                <form class="form-inline queryForm gcForm m-b-sm">
                    <div class="form-group">
                        <label for="apply_start_date">申报日期：</label>
                        <input type="text" id="apply_start_date" class="form-control" name="apply_start_date" readonly/>
                        <label for="fillGetDateE">-</label>
                        <input type="text" id="apply_end_date" class="form-control" name="apply_end_date" readonly/>
                    </div>
                    <button type="submit" class="btn btn-success m-l-md">查询</button>
                </form>
                @if( 1 == request()->route('status'))
                    <div data-gctable
                         data-url=" {{ request()->fullUrl() }}"
                         data-label="序号,状态,申报日期,申报批次"
                         data-query=".queryForm"
                         data-operate="2|查看|primary|{{ request()->segment(1) }}?tp=check|850px,2|申报||filing?outer=fildetail&tp=update|850px"
                         data-operateFilter="u,u"
                         data-field="serial,status_str,applied_at,number"
                         data-colWidth="70,100,150,100,80,80,80,80,80,80">
                    </div>
                @else
                    <div data-gctable
                         data-url=" {{ request()->fullUrl() }}"
                         data-label="序号,状态,申报日期,申报批次"
                         data-query=".queryForm"
                         data-operate="2|查看|primary|{{ request()->segment(1) }}?tp=check|850px"
                         data-operateFilter="c"
                         data-field="serial,status_str,applied_at,number"
                         data-colWidth="70,100,150,100,80,80,80,80,80,80">
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