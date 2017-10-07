@extends('layouts.app')

@section('content')
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="/"><i class="fa fa-home"></i> 数据维护</a></li>
            </ul>
            <section class="row">
                <!-- 侧边导航 -->
                <aside class="col-md-2">
                    <ul class="nav nav-pills nav-stacked">
                        @forelse($types as $k=>$type)

                            <li role="presentation" class="text-center {{ $k === 0 ? 'active' : ''}}">
                                <a href="#box{{ $k }}" data-toggle="tab">{{ $type->name }}</a>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </aside>
                <!-- 右侧表格 -->
                <section class="col-md-10">
                    <div class="panel panel-default">
                        <div class="tab-content">
                            @foreach($types as $k=>$type)
                                <div class="tab-pane active" id="box{{ $k }}">
                                    <div data-table="jqgrid" data-url=" {{ url("/data/{$type->id}") }}"
                                         data-colName="编号,显示值,报关值" data-colModel="name,key" data-editrules="required,required">
                                        <table></table>
                                        <div></div>
                                    </div>
                                </div>
                            @endforeach
                            {{--<div class="tab-pane active" id="box_1">
                                <div data-table="jqgrid" data-url="{:url('index/data_manage/get_country')}"
                                     data-colName="编号,国家代码,国家英文名,国家中文名称,exam_mark,high_low"
                                     data-colModel="country_co,country_en,country_na,exam_mark,high_low" data-editrules="required,,required|custom" data-customfunc=",,validateCountryExist">
                                    <table></table>
                                    <div></div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="box_2">
                                <div data-table="jqgrid" data-url="{:url('index/data_manage/get_portLin')}"
                                     data-colName="编号,港口中文名,港口英文名,港口国家代码,港口代码"
                                     data-colModel="port_c_cod,port_e_cod,port_count,port_code" data-editrules="required,,,required|custom" data-customfunc=",,,validatePortExist">
                                    <table></table>
                                    <div></div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="box_3">
                                <div data-table="jqgrid" data-url="{:url('index/data_manage/get_white_cards')}"
                                     data-colName="编号,白卡号,承运单位名称,承运单位编号"
                                     data-colModel="white_card,name,identifier" data-editrules="required,required,required" data-customfunc=",,">
                                    <table></table>
                                    <div></div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </section>
            </section>
        </section>
    </section>
    <script type="text/javascript">
      $(document).ready(function(){
        init();
        function init()
        {
          $.each($('.tab-pane'), function(k, v){
            if ($(this).attr('id') != 'box0')
              $(this).removeClass('active');
          });
        }
      });
    </script>
    <script src="{{ URL::asset('/js/item/data.js') }}"></script>
@endsection