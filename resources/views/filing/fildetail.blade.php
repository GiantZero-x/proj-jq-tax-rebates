<!--申报查看、新增-->
<div class="fildetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <input type="hidden" name="status">
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="apply_at" class="col-sm-4 control-label necessary_front">申报日期</label>
                <div class="col-sm-8">
                    <input type="text" onclick="laydate()" value="{{ isset($filing) ? $filing->applied_at : '' }}" id="applied_at" class="form-control" name="applied_at" readonly data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="apply_number" class="col-sm-4 control-label necessary_front">申报批次</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($filing) ? $filing->number : '' }}" id="number" name="number" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="register" class="col-sm-4 control-label">录入人员</label>
                <div class="col-sm-8">
                    <input type="text" id="register" value="{{ isset($filing) ? $filing->created_user_name : auth()->user()->name }}" class="form-control" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="h5 text-danger col-sm-4 control-label">发票信息</label>
                <div class="col-sm-6">
                    <a href="javascript:;" class="btn btn-s-md btn-success" data-check="invoice" data-content=".ftbody" data-target="[name=invoices_id]" data-outwidth="800px">添加发票</a>
                    <input type="hidden" name="invoices_id" >
                </div>
            </div>
        </div>
        <div class="col-sm-12 m-t-sm">
            <div class="form-group">
                <div class="table-responsive panel" style="overflow-x:auto;margin:0 15px;">
                    <table class="table table-hover b-t b-light" style="table-layout: fixed;">
                        <thead>
                        <tr class="info">
                            <th width="15%">订单号</th>
                            <th width="120">发票号</th>
                            <th width="100">开票时间</th>
                            <th width="120">开票金额</th>
                            <th width="110">收票时间</th>
                            <th width="70" class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody class="ftbody">
                        @if(isset($filing))
                            @forelse($filing->invoices as $invoice)
                                <tr data-id="{{ $invoice->id }}">
                                    <td>{{ $invoice->clearance->order->number }}</td>
                                    <td>{{ $invoice->number }}</td>
                                    <td>{{ $invoice->billed_at }}</td>
                                    <td>{{ $invoice->sum }}</td>
                                    <td>{{ $invoice->received_at }}</td>
                                    <td class="text-center text-danger deleteBox">删除</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">暂无数据</td>
                                </tr>
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
  $(function () {
    //      删除
    $('.ftbody').on('click','.deleteBox',function(){
      $(this).closest('tr').remove();
    })
  })
</script>