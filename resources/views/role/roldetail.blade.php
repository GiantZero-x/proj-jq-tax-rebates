<style>
    .parsley-errors-list{
        margin-top:3px;
    }
</style>
<!--角色修改，新增-->
<div class="panel-body roldetail">
    <form class="form-horizontal" style="overflow: hidden;">
        <div class="form-group">
            <label for="display_name" class="col-sm-2 control-label necessary_front">角色名称</label>
            <div class="col-sm-9">
                <input type="text" id="display_name" name="display_name" class="form-control" data-parsley-required data-parsley-trigger="change" value="{{ $role->display_name ?? ''}}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label necessary_front">描述</label>
            <div class="col-sm-9">
                <textarea id="description" name="description" class="form-control" rows="3" data-parsley-required data-parsley-trigger="change" value="{{ $role->description ?? ''}}"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">权限</label>
            <div class="col-sm-9">
                <a href="javascript:;" class="btn btn-s-md btn-success" data-check="permission" data-content=".pertbody" data-outwidth="600px" {{ $disabled }}>分配权限</a>
                <input type="hidden" name="permission_id">
            </div>
        </div>
        <div class="form-group">
            <div class="table-responsive panel" style="overflow-x:auto;margin:0 15px;">
                <table class="table table-hover b-t b-light" style="table-layout: fixed;">
                    <thead>
                    <tr class="info">
                        <th width="80">权限名称</th>
                        <th width="120">描述</th>
                        <th width="50" class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody class="pertbody">
                    {{--查看时显示--}}
                    {{--<tr>--}}
                    {{--<td></td>--}}
                    {{--<td></td>--}}
                    {{--<td class="text-center text-danger deleteBox">删除</td>--}}
                    {{--</tr>--}}
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<script>
  $(function(){
    //      删除所选产品
    $('.pertbody').on('click','.deleteBox',function(){
      $(this).closest('tr').remove();
    })
  })
</script>