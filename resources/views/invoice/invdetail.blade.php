<style>
    .invBody .parsley-errors-list {
        position: relative;
    }
</style>
<!--发票登记-->
<div class="invdetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <input type="hidden" name="status">
        <label class="h5 text-danger m-t-sm col-sm-12">发票信息</label>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="company" class="col-sm-4 control-label">开票工厂</label>
                <div class="col-sm-8">
                    <input type="text"
                           value="{{ isset($invoice) ? $invoice->drawerProducts->first()->drawer->company : '' }}"
                           id="company" class="form-control" placeholder="选择开票工厂" data-select="company"
                           data-target="[name=company_id]" data-after="clearance_id" data-outwidth="600px"
                           data-parsley-required
                           data-parsley-trigger="change" readonly {{ $disabled }}/>
                    <input type="hidden" name="company_id"
                           value="{{ isset($invoice) ? $invoice->drawerProducts->first()->drawer->id : '' }}">
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="col-sm-4 control-label necessary_front">订单号</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"
                           value="{{ isset($invoice) ? $invoice->clearance->order->number : '' }}" placeholder="选择报关单"
                           data-before="company_id" data-follow="drawer_order" data-target="[name=clearance_id]"
                           data-outwidth="600px" data-parsley-required data-parsley-trigger="change"
                           readonly {{ $disabled }}/>
                    <input type="hidden" name="clearance_id"
                           value="{{ isset($invoice) ? $invoice->clearance_id : '' }}">
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="identify_number" class="col-sm-4 control-label">纳税人识别号</label>
                <div class="col-sm-8">
                    <input type="text"
                           value="{{ isset($invoice) ? $invoice->drawerProducts->first()->drawer->tax_id : '' }}"
                           id="identify_number" class="form-control" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="invoice_number" class="col-sm-4 control-label necessary_front">发票号码</label>
                <div class="col-sm-8">
                    <input type="text" id="invoice_number" value="{{ isset($invoice) ? $invoice->number : '' }}"
                           name="number" class="form-control" data-parsley-required
                           data-parsley-trigger="change" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="statime" class="col-sm-4 control-label necessary_front">开票日期</label>
                <div class="col-sm-8">
                    <input type="text" onclick="laydate()"
                           value="{{ isset($invoice) ? $invoice->billed_at : '' }}" id="statime"
                           class="form-control" name="billed_at" readonly data-parsley-required
                           data-parsley-trigger="change" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="endtime" class="col-sm-4 control-label necessary_front">收票日期</label>
                <div class="col-sm-8">
                    <input type="text" onclick="laydate()" id="endtime"
                           value="{{ isset($invoice) ? $invoice->received_at : '' }}"
                           class="form-control" name="received_at" readonly data-parsley-required
                           data-parsley-trigger="change" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="money" class="col-sm-4 control-label">开票金额</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($invoice) ? $invoice->sum : 0 }}" name="sum" id="money"
                           class="form-control" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-12 m-t-sm">
            <div class="form-group">
                <label class="h5 text-danger m-t-sm col-sm-12">商品信息</label>
            </div>
        </div>
        <div class="col-sm-12 m-t-sm">
            <div class="form-group">
                <div class="table-responsive panel" style="overflow-x:auto;margin:0 15px;">
                    <table class="table table-hover b-t b-light" style="table-layout: fixed;min-width: 1300px;">
                        <thead>
                        <tr class="info">
                            <th width="70">序号</th>
                            <th width="20%">商品编码</th>
                            <th width="15%">商品名称</th>
                            <th width="80">单位</th>
                            <th width="100">产品数量</th>
                            <th width="100">税率(%)</th>
                            {{--<th width="15%">货值</th>--}}
                            <th width="15%">单价(含税)</th>
                            <th width="100">发票数量</th>
                            <th width="100">发票金额</th>
                            <th width="15%">未开票数量</th>
                            <th width="15%">累计发票金额</th>
                            <th width="70" class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody class="invBody">
                        @if(isset($invoice))
                            @forelse($invoice->drawerProducts as $drawerProduct)
                                <tr>
                                    <input type="hidden" name="inv[{{ $drawerProduct->id }}][drawer_product_id]"
                                           value=b.id">
                                    <input type="hidden" name="inv[{{ $drawerProduct->id }}][clearance_id]"
                                           value="{{ $invoice->clearance_id }}">
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $drawerProduct->product->hscode }}</td>
                                    <td>{{ $drawerProduct->product->name }}</td>
                                    @php
                                        $pivot = $invoice->clearance->order->drawerProducts()->wherePivot('drawer_product_id', $drawerProduct->id)->first()->pivot;
                                    @endphp
                                    <td>{{ $pivot->unit or '' }}</td>
                                    <td>{{ $pivot->number or '' }}</td>
                                    <td><input type="text" name="inv[{{ $drawerProduct->id }}][rate]" value="{{ $drawerProduct->product->rate }}" data-parsley-type="integer" data-parsley-required data-parsley-trigger="change" placeholder="请填写税率" class="rate text-center" {{ $disabled }}></td>
                                    {{--<td>{{ $pivot->single_price * $pivot->number }}</td>--}}
                                    <td class="single_price">{{ $drawerProduct->pivot->price }}</td>
                                    <td><input type="text" name="inv[{{ $drawerProduct->id }}][amount]" value="{{ $drawerProduct->pivot->amount }}" data-parsley-type="integer" data-parsley-required data-parsley-trigger="change" placeholder="请填写数量" class="amount text-center" {{ $disabled }}></td>
                                    <td><input type="text" name="inv[{{ $drawerProduct->id }}][price]" value="{{ $drawerProduct->pivot->price }}" data-parsley-type="number" data-parsley-required data-parsley-trigger="change" placeholder="请填写发票金额" class="price text-center" {{ $disabled }}></td>
                                    <td class="rest_amount" data-value="{{ (int) ($pivot->number - array_get($invoice->clearance->product_count, $drawerProduct->id)['amount']) }}">{{ (int) ($pivot->number - array_get($invoice->clearance->product_count, $drawerProduct->id)['amount']) }} </td>
                                    <td class="gather_price" data-value="{{ array_get($invoice->clearance->product_count, $drawerProduct->id)['sum'] }}">{{ array_get($invoice->clearance->product_count, $drawerProduct->id)['sum'] }}</td>
                                    <td class="text-center text-danger deleteBox">删除</td>
                                </tr>
                            @empty
                                暂无数据
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('common.approve')
    </form>
