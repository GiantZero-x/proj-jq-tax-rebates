<!--产品弹窗 :详情，修改，新增-->
<div class="prodetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <input type="hidden" name="status">
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="cusName" class="col-sm-4 control-label necessary_front">客户名称</label>
                <div class="col-sm-8">
                    <input type="text" id="cusName" class="form-control"
                           value="{{ isset($product->customer) ? $product->customer->name : ''}}" placeholder="点击选择客户"
                           data-select="customer" data-target="[name=customer_id]" data-outwidth="800px"
                           data-parsley-required data-parsley-trigger="change" {{ $disabled }} readonly/>
                    <input type="hidden" name="customer_id" value="{{ $product->customer_id ?? ''}}">
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="proName" class="col-sm-4 control-label necessary_front">产品名称</label>
                <div class="col-sm-8">
                    <input type="text" id="proName" name="name" class="form-control" data-parsley-required
                           data-parsley-trigger="change" value="{{ $product->name ?? ''}}" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="proEnName" class="col-sm-4 control-label">产品英文名称</label>
                <div class="col-sm-8">
                    <input type="text" id="proEnName" name="en_name" class="form-control"
                           value="{{ $product->en_name ?? ''}}" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="proCode" class="col-sm-4 control-label">HSCode</label>
                <div class="col-sm-8">
                    <input type="text" id="proCode" name="hscode" class="form-control"
                           value="{{ $product->hscode ?? ''}}" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="taxRefundRate" class="col-sm-4 control-label">退税率</label>
                <div class="col-sm-8">
                    <input type="text" id="taxRefundRate" name="rate" class="form-control"
                           value="{{ $product->rate ?? ''}}" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="proNumber" class="col-sm-4 control-label">货号</label>
                <div class="col-sm-8">
                    <input type="text" id="proNumber" name="number" class="form-control"
                           value="{{ $product->number ?? ''}}" {{ $disabled }}/>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12 table-responsive">
            <table class="table table-bordered m-b-none">
                <thead class="hsDetailThead"></thead>
                <tbody class="hsDetailTbody"></tbody>
            </table>
        </div>
        <div class="col-sm-4 m-t-sm">
            <div class="form-group">
                <label for="proPic" class="col-sm-4 control-label">图片</label>
                <div class="col-sm-5">
                    <input type="button" id="proPic" class="text-center form-control btn-s btn-primary"
                           value="{{ $disabled? '查看图片':'添加图片' }}" data-upload="image" data-input="[name=picture]"/>
                    <input type="hidden" name="picture" value="{{ $product->picture ?? ''}}">
                </div>
            </div>
        </div>
        <div class="col-sm-12 m-t-sm">
            <div class="form-group">
                <label for="proNote" class="col-sm-1 control-label">备注</label>
                <div class="col-sm-11">
                    <textarea id="proNote" name="remark" class="form-control" value="{{ $product->remark ?? ''}}"
                              {{ $disabled }} rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @include('common.approve')
    </form>
</div>

<script>
  $(function () {
    if ($('.chooseGoodsBox').length == 0) {
      $(document.body).append('<div class="chooseGoodsBox" >' +
        '<table>' +
        '<thead>' +
        '<tr>' +
        '<th width="20%">HS编码</th>' +
        '<th width="25%">商品名称</th>' +
        '<th width="35%">品牌</th>' +
        '<th>型号</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody class="goodsList">' +
        '</tbody>' +
        '</table>' +
        '</div>')
    }

    $('#proCode,#proName').keyup(function (e) {
      e.stopPropagation();
      if (e.which === 13) {
        var $this = $(this);
        getGoodsByEnter($this.val().trim())
      }
    });

    function getGoodsByEnter(value) {
      if (value == '') {
        return false
      }
      $.getJSON('/curl', {
        url: "http://192.168.17.50:811/public/hscode/" + value
      }).done(function (res) {
        if (res.total === 0) {
          layer.msg('未匹配到任何数据');
          $.getJSON('/curl', {
            url: "http://192.168.17.50:811/public/element/" + value
          }).done(function(ret){
            var html1 = '<tr class="bg-gradient">',
              html2 = '<tr>',
              $thead = $('.hsDetailThead'),
              $tbody = $('.hsDetailTbody');
            $.each(ret, function (i) {
              html1 += '<th class="text-center">' + ret[i] + '</th>';
              html2 += '<td><input class="text-center" type="text"></td>';
            });
            $thead.html(html1);
            $tbody.html(html2);
          });
        } else {
          var $goodsList = $('.goodsList'),
            html = '';
          $.each(res.data, function (i, v) {
            html += '<tr>' +
              '<td>' + v.HSCODE + '</td>' +
              '<td>' + v.PRODNAME + '</td>' +
              '<td>' + v.PRODSP + '</td>' +
              '<td>' + v.TAXRADIO + '</td>' +
              '</tr>'
          });
          $goodsList.html(html);
          layer.open({
            type: 1,
            title: '相关产品',
            area: '600px',
            offset: '100px',
            content: $('.chooseGoodsBox'),
            btn: ['确定', '取消'],
            yes: function (i) {
              var number = $('.goodsList tr.active td:nth-child(1)').html(),
                name = $('.goodsList tr.active td:nth-child(2)').html(),
                arr = $('.goodsList tr.active td:nth-child(3)').html().split('|');
              $.getJSON('/curl', {
                url: "http://192.168.17.50:811/public/element/" + number
              }).done(function(ret){
                var html1 = '<tr class="bg-gradient">',
                  html2 = '<tr>',
                  $thead = $('.hsDetailThead'),
                  $tbody = $('.hsDetailTbody');
                $.each(ret, function (i) {
                  html1 += '<th class="text-center">' + ret[i] + '</th>';
                  html2 += '<td><input class="text-center" type="text" value="'+arr[i]+'"></td> ';
                });
                $thead.html(html1);
                $tbody.html(html2);
                $('#proName').val(name);
                $('#proCode').val(number);
              });
              layer.close(i);
            }
          });
        }
      });
    }
  });

  $('.chooseGoodsBox').on('click', '.goodsList tr', function () {
    $(this).addClass('active').siblings().removeClass('active');
  });
</script>