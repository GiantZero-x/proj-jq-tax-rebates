<style>
    .otbody .parsley-errors-list{
        position:relative;
    }
</style>
<!--订单查看、修改、添加-->
<div class="orddetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <input type="hidden" name="status">
        {{--1.报关方式--}}
        <div class="m-t-xs m-l-sm" style="line-height: 19px;">
            <b class="badge bg-danger">1</b>
            <label class=" h5 text-danger m-l-xs">报关方式</label>
        </div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="cusName" class="col-sm-4 control-label">客户</label>
                <div class="col-sm-8">
                    <input type="text" id="cusName" value="{{ isset($order) ? $order->customer->name : (isset($customer) ?  $customer->name : '')}}" class="form-control" placeholder="选择客户" data-select="customer" data-target="[name=customer_id]" data-outwidth="800px" data-parsley-required data-parsley-trigger="change" {{ $disabled }} readonly/>
                    <input type="hidden" name="customer_id" value="{{ isset($order) ? $order->customer_id : (isset($customer) ?  $customer->id : '') }}">
                </div>
            </div>
        </div>
        @include('common.dataselect', ['label'=>'经营单位', 'var'=>'sales_unit', 'obj'=>$order ?? ''])
        @include('common.dataselect', ['label'=>'报关口岸', 'var'=>'clearance_port', 'obj'=>$order ?? ''])
        @include('common.dataselect', ['label'=>'起运港', 'var'=>'shipment_port', 'obj'=>$order ?? ''])
        @include('common.dataselect', ['label'=>'报关方式', 'var'=>'declare_mode', 'obj'=>$order ?? ''])
        <div class="clearfix"></div>
        {{--2.产品及开票人信息--}}
        <div class="m-t-xs m-l-sm" style="line-height: 19px;">
            <b class="badge bg-danger">2</b>
            <label class=" h5 text-danger m-l-xs">产品及开票人信息</label>
        </div>
        @include('common.dataselect', ['label'=>'报关币种', 'var'=>'currency', 'obj'=>$order ?? ''])
        @include('common.dataselect', ['label'=>'价格条款', 'var'=>'price_clause', 'obj'=>$order ?? ''])
        @include('common.dataselect', ['label'=>'包装方式', 'var'=>'package', 'obj'=>$order ?? ''])
        @include('common.dataselect', ['label'=>'装柜方式', 'var'=>'loading_mode', 'obj'=>$order ?? ''])

        <div class="clearfix"></div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label class="col-sm-4 control-label">出货产品清单</label>
                <div class="col-sm-8">
                    <a href="javascript:;" class="btn btn-s-md btn-success" data-check="drawer" data-content=".otbody" data-outwidth="800px" {{ $disabled }}>选择需出货的产品</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 m-t-xs">
            <div class="form-group">
                <div class="table-responsive panel" style="overflow-x:auto;margin:0 15px;">
                    <table class="table table-hover b-t b-light" style="table-layout: fixed;min-width: 1050px;">
                        <thead>
                        <tr class="info">
                            <th width="8%">品名</th>
                            <th width="9%">产品数量</th>
                            <th width="6%">单位</th>
                            <th width="9%">单价(USD)</th>
                            <th width="8%">货值</th>
                            <th width="9%">法定数量</th>
                            <th width="9%">法定单位</th>
                            <th width="9%">开票金额(RMB)</th>
                            <th width="9%">毛重(KG)</th>
                            <th width="9%">净重(KG)</th>
                            <th width="10%">体积(CBM)</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody class="otbody">
                        {{--新增不显示，修改&查看&审核显示--}}

                        @if (isset($order) && null !== $order->drawerProducts)
                            @foreach($order->drawerProducts as $key => $drawerProducts)
                                <tr data-id="{{ $drawerProducts->id }}">
                                    <input type="hidden" name="pro[{{ $key }}][drawer_product_id]" value="{{ $drawerProducts->id }}">
                                    <td data-id="{{ $drawerProducts->product_id }}" data-order="product" data-outwidth="800px">{{ $drawerProducts->product->name }}</td>
                                    <td>
                                        <input value="{{ $drawerProducts->pivot->number }}" type="text" name="pro[{{ $key }}][number]" data-parsley-type="integer" data-parsley-trigger="change" class="number text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input value="{{ $drawerProducts->pivot->unit }}" type="text" name="pro[{{ $key }}][unit]" class="text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $drawerProducts->pivot->single_price }}" name="pro[{{ $key }}][single_price]"  data-parsley-type="number" data-parsley-trigger="change" class="single_price text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" class="total_price text-center" readonly>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $drawerProducts->pivot->default_num }}" name="pro[{{ $key }}][default_num]" data-parsley-type="integer" data-parsley-trigger="change" class="default_number text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $drawerProducts->pivot->legal_unit }}" name="pro[{{ $key }}][legal_unit]" class="text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $drawerProducts->pivot->value }}" name="pro[{{ $key }}][value]" data-parsley-type="number" data-parsley-trigger="change" class="default_price text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $drawerProducts->pivot->total_weight }}" name="pro[{{ $key }}][total_weight]" data-parsley-type="number" data-parsley-trigger="change" class="total_weight text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $drawerProducts->pivot->net_weight }}" name="pro[{{ $key }}][net_weight]" data-parsley-type="number" data-parsley-trigger="change" class="net_weight text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $drawerProducts->pivot->volume }}" name="pro[{{ $key }}][volume]" data-parsley-type="number" data-parsley-trigger="change" class="text-center" {{ $disabled }}>
                                    </td>
                                    <td class="text-center text-danger deleteBox">删除</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr class="danger">
                            <td colspan="3">
                                    <label>产品数量</label>
                                    <input type="text" readonly class="sum_number">
                            </td>
                            <td colspan="3">
                                    <label>总货值</label>
                                    {{--总开票金额--}}
                                    <input type="text" readonly class="sum_price">
                            </td>
                            <td colspan="3">
                                    <label>总毛重</label>
                                    <input type="text" readonly class="sum_weight">
                            </td>
                            <td colspan="3">
                                    <label>总净重</label>
                                    <input type="text" readonly class="sum_net_weight">
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="package_number" class="col-sm-4 control-label">整体包装件数</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($order) ? $order->package_number : ''}}" id="package_number" name="package_number" class="form-control" data-parsley-required data-parsley-trigger="change" {{ $disabled }}/>
                </div>
            </div>
        </div>
        @include('common.dataselect', ['label'=>'整体包装方式', 'var'=>'order_package', 'obj'=>$order ?? '', 'col'=>'6'])

        <div class="clearfix"></div>
        {{--3.报关信息--}}
        <div class="m-t-xs m-l-sm" style="line-height: 19px;">
            <b class="badge bg-danger">3</b>
            <label class=" h5 text-danger m-l-xs">报关信息</label>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="shipping_at" class="col-sm-4 control-label">预计出货日期</label>
                <div class="col-sm-8">
                    <input type="text" onclick="laydate()"  value="{{ isset($order) ? $order->shipping_at : ''}}" name="shipping_at" id="shipping_at" class="form-control" readonly {{ $disabled }}/>
                </div>
            </div>
        </div>
        @include('common.dataselect', ['label'=>'报关形式', 'var'=>'clearance_mode', 'obj'=>$order ?? '', 'col'=>'6'])

        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="broker_number" class="col-sm-4 control-label">报关行代码(10位)</label>
                <div class="col-sm-8">
                    <input type="text"  value="{{ isset($order) ? $order->broker_number : ''}}" id="broker_number" name="broker_number" class="form-control" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="broker_name" class="col-sm-4 control-label">报关行名称</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($order) ? $order->broker_name : ''}}" id="broker_name" name="broker_name" class="form-control" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="trade_country" class="col-sm-4 control-label">贸易国</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($order) ? $order->trade_country : ''}}" id="trade_country" name="trade_country" class="form-control" data-parsley-required data-parsley-trigger="change" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="is_special" class="col-sm-4 control-label">特殊关系确认</label>
                <div class="col-sm-8">
                    {{ Form::select('is_special', ['否','是'], isset($order) ? $order->is_special : '', [
                        'id' => 'is_special',
                        'class' => 'form-control',
                        'data-parsley-required',
                        'data-parsley-trigger' => 'change',
                    ]) }}
                    {{--<select id="is_special"  name="is_special" class="form-control" data-parsley-required data-parsley-trigger="change">
                        <option value=0>否</option>
                        <option value=1>是</option>
                    </select>--}}
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="aim_country" class="col-sm-4 control-label">最终目的国</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($order) ? $order->aim_country : ''}}" id="aim_country" name="aim_country" class="form-control" data-parsley-required data-parsley-trigger="change" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="unloading_port" class="col-sm-4 control-label">抵运港</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($order) ? $order->unloading_port : ''}}" id="unloading_port" name="unloading_port" class="form-control" data-parsley-required data-parsley-trigger="change" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label for="customs_number" class="col-sm-4 control-label">报关单号</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($order) ? $order->customs_number : ''}}" id="customs_number" name="customs_number" class="form-control" data-parsley-required data-parsley-trigger="change" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-8 m-t-xs">
            <div class="form-group">
                <label for="is_pay_special" class="col-sm-4 control-label">支付特许权使用费确认</label>
                <div class="col-sm-5">
                    {{ Form::select('is_pay_special', ['否','是'], isset($order) ? $order->is_pay_special : '', [
                        'id' => 'is_pay_special',
                        'class' => 'form-control',
                        'data-parsley-required',
                        'data-parsley-trigger' => 'change',
                    ]) }}
                    {{--<select id="is_pay_special" name="is_pay_special" class="form-control" data-parsley-required data-parsley-trigger="change">
                        <option value=0>否</option>
                        <option value=1>是</option>
                    </select>--}}
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-xs">
            <div class="form-group">
                <label class="col-sm-4 control-label">货柜信息</label>
                <div class="col-sm-8">
                    <a href="javascript:;" class="btn btn-s-md btn-success addBox" {{ $disabled }}>添加货柜</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 m-t-xs">
            <div class="form-group">
                <div class="table-responsive panel" style="overflow-x:auto;margin:0 15px;">
                    <table class="table table-hover b-t b-light" style="table-layout: fixed;">
                        <thead>
                        <tr class="info">
                            <th width="25%">箱号</th>
                            <th width="25%">箱型</th>
                            <th width="30%">提单号</th>
                            <th width="20%">操作</th>
                        </tr>
                        </thead>
                        <tbody class="boxBody">
                        @if (isset($order) && null !== $order->containers)
                            @foreach( $order->containers as $key => $container)
                                <tr>
                                    <td>
                                        <input type="text" value="{{ $container->number }}" name="box[{{ $key }}][number]" class="text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $container->type }}"  name="box[{{ $key }}][type]" class="text-center" {{ $disabled }}>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $container->tdnumber }}"  name="box[{{ $key }}][tdnumber]" class="text-center" {{ $disabled }}>
                                    </td>
                                    <td class="text-center text-danger deleteBox">删除</td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @include('common.approve')
    </form>
