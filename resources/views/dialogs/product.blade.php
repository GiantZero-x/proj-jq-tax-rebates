<!--选择产品-->
<div class="panel-body">
    <form class="form-inline queryForm form-horizontal m-b-sm" role="form">
        <input type="text" class="form-control m-l-sm" placeholder="输入产品名称">
        <button type="submit" class="btn btn-success m-l-md">查询</button>
    </form>
    <div data-gctable
         data-url="/product/3"
         data-label="产品图片,产品名称,HSCode,品牌,型号,包装,材质,货号"
         data-query=".queryForm"
         data-check="true"
         data-operate=""
         data-operateFilter=""
         data-field="picture,name,hscode,brand,standard,package,material,number"
         data-colWidth="70,100,100,100,80,80,80,80"
         data-minWidth="700px"
         data-save="proList"
    ></div>
</div>