<!--客户弹窗 :详情，新增-->
<div class="cusdetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="cusNumber" class="col-sm-4 control-label necessary_front">客户编号</label>
                <div class="col-sm-8">
                    <input type="text" id="cusNumber" name="number" value="{{ $customer->number ?? ''}}" {{ $disabled }} class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="cusName" class="col-sm-4 control-label necessary_front">客户名称</label>
                <div class="col-sm-8">
                    <input type="text" id="cusName" name="name" value="{{ $customer->name ?? ''}}" {{ $disabled }} class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="linkman" class="col-sm-4 control-label necessary_front">联系人</label>
                <div class="col-sm-8">
                    <input type="text" id="linkman" name="linkman"  value="{{ $customer->linkman ?? ''}}" {{ $disabled }} class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="linkPhone" class="col-sm-4 control-label necessary_front">联系电话</label>
                <div class="col-sm-8">
                    <input type="text" id="linkPhone" name="telephone" value="{{ $customer->telephone ?? ''}}" {{ $disabled }} class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="linkAddress" class="col-sm-4 control-label necessary_front">地址</label>
                <div class="col-sm-8">
                    <input type="text" id="linkAddress" name="address" value="{{ $customer->address ?? ''}}"  {{ $disabled }} class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        @if('read' === request()->route('type'))
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="salesman" class="col-sm-4 control-label necessary_front">业务员</label>
                <div class="col-sm-8">
                    <input type="text" id="salesman" disabled value="{{ $customer->user->name ?? ''}}"  class="form-control" data-parsley-required data-parsley-trigger="change"/>
                    <input type="hidden" name="user_id"  value="{{ $customer->user_id ?? ''}}">
                </div>
            </div>
        </div>
        @endif
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="serviceRate" class="col-sm-4 control-label">服务费率(%)</label>
                <div class="col-sm-8">
                    <input type="integer" data-parsley-type="integer" data-parsley-trigger="change" id="serviceRate" name="service_rate" value="{{ $customer->service_rate ?? ''}}" {{ $disabled }} class="form-control"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="receiver" class="col-sm-4 control-label">收款人</label>
                <div class="col-sm-8">
                    <input type="text" id="receiver" name="receiver" value="{{ $customer->receiver ?? ''}}"  {{ $disabled }} class="form-control"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="depositBank" class="col-sm-4 control-label">开户银行</label>
                <div class="col-sm-8">
                    <input type="text" id="depositBank" name="deposit_bank" value="{{ $customer->deposit_bank ?? ''}}" {{ $disabled }} class="form-control"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="bankAccount" class="col-sm-4 control-label">银行账号</label>
                <div class="col-sm-8">
                    <input type="text" id="bankAccount" name="bank_account" value="{{ $customer->bank_account ?? ''}}" {{ $disabled }} class="form-control"/>
                </div>
            </div>
        </div>
        {{--后两项查看时显示，新增不显示--}}
        @if (isset($customer))
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="col-sm-4 control-label">录入人员</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ $customer->created_user_name ?? ''}}" disabled class="form-control"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="col-sm-4 control-label">录入时间</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ $customer->created_at ?? ''}}" disabled class="form-control"/>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>