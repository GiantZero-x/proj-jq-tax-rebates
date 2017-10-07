<!--收汇管理弹窗 :详情，新增-->
<div class="recdetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <input type="hidden" name="status">
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">客户名称</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="" class="form-control"  placeholder="点击选择客户" data-select="customer" data-target="[name=customer_id]" data-outwidth="800px" data-parsley-required data-parsley-trigger="change" readonly/>
                    <input type="hidden" name="customer_id" value="">
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">收汇日期</label>
                <div class="col-sm-8">
                    <input type="text" onclick="laydate()" id="" name="" class="form-control" data-parsley-required data-parsley-trigger="change" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">收汇金额</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">币种</label>
                <div class="col-sm-8">
                    <select class="form-control" data-parsley-required data-parsley-trigger="change">
                        <option value="0">￥</option>
                        <option value="1">$</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">汇率</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">汇款人</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">汇款账号</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">汇款银行</label>
                <div class="col-sm-8">
                    <input type="text" id="" name="" class="form-control"/>
                </div>
            </div>
        </div>
        {{--以下两项查看页面可见--}}
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="col-sm-4 control-label">录入人员</label>
                <div class="col-sm-8">
                    <input type="text" disabled value="{{ request()->user()->name }}" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="col-sm-4 control-label">录入日期</label>
                <div class="col-sm-8">
                    <input type="text" disabled readonly value="{{ \Carbon\Carbon::now()->toDateString() }}" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="proPic" class="col-sm-4 control-label">图片</label>
                <div class="col-sm-5">
                    <input type="button" id="proPic" class="text-center form-control btn-s btn-primary supImg" value="添加图片" data-upload="image" data-input="[name=picLi]"/>
                    <input type="hidden" name="picLi">
                </div>
            </div>
        </div>
    </form>
</div>