</div>
<script>
    $(function(){
//      添加货柜
      var indexBox = $('.boxBody>tr').length;
      $('.addBox').click(function(){
        $('.boxBody').append(
          '<tr><td><input type="text" name="box['+ indexBox +'][number]" class="text-center"></td><td><input type="text" name="box['+ indexBox +'][type]" class="text-center"></td><td><input type="text" name="box['+ indexBox +'][tdnumber]" class="text-center"></td><td class="text-center text-danger deleteBox">删除</td></tr>');
        indexBox++;
      });

//      删除货柜
      $('.boxBody').on('click','.deleteBox',function(){
        $(this).closest('tr').remove();
      });

//      删除所选择的出货产品
      $('.otbody').on('click', '.deleteBox', function () {
        $(this).closest('tr').remove();
        $('.number,.total_weight,.net_weight').keyup();
        if ($('.otbody>tr').length == 0) {
          $('.sum_number,.sum_price,.sum_weight,.sum_net_weight').prop('value','');
        }
      });

//      代理计算
            //输入产品数量时，法定数量跟随修改
      $('.otbody').on('keyup','.number',function(){
        $(this).closest('tr').find('.default_number').val($(this).val());
      })
        .on('keyup','.single_price,.number',function () {
          //计算货值（单价*数量）
          var sp = $(this).closest('tr').find('.single_price').val(),
            n = $(this).closest('tr').find('.number').val();
          if(sp && n){
            $(this).closest('tr').find('.total_price,.default_price').val(accMul(n,sp));
          }
          //计算总数量
          sum('.number','.sum_number',2);

          //计算总货值
          sum('.total_price','.sum_price',4);

        })
        //计算总毛重
        .on('keyup','.total_weight',function(){
          sum('.total_weight','.sum_weight',2);
        })
        //计算总净重
        .on('keyup','.net_weight',function(){
          sum('.net_weight','.sum_net_weight',2);
        });
      $('.single_price,.number,.total_weight,.net_weight').keyup();
    });
    function sum(s,t,num){
      var total = 0;
      $(s).each(function (i,v) {
        total =accAdd(total,v.value,num);
      });
      $(t).val(total);
    }
</script>