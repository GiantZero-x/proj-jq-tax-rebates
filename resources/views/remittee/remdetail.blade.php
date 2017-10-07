<!--收款方管理弹窗 :详情，新增-->
<div class="remdetail">
    <form class="form-horizontal" style="overflow: hidden;">
        @include('common.dataselect', ['label'=>'收款单位类型', 'var'=>'remit_type', 'obj'=>$remittee ?? '', 'col' => 6])
        <div class="col-sm-6 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-3 control-label necessary_front">收款单位</label>
                <div class="col-sm-8">
                    <input type="text"  value="{{ isset($remittee) ? $remittee->tag : '' }}" class="form-control company" data-target="[name=remit_id]" data-outwidth="800px" data-parsley-required data-parsley-trigger="change"/>
                    <input type="hidden" class="remit_id" name="remit_id" value="{{ isset($remittee) ? $remittee->remit_id : '' }}">
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">收款户名</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($remittee) ? $remittee->name : '' }}" name="name" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-3 control-label necessary_front">收款账号</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($remittee) ? $remittee->number : '' }}" name="number" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 m-t-sm">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label necessary_front">开户银行</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ isset($remittee) ? $remittee->bank : '' }}" name="bank" class="form-control" data-parsley-required data-parsley-trigger="change"/>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(function(){
      //根据收款单位类型选择收款单位
      $(document).on('click', '.company', function () {
        var ele,
          $this = $(this),
          outerWidth = $this.data().outwidth,
          outerTitle = $this.parent().prev().text();
        //开票工厂与订单号关联
        var company_type ;

        switch ($('#remit_type').val()){
          case 'App\\Customer':
            company_type = 'customer';
            $('.remit_id').attr('name','remit_id').prev().removeAttr('name');
            break;
          case 'App\\Drawer':
            company_type = 'drawer_user';
            $('.remit_id').attr('name','remit_id').prev().removeAttr('name');
            break;
          case 'App\\Other':
            $('.remit_id').removeAttr('name').prev().attr('name','remit_id');
            return;
        }
        var api = '/' + company_type + '/choose';
        $.get(api, {}, function (str) {
          var index = layer.open({
            type: 1,
            shadeClose: true,
            title: outerTitle,
            area: outerWidth,
            offset: '100px',
            btn: ['确定'],
            content: str,
            yes: function (i) {
              var company_id = ele.find('.bg-active').data('id');
              $($this.data('target')).val(company_id);
              $this.val(ele.find('.bg-active td').eq(0).html());
              layer.close(i);
            },
            end: function () {
            }
          });
          ele = $('#layui-layer' + index + ' [data-gctable]');
          tableShow(ele);
        })
      });

      //监听收款单位类型改变
      $('#remit_type').change(function () {
        $('.company').val('');
      })
    })
</script>