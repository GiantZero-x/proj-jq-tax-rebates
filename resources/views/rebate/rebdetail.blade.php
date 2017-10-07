<!--已退税查看、退税登记-->
<div class="rebdetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="fillBatch" class="col-sm-4 control-label necessary_front">申报批次</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="fillBatch" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="col-sm-4 control-label">申报日期</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="invoiceStartDate" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="col-sm-4 control-label">申报金额</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">退回金额</label>
                <div class="col-sm-8">
                    <input type="text" id="" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">票数</label>
                <div class="col-sm-8">
                    <input type="text" id="" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">退回日期</label>
                <div class="col-sm-8">
                    <input type="text" id="" onclick="laydate()" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">录入日期</label>
                <div class="col-sm-8">
                    <input type="text" id="" onclick="laydate()" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        {{--以下已退税查看页面可见，退税登记不可见--}}
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label class="h5 text-danger col-sm-4 control-label">发票信息</label>
            </div>
        </div>
        <div class="col-sm-12 m-t-sm">
            <div class="form-group">
                <div class="table-responsive panel" style="overflow-x:auto;margin:0 15px;">
                    <table class="table table-hover b-t b-light" style="table-layout: fixed;">
                        <thead>
                        <tr class="info">
                            <th width="70">序号</th>
                            <th width="15%">合同号</th>
                            <th>开票工厂</th>
                            <th width="120">发票号</th>
                            <th width="100">开票时间</th>
                            <th width="120">开票金额</th>
                            <th width="110">收票时间</th>
                            <th width="70">状态</th>
                        </tr>
                        </thead>
                        <tbody class="boxBody">
                        <tr>
                            <td>00010</td>
                            <td>045587712</td>
                            <td>更好解决管公积金公共机构</td>
                            <td>0245224242</td>
                            <td>2012-02-02</td>
                            <td>121442</td>
                            <td>2022-01-01</td>
                            <td>已审核</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
