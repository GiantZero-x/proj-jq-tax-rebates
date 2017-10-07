<!--付款管理弹窗 :详情，修改，新增-->
<div class="tradetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <input type="hidden" name="status">
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">申请日期</label>
                <div class="col-sm-8">
                    <input type="text" onclick="laydate()" readonly name="applied_at" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">订单号</label>
                <div class="col-sm-8">
                    <input type="text" id="" class="form-control" placeholder="点击选择订单" data-select="order/3" data-target="[name=order_id]" data-outwidth="800px" data-parsley-required data-parsley-trigger="change" {{ $disabled }} readonly/>
                    <input type="hidden" name="order_id">
                </div>
            </div>
        </div>
        @include('common.dataselect', ['label'=>'款项类型', 'var'=>'type', 'obj'=>$transport ?? ''])
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">收款单位</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="company" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">收款账号</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="number" class="form-control" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">收款银行</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="bank" class="form-control" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">金额</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="money" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-12 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-1 control-label necessary_front">款项内容</label>
                <div class="col-sm-11">
                    <textarea id="" name="content" class="form-control" {{ $disabled }} rows="3"  data-parsley-required data-parsley-trigger="change"></textarea>
                </div>
            </div>
        </div>
        {{--已付款查看页面可见--}}
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">付款日期</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="pay_at" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="proPic" class="col-sm-4 control-label">图片</label>
                <div class="col-sm-5">
                    <input type="button" id="proPic" class="text-center form-control btn-s btn-primary supImg" value="添加图片" data-upload="image" data-input="[name=picture]"/>
                    <input type="hidden" name="picture">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @include('common.approve')
    </form>
</div>