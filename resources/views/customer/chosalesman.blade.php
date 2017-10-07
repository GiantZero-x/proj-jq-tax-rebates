<!--分配业务员-->
<div class="chooseCus panel-body">
    <form class="form-horizontal" style="overflow: hidden;">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-3 control-label">已选择客户</label>
                <div class="col-sm-8 m-b-xs">
                    <input type="text" value="{{ (null !== $customers) ? $customers->implode('name', ',') : '' }}" class="form-control" readonly>
                    <input type="hidden" name="ids" value="{{ (null !== $customers) ? $customers->implode('id', ',') : '' }}">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label necessary_front">待分配员工</label>
                <div class="col-sm-8 m-b-xs">
                    <input type="text" class="form-control user_name" readonly data-parsley-required data-parsley-trigger="change">
                    <input type="hidden" name="user_id">
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive panel" style="overflow-x:auto;">
        <table class="table table-hover b-t b-light" style="table-layout: fixed;">
            <thead>
            <tr class="info">
                <th width="30%">员工账号</th>
                <th width="40%">姓名</th>
                <th width="30%">已分配客户数</th>
            </tr>
            </thead>
            <tbody class="salTbody">
            @foreach($salesman as $man)
                <tr data-id="{{ $man->id }}">
                    <td>{{ $man->username }}</td>
                    <td>{{ $man->name }}</td>
                    <td>{{ $man->customers->count() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
  $('.salTbody tr').click( function () {
    $(this).addClass('bg-active').siblings().removeClass('bg-active');
    $('.user_name').val($(this).find('td')[1].textContent);
    $('[name=user_id]').val($(this).data('id'));
  })
</script>