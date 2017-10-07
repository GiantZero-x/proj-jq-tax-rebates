<style>
    .ptbody input{
        border:none;
        text-align: center;
        background: inherit;
    }
    .parsley-errors-list{
        margin-top:3px;
    }
</style>
<!--开票人查看、修改，新增-->
<div class="dradetail panel-body">
    <form class="form-horizontal" style="overflow: hidden;">
        <input type="hidden" name="status">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label necessary_front">客户名称</label>
            <div class="col-sm-8">
                <input type="text" id="cusName" class="form-control" placeholder="点击选择客户" data-select="customer" data-target="[name=customer_id]" data-outwidth="800px" data-parsley-required data-parsley-trigger="change" value="{{ $drawer->customer->name ?? ''}}" {{ $disabled }} readonly/>
                <input type="hidden" value="{{ $drawer->customer_id ?? ''}}" name="customer_id">
            </div>
        </div>
        <div class="form-group">
            <label for="drawerComName" class="col-sm-2 control-label necessary_front">开票人公司名称</label>
            <div class="col-sm-8">
                <input type="text" id="drawerComName" name="company" class="form-control" data-parsley-required data-parsley-trigger="change"  value="{{ $drawer->company ?? ''}}" {{ $disabled }}/>
            </div>
        </div>
        <div class="form-group">
            <label for="drawerPhone" class="col-sm-2 control-label necessary_front">开票人联系方式</label>
            <div class="col-sm-8">
                <input type="text" id="drawerPhone" name="telephone" class="form-control" data-parsley-required data-parsley-trigger="change"  value="{{ $drawer->telephone ?? ''}}" {{ $disabled }}/>
            </div>
        </div>
        <div class="form-group">
            <label for="drawerTel" class="col-sm-2 control-label">座机</label>
            <div class="col-sm-8">
                <input type="text" id="drawerTel" name="phone" class="form-control" value="{{ $drawer->phone ?? ''}}" {{ $disabled }}/>
            </div>
        </div>
        <div class="form-group">
            <label for="taxIdtNumber" class="col-sm-2 control-label necessary_front">纳税人识别号</label>
            <div class="col-sm-8">
                <input type="text" id="taxIdtNumber" name="tax_id" class="form-control" placeholder="税务登记证上的号" data-parsley-required data-parsley-trigger="change"  value="{{ $drawer->tax_id ?? ''}}" {{ $disabled }}/>
            </div>
        </div>
        <div class="form-group">
            <label for="bLRN" class="col-sm-2 control-label necessary_front">营业执照注册号</label>
            <div class="col-sm-8">
                <input type="text" id="bLRN" name="licence" class="form-control" data-parsley-required data-parsley-trigger="change"  value="{{ $drawer->licence ?? ''}}" {{ $disabled }}/>
            </div>
        </div>
        <div class="form-group">
            <label for="taxIdtTime" class="col-sm-2 control-label necessary_front">一般纳税人认定时间</label>
            <div class="col-sm-8">
                <input type="text" id="taxIdtTime" name="tax_at" class="form-control" placeholder="此项需与提交的“一般纳税人认定书”照片信息保持一致" data-parsley-required data-parsley-trigger="change"  value="{{ $drawer->tax_at ?? ''}}" {{ $disabled }}/>
            </div>
        </div>
        <div class="form-group">
            <label for="drawerAddress" class="col-sm-2 control-label necessary_front">开票人地址</label>
            <div class="col-sm-8">
                <input type="text" id="drawerAddress" name="address" class="form-control" placeholder="即工厂地址，需和“税务登记证”地址一致，如不一致，需提供证明材料。" data-parsley-required data-parsley-trigger="change"  value="{{ $drawer->address ?? ''}}" {{ $disabled }}/>
            </div>
        </div>
        <div class="form-group">
            <label for="domesticSource" class="col-sm-2 control-label necessary_front">境内货源地</label>
            <div class="col-sm-8">
                <input type="text" id="domesticSource" name="source" class="form-control" placeholder="请根据企业注册地，填写正确的境内货源地。" data-parsley-required data-parsley-trigger="change"  value="{{ $drawer->source ?? ''}}" {{ $disabled }}/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">上传证照信息</label>
            <div class="col-sm-2">
                <a href="#" class="btn btn-s-md btn-primary necessary_front" data-upload="image" data-input="[name=pic_register]">税务登记证副本</a>
                <input type="hidden" name="pic_register" value="{{ $drawer->pic_register ?? ''}}" data-parsley-required data-parsley-trigger="change">
            </div>
            <div class="col-sm-2 m-l-md">
                <a href="#" class="btn btn-s-md btn-primary necessary_front" data-upload="image" data-input="[name=pic_verification]">一般纳税人认定书</a>
                <input type="hidden" name="pic_verification" value="{{ $drawer->pic_verification ?? ''}}" data-parsley-required data-parsley-trigger="change">
            </div>
            <div class="col-sm-2 m-l-lg">
                <a href="#" class="btn btn-s-md btn-primary" data-upload="image" data-input="[name=pic_other]">其他</a>
                <input type="hidden" name="pic_other" value="{{ $drawer->pic_other ?? ''}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label necessary_front">产品信息</label>
            @if('read' !== request()->route('type'))
                <div class="col-sm-8">
                    <a href="#" class="btn btn-s btn-danger" data-check="product" data-content=".ptbody" data-target="[name=pid]" data-outwidth="800px" {{ $disabled }}>添加产品</a>
                    <input type="hidden" name="pid">
                </div>
            @endif
        </div>
        <div class="form-group">
            <div class="table-responsive panel" style="overflow-x:auto;margin:0 15px;">
                <table class="table table-hover b-t b-light" style="table-layout: fixed;min-width: 1000px;">
                    <thead>
                    <tr class="info">
                        <th width="10%">产品图片</th>
                        <th width="15%">产品名称</th>
                        <th width="13%">HSCode</th>
                        <th width="10%">品牌</th>
                        <th width="10%">型号</th>
                        <th width="10%">包装</th>
                        <th width="10%">材质</th>
                        <th width="10%">货号</th>
                        <th width="70px" class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody class="ptbody">
                    @if (isset($drawer))
                        @foreach($drawer->products as $product)
                            {{--新增不显示，修改&查看&审核显示--}}
                            <tr data-id="{{ $product->id }}" >
                                <td><img src="{{ $product->picture }}" onclick="imgMagnify($(this).attr('src'))"></td>
                                <td>
                                    <input type="text" value="{{ $product->name }}" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $product->hscode }}" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $product->brand }}" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $product->standard }}" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $product->package }}" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $product->material }}" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $product->number }}" readonly>
                                </td>
                                <td class="text-center text-danger pbtn deleteBox">删除</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
        @include('common.approve')
    </form>
</div>
<script>
    $(function(){
      //      删除所选产品
      $('.ptbody').on('click','.deleteBox',function(){
        $(this).closest('tr').remove();
      })
    })
</script>