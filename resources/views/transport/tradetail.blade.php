<!--运费登记弹窗 :详情，修改，新增-->
<div class="tradetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <input type="hidden" name="status">
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">申请日期</label>
                <div class="col-sm-8">
                    <input type="text" onclick="laydate()" value="{{ isset($transport) ? $transport->applied_at : '' }}" readonly name="applied_at" class="form-control"/>
                </div>
            </div>
        </div>
        @include('common.dataselect', ['label'=>'订单号', 'var'=>'order_id', 'obj'=>$transport ?? ''])
        @include('common.dataselect', ['label'=>'类型', 'var'=>'type', 'obj'=>$transport ?? ''])
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">开票名称</label>
                <div class="col-sm-8">
                    <input type="text" {{ $disabled }} value="{{ isset($transport) ? $transport->name : '' }}" name="name" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">开票日期</label>
                <div class="col-sm-8">
                    <input type="text" onclick="laydate()" value="{{ isset($transport) ? $transport->billed_at : '' }}" readonly name="billed_at" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">发票号码</label>
                <div class="col-sm-8">
                    <input type="text" {{ $disabled }} value="{{ isset($transport) ? $transport->number : '' }}" name="number" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">金额</label>
                <div class="col-sm-8">
                    <input type="text" {{ $disabled }} value="{{ isset($transport) ? $transport->money : '' }}" name="money" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4 m-t-xs">
            <div class="form-group">
                <label for="proPic" class="col-sm-4 control-label">图片</label>
                <div class="col-sm-5">
                    <input type="button"  id="proPic" class="text-center form-control btn-s btn-primary supImg" value="添加图片" data-upload="image" data-input="[name=picture]"/>
                    <input type="hidden" value="{{ isset($transport) ? $transport->picture : '' }}" name="picture">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @include('common.approve')
    </form>
</div>