</div>
<script>
  $(function () {
    //      删除
    $('.invBody').on('click', '.deleteBox', function () {
      $(this).closest('tr').remove();
      sum_price();
    });

    //计算单价
    function calc(p, rt, sp) {
      var divisor = accAdd(1,accDiv(rt.val(),100,2),2);
      if (p.val() && rt.val() && !isNaN(accDiv(p.val(), divisor,8))) {
        sp.html(accDiv(p.val(), divisor, 8));
      }
    }

    //计算总开票金额
    function sum_price() {
      var money = 0;
      $('.price').each(function (i, v) {
        money += parseFloat(v.value);
      });
      $('#money').val(money);
    }

    //发票金额改变，计算累计发票金额以及单价
    $('.invBody').on('keyup', '.price', function () {
      var $p = $(this).closest('tr').find('.price'), //发票金额
//        $amount = $(this).closest('tr').find('.amount'), //发票数量
        $gp = $(this).closest('tr').find('.gather_price'),//累计发票金额
        $rt = $(this).closest('tr').find('.rate'),//税率
        $sp = $(this).closest('tr').find('.single_price'); //单价=发票金额/(1+税率%）
      if ($p.val() <= 0) {
        layer.msg('发票金额需大于0！');
        $p.val('');
        $(this).closest('tr').find('.single_price').html('');
        $gp.html($gp.data('value'));
        return false;
      }
      $gp.html(accAdd($gp.data('value'), $p.val(), 4));
      sum_price();
      calc($p, $rt, $sp);
    });

    //税率改变，计算单价
    $('.invBody').on('keyup', '.rate', function () {
      var $p = $(this).closest('tr').find('.price'), //发票金额
//        $amount = $(this).closest('tr').find('.amount'), //发票数量
//        $gp = $(this).closest('tr').find('.gather_price'),//累计发票金额
        $rt = $(this).closest('tr').find('.rate'),//税率
        $sp = $(this).closest('tr').find('.single_price'); //单价=发票金额/(1+税率%）
      if ($rt.val() <= 0) {
        layer.msg('税率需大于0！');
        $rt.val('');
        $(this).closest('tr').find('.single_price').html('');
        return false;
      }
      calc($p, $rt, $sp);
    });

    //计算未开票数量
    $('.invBody').on('keyup', '.amount', function () {
      var $rest_amount = $(this).closest('tr').find('.rest_amount'),
//        $gp = $(this).closest('tr').find('.gather_price'),
//            $p = $(this).closest('tr').find('.price'),
//            $sp = $(this).closest('tr').find('.single_price'),
        $amount = $(this).closest('tr').find('.amount');
      if ($amount.val() > $rest_amount.data('value')) {
        $amount.val($rest_amount.data('value'));
      }
      if ($amount.val() <= 0) {
        layer.msg('发票数量需大于0！');
        $amount.val('');
        $rest_amount.html($rest_amount.data('value'));
        return false;
      }
      $rest_amount.html(accSub($rest_amount.data('value'), $amount.val(), 0));
    });

  })
</script>