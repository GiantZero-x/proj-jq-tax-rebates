@if('approve' === request()->type)
    {{--以下三项审批通过&拒绝的查看页面以及审核页面可见--}}
    <div class="line line-dashed"></div>
    <div class="col-sm-4 m-t-sm">
        <div class="form-group">
            <label class="col-sm-4 control-label">审核结果</label>
            <div class="col-sm-8">
                <select class="form-control result" data-parsley-required data-parsley-trigger="change">
                    <option value="0">审核通过</option>
                    <option value="1">审核不通过</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-4 m-t-sm">
        <div class="form-group">
            <label class="col-sm-4 control-label">审核日期</label>
            <div class="col-sm-8">
                <input type="text" onclick="laydate()" class="form-control" readonly/>
            </div>
        </div>
    </div>
    <div class="col-sm-12 m-t-sm">
        <div class="form-group">
            <label class="col-sm-1 control-label" style="padding:7px 0;">审核意见</label>
            <div class="col-sm-11">
                <textarea name="proNote" class="form-control opinion" rows="3"></textarea>
            </div>
        </div>
    </div>
@endif