/**
 * 传入比较的符号及数值,若格式不对则返回Null
 * @param v       {Object}  取数据对象
 * @param filter  {Array}  描述字符串
 * @returns {*}   {String}  返回 true 或 false
 */
function compare(v, filter) {
  if (!filter) {
    return true;
  }
  switch (filter) {
    case 'c':
      return v.status < 4 && v.status > 1; //查看：审批中&审批通过
    case 'u':
      return v.status == 1 || v.status == 4; //修改：草稿&审批拒绝
    case 'e':
      return v.status == 2; //审核：审批中
    case 'd':
      return v.status == 1; //删除：草稿
    case 'f':
      return v.status == 3; //结案：审批通过（订单）
    default:
      throw new Error('参数不全');
  }
}


$(function () {
  //左侧导航栏激活样式
  var item = location.href.split('/')[3];
  if (!($('[name = ' + item + ']').hasClass('active'))) {
    $('[name = ' + item + ']').addClass('active').siblings().removeClass('active');
  }
  //tab页激活样式
  $('.nav-tabs a').each(function () {
    if ($(this).attr('href').split('/').reverse()[0] == location.href.split('/').reverse()[0]) {
      $(this).parent().addClass('active');
      $(this).parent().siblings().removeClass('active');
    }
  })
});

//  查看图片
function imgMagnify(imgUrl) {
  layer.open({
    type: 1,
    title: false,
    closeBtn: 2,
    area: '80%',
    offset: '10%',
    move: '.imgDrag',
    skin: 'layui-layer-nobg', //没有背景色
    content: '<div style="text-align: center">' +
    '<img  class="imgDrag" style="max-width:100%" src="' + imgUrl + '">' +
    '</div>'
  });
}

//  parsley验证
function validated($target) {
  var validated = true;
  $('[data-parsley-trigger]', $target).each(function () {
    $(this).parsley().validate();
    validated = $(this).parsley().isValid();
    if (!validated) {
      $(this).focus()
    }
    return validated;
  });
  return validated;
}

/**
 * 根据图片地址字符串渲染li
 * @param {Element}   target    显示容器的jquery对象
 * @param {String}    imgList   拼接图片地址字符串
 * @param {String}    glue      图片地址字符串分隔符 默认 '|'
 *
 * */
function randerImage(target, imgList, glue) {
  glue = glue || '|';
  if (!imgList) {
    return false;
  }
  if (typeof imgList !== 'string') {
    return layer.alert('地址只能是字符串!');
  }
  imgList = imgList.split(glue);

  for (var i = 0, html = ''; i < imgList.length; i++) {
    html += '<li class="gc_item"> ' +
      '<img src="' + imgList[i] + '"> ' +
      '<span class="gc_item_action"> ' +
      '<span class="gc_preview">预览</span> ' +
      '<span class="gc_delete">删除</span> ' +
      '</span> ' +
      '</li>'
  }
  target.append(html);
}

/* 上传图片函数封装 */
function gc_upload_image(el) {
  var target = $($(el).data('input')),
    show = $('.gc_file_list'),
    tip = "图片格式不支持，请选择png/gif/bmp/jpeg/jpg格式的图片！", // 设定提示信息
    uploadUrl = '/upload'; // 上传地址

  for (var i = 0, f; i < el.files.length; i++) {
    f = el.files[i];
    if (!/\.jpg$|\.png$|\.gif$|\.bmp$|\.jpeg/i.test(f.name)) {
      layer.msg(tip);
    } else {
      uploading(f);
    }
  }
  // 上传
  function uploading(f) {
    var form = new FormData();
    form.append("fileList", f);// 文件对象
    // XMLHttpRequest 对象
    var xhr = new XMLHttpRequest();
    xhr.open("post", uploadUrl, true);
    xhr.onload = function () {
      var responseText = '/' + JSON.parse(xhr.responseText).msg;
      var imgList = target.val();
      imgList += imgList == '' ? responseText : '|' + responseText;
      target.val(imgList);
      randerImage(show, responseText);
    };
    xhr.send(form);
  }
}

/* 上传文件函数封装 */
function upload_file(el) {
  var target = $($(el).data('input')),
    tip, // 设定提示信息
    uploadUrl = '/upload'; // 上传地址
  console.log(el.files[0].size)
  if ($(el).data('file') == 'excel') {
    tip = '文件格式不支持，请选择xls/xlsx格式文件';
    for (var i = 0, f; i < el.files.length; i++) {
      f = el.files[i];
      if (!/\.xls$|\.xlsx$/i.test(f.name)) {
        layer.msg(tip);
      } else if (el.files[0].size > 1024 * 1024 * 2) {
        layer.msg('文件大小超限,请选择小于2M的文件!');
        el.value = null;
      } else {
        uploading(f);
      }
    }
  } else {
    tip = "文件格式不支持，请选择png/gif/bmp/jpeg/jpg/pdf格式的文件,文件需小于2M！";
    for (var i = 0, f; i < el.files.length; i++) {
      f = el.files[i];
      if (!/\.jpg$|\.png$|\.gif$|\.bmp$|\.jpeg|\.pdf/i.test(f.name)) {
        layer.msg(tip);
      } else if (el.files[0].size > 1024 * 1024 * 2) {
        layer.msg('文件大小超限,请选择小于2M的文件!');
      } else {
        uploading(f);
      }
    }
  }

  // 上传
  function uploading(f) {
    var form = new FormData();
    form.append("fileList", f);// 文件对象
    // XMLHttpRequest 对象
    var xhr = new XMLHttpRequest();
    xhr.open("post", uploadUrl, true);
    xhr.onload = function () {
      var responseText = '/' + JSON.parse(xhr.responseText).msg;
      target.val(responseText).change();
    };
    xhr.send(form);
  }
}

/** 下载文件 文件名为最后一级地址名
 * @param {String} url  下载地址
 * @param {String} name 文件名
 * */
function downloadFile(url, name) {
  var a = document.createElement('a'),
    list = url.split('/');
  a.href = url;
  a.download = name || list[list.length - 1];
  $(document.body).append(a);
  a.click();
  a.parentNode.removeChild(a);
}

// 下载报关文件
$(document).on('click', '[data-download]', function () {
  var $this = $(this),
    url = $($this.data('download')).val();
  if (url === '') {
    return false;
  }
  downloadFile(url, $this.data('filename'))
});

//上传文件
$(document).on('click', '[data-upload=file]', function () {
  $(this).next().trigger('click');
});

$(document).on('change', '.upload_file', function () {
  upload_file(this);
});

//  上传图片
$(document).on('click', '[data-upload=image]', function () {
  var $this = $(this);
  /* 添加一个舞台 */
  $(document.body)
    .append('<div class="gc_upload_image"> ' +
      '<ul class="gc_file_list"></ul> ' +
      '<div class="gc_upload_btn"> ' +
      '<i class="gc_upload_icon">+</i> ' +
      '</div> ' +
      '<input multiple type="file" class="gc_upload_input" data-input="' + $this.data('input') + '"> ' +
      '</div>');
  var $box = $('.gc_upload_image');
  /* 首先根据input的值渲染图片*/
  randerImage($('.gc_file_list'), $($this.data('input')).val());
  $box
    .on('click', '.gc_upload_btn', function () {     //  上传按钮
      $(this).next().trigger('click');
    })
    .on('change', '.gc_upload_input', function () {  //  上传至服务器
      gc_upload_image(this);
    })
    .on('click', '.gc_preview', function () {        //  预览
      imgMagnify($(this).parent().prev().attr('src'));
    })
    .on('click', '.gc_delete', function () {         //  删除
      var img = $(this).parent().prev(),
        url = img.attr('src'),
        imgInput = $($box.find('.gc_upload_input').data('input'));
      img.parent().remove();
      if (imgInput.val() != '') {
        var arrImg = imgInput.val().split('|');
        for (var i = 0; i < arrImg.length; i++) {
          if (arrImg[i] == url) {
            arrImg.splice(i, 1);
            break;
          }
        }
        imgInput.val(arrImg.join('|'));
      }
    });
  /* 展示舞台 */
  layer.open({
    type: 1,
    content: $box,
    title: "添加图片",
    area: '680px',
    end: function () { //  弹窗被销毁时触发的回调
      $('.gc_upload_image').remove();
      if ($($this.data('input')).val() != '') {
        if ($this.data('change')) {
          $this.addClass($this.data('change')).removeClass('btn-primary');
        }
        if ($this.data('changetext')) {
          $this.text($this.data('changetext'));
        }
      } else {
        if ($this.data('change')) {
          $this.removeClass($this.data('change')).addClass('btn-primary');
        }
        if ($this.data('changetext')) {
          $this.text('上传图片');
        }
      }
    }
  });
});

// 设定日期区间查询,接收参数(起始input id, 结束input id)
function setDateRange(startId, endId) {
  startId = startId || 'apply_start_date';
  endId = endId || 'apply_end_date';
  var apply_start_date = {
      elem: '#' + startId,
      choose: function (datas) {
        apply_end_date.min = datas; //开始日选好后，重置结束日的最小日期
        apply_end_date.apply_start_date = datas; //将结束日的初始值设定为开始日
      }
    },
    apply_end_date = {
      elem: '#' + endId,
      choose: function (datas) {
        apply_start_date.max = datas; //结束日选好后，重置开始日的最大日期
      }
    };
  laydate(apply_start_date);
  laydate(apply_end_date);
}

var tableList = [];

/**
 *
 * @param $el {Element} 需要获取table自定属性的jQuery对象
 * @returns now         {Number}    创建时间戳
 * @returns url         {String}    api
 * @returns labelArr    {Array}     表头字段
 * @returns colWidthArr {Array}     列宽
 * @returns fieldArr    {Array}     数据字段
 * @returns fieldId     {String}    数据主键字段
 * @returns fieldLength {Number}    字段长度
 * @returns $queryForm  {Element}   查询form
 * @returns gcData      {String}    数据容器选择器
 * @returns gcPage      {String}    分页容器选择器
 * @returns operateArr  {Array[]}   行操作数组[[类型,操作名,按钮type,显示条件,api],...] 1: 页面层, 2: iframe层, 3: 询问框
 * @returns operateFilterArr  {Array}     行操作过滤器数组
 */
function getDataSet($el) {
  var obj = {},
    index = $.inArray($el[0], tableList);
  if (index !== -1) {
    // 存储格式 [el0,obj0,el1,obj1,...]
    obj = tableList[index + 1];
  } else {
    obj['now'] = +new Date();  //  创建时间戳
    obj['url'] = $el.data('url');  //  api
    obj['labelArr'] = $el.data('label').split(',');  //  表头字段
    obj['colWidthArr'] = $el.data('colwidth').split(',');  // 列宽
    obj['fieldArr'] = $el.data('field').split(',');  //  数据字段
    obj['fieldId'] = $el.data('id') || 'id'; // 数据主键字段
    obj['minWidth'] = $el.data('minwidth') || ''; // table最小宽度
    obj['save'] = $el.data('save'); // 保存表格数据
    obj['fieldLength'] = obj['fieldArr'].length;  // 字段长度
    obj['$queryForm'] = $($el.data('query')); // 查询form
    obj['gcData'] = '.gcData' + obj['now']; // 数据容器选择器
    obj['gcPage'] = '.gcPage' + obj['now']; // 分页容器选择器
    if ($el.data('operate')) {
      obj['operateArr'] = $el.data('operate').split(','); // 行操作
      obj['operateFilterArr'] = $el.data('operatefilter').split(','); // 行操作过滤器
      $.each(obj['operateArr'], function (i, v) {
        var arr = v.split('|');
        obj['operateArr'][i] = {};
        obj['operateArr'][i]['type'] = arr[0];
        obj['operateArr'][i]['name'] = arr[1];
        obj['operateArr'][i]['class'] = arr[2];
        obj['operateArr'][i]['api'] = arr[3];
        obj['operateArr'][i]['outwidth'] = arr[4];
        obj['operateArr'][i]['filter'] = obj['operateFilterArr'][i];
      });
      obj['labelArr'].push('操作');
      obj['fieldArr'].push('operate');
      obj['colWidthArr'].push(obj['operateArr'].length * 30 + 70);
      obj['fieldLength']++;
    } else {
      obj['operateArr'] = null;
    }
    if ($el.data('check')) {
      obj['labelArr'].unshift('<input type="checkbox">');
      obj['fieldArr'].unshift('checkbox');
      obj['colWidthArr'].unshift(30);
      obj['fieldLength']++;
    }
    tableList.push($el[0], obj);
  }
  return obj;
}

/**
 *
 * @param $el   {Element} 表格jQuery对象
 * @param page  {Number}  请求页码
 */
function getData($el, page) {
  var $data = getDataSet($el),
    symbol = $data.url.indexOf('?') == -1 ? '?' : '&',
    loadIndex = layer.load();
  $.getJSON($data.url + symbol + 'page=' + (page || '1') + '&pageSize=' + ($el.find('[class^=gcPage] select').val() || 10),
    $data.$queryForm.serialize()
  ).done(function (res) {
    var pageHtml = res.page || '暂无分页数据',
      dataHtml = '';
    // 判断是否有数据
    if (res.data.length === 0) {
      dataHtml = '<tr class="bg-white"><td colspan="' + $data.fieldLength + '">暂无数据</td></tr>'
    } else {
      $data.save && (window[$data.save] = res.data);  //全局创建数组，存储新数据
      $.each(res.data, function (i, v) {
        console.log(res.data)
        dataHtml += '<tr class="bg-white" data-id="' + v[$data.fieldId] + '">';
        $.each($data.fieldArr, function (j, field) {
          if (field === 'operate') {
            dataHtml += '<td> <div class="btn-group">' +
              (function () {
                var btnHtml = '';
                $.each($data.operateArr, function (k, btn) {
                  compare(v, $data.operateFilterArr[k]) && (btnHtml += '<button type="button" data-id="' + v[$data.fieldId] + '" data-type="' + btn.type + '" data-api="' + btn.api + '" data-outwidth="' + btn.outwidth + '" class="btn btn-sm btn-' + (btn.class || 'default') + '">' + btn.name + '</button>')
                });
                return btnHtml;
              })() +
              '</div></td>'
          } else if (field === 'checkbox') {
            dataHtml += '<td><input type="checkbox"/></td>';
          } else if (field.indexOf("picture") != -1) {
            dataHtml += '<td><img src="' + eval('v.' + field) + '" onclick="imgMagnify($(this).attr(\'src\'))"></td>'
          } else {
            //dataHtml += '<td>' + v[field] + '</td>'
            dataHtml += '<td>' + eval('v.' + field) + '</td>'
          }
        });
        dataHtml += '</tr>';
      });
    }
    $($data.gcData).html(dataHtml);
    $($data.gcPage).html(pageHtml);
  })
    .fail(function (err) {
      console.log(err)
    })
    .complete(function () {
      layer.close(loadIndex);
    })
}

var indexTr;  //订单管理添加产品的序号
(function ($) {
  $(function () {
    // 遍历gctable
    $('[data-gctable]')
    //  遍渲染表格框架
      .each(function (i, v) {
        tableShow(v);
      });
    $(document)
    //  点击跳页
      .on('click', '[data-gctable] [data-page]', function () {
        getData($(this).closest('[data-gctable]'), $(this).data('page'))
      })
      //  输入跳页
      .on('keyup', '[data-gctable] .page_input', function (e) {
        if (e.keyCode === 13) {
          var $this = $(this),
            $parent = $this.closest('[data-gctable]'),
            page = parseInt($this.val()) || 1,
            max = $this.data('pagenum');
          if (page < 1) {
            $this.val(1);
            getData($parent);
          } else if (page > max) {
            $(this).val(max);
            getData($parent, max);
          } else {
            getData($parent, page);
          }
        }
      })
      // 单击某行
      .on('click', '[data-gctable] .gcBody tr', function () {
        $(this).addClass('bg-active').siblings().removeClass('bg-active');
      })
      // 切换显示条数重新获取数据
      .on('change', '[data-gctable] [class^=gcPage] select', function (e) {
        e.stopPropagation();
        getData($(this).closest('[data-gctable]'))
      })
      .on('click', '[data-type]', function (e) {
        e.stopPropagation();
        var $data = $(this).data();
        if ($data.type === 2) {
          getdetail($(this));
        } else {
          var func = window[getQuery('tp', $data.api)];
          func && func($data)
        }
      })
      //全选
      .on('click', '[data-gctable] thead th input[type=checkbox]', function () {
        $(".gcBody tbody td input[type=checkbox]").prop('checked', $(this).is(':checked'));
      })
  })
})(window.jQuery);

//渲染表格
function tableShow(v) {
  var $data = getDataSet($(v)),
    stageHtml = '';
  // 渲染舞台
  stageHtml += '<div ' + ($data.minWidth && ('style="min-width:calc(' + $data.minWidth + ' - 7px)"')) + '> ' +
    '<table> ' +
    '<colgroup> ' +
    (function () {
      var output = '';
      $.each($data.colWidthArr, function (i, v) {
        output += '<col width="' + Number(v) + '"> ';
      });
      return output;
    })() +
    '</colgroup> ' +
    '<thead> ' +
    '<tr> ' +
    (function () {
      var output = '';
      $.each($data.labelArr, function (i, v) {
        output += '<th>' + v + '</th> ';
      });
      return output;
    })() +
    '</tr> ' +
    '</thead> ' +
    '</table> ' +
    '</div>' +
    '<div class="gcBody" ' + ($data.minWidth && ('style="min-width:' + $data.minWidth + '"')) + '> ' +
    '<table> ' +
    '<colgroup> ' +
    (function () {
      var output = '';
      $.each($data.colWidthArr, function (i, v) {
        output += '<col width="' + Number(v) + '"> ';
      });
      return output;
    })() +
    '</colgroup> ' +
    '<tbody class="gcData' + $data.now + '"> ' +
    '</tbody> ' +
    '</table> ' +
    '</div>' +
    '<p class="gcPage' + $data.now + '"></p>';
  $(v).html(stageHtml);

  // 查询事件
  $data.$queryForm.submit(function (e) {
    e.preventDefault();
    getData($(v));
    return false;
  }).on('reset', function () {
    setTimeout(function () {
      getData($(v));
    }, 0)
  }).submit();
}

//打开增、改、查、审核弹窗
function getdetail(current) {
  console.log(current.data());
  var checkUrl = '',
    cdata = current.data(),
    pid = [],
    apiArr = cdata.api.split('?'),
    outerDiv = getQuery('outer', cdata.api), //最外层容器class
    outerWidth = cdata.outwidth,
    outerTitle = current[0].innerText || current.parent().prev().text(),
    searchStr = getQuery('tp', cdata.api), //判断类型
    df = getQuery('df', cdata.api), //判断是否需保存为草稿
    read = searchStr == 'check' ? 'read/' : ((searchStr == 'add' || searchStr == 'call') ? 'save/' : (searchStr == 'update' ? 'update/' : (searchStr == 'examine' ? 'approve/' : (searchStr == 'ord' ? 'save/0?customer_id=' : '')))),
    post = (searchStr == 'add' || searchStr == 'call'|| searchStr == 'ord') ? '' : '/update/' + cdata.id,
    btn_content = searchStr == 'check' ? [] : (searchStr == 'add' || df == 'y' ? ['保存草稿', '确定'] : ['确定']); //类型为查看、修改、新增
  if (read) {
    checkUrl = '/' + apiArr[0] + '/' + read + cdata.id; //获取查看、修改、新增、审核弹窗
    postUrl = '/' + apiArr[0] + post; //提交url
    $.get(checkUrl, {}, function (str) {
      layer.open({
        type: 1,
        title: outerTitle,
        area: outerWidth,
        offset: '50px',
        btn: btn_content,
        maxmin: true,
        content: str, //注意，如果str是object，那么需要字符拼接。
        success: function () {
          indexTr = $('.otbody>tr').length;
        },
        yes: function (i, stage) {
          if (outerTitle != '审核') {
            $('[name=status]').val(btn_content.length == 2 ? '1' : '2');
          } else {
            $('[name=status]').val($("." + outerDiv + " form .result").val() == '0' ? '3' : '4');
            if ($("." + outerDiv + " form .result").val() == '1') {
              $("." + outerDiv + " form .opinion").attr({
                'data-parsley-required': true,
                'data-parsley-trigger': 'change'
              })
            }
          }
          var flag = validated($("." + outerDiv + " form"));
          console.log('flag:' + flag);
          if (flag && addPro(pid)) {
            var data = $("." + outerDiv + " form").serialize();
            $.post(postUrl, data, function () {
              layer.msg('提交成功', {time: 1000}, function () {
                layer.close(i);
                getData($('[data-gctable]'));
                // location.reload();
              });
            });
          }
        },
        btn2: function (b) {
          $('[name=status]').val('2');
          var flag2 = validated($("." + outerDiv + " form"));
          console.log('flag2:' + flag2);
          if (flag2 && addPro(pid)) {
            var data = $("." + outerDiv + " form").serialize();
            console.log('data:' + data);
            $.post(postUrl, data, function () {
              layer.msg('提交成功', {time: 1000}, function () {
                layer.close(b);
                getData($('[data-gctable]'));
                // location.reload();
              });
            });
          }
          return false;
        },
        end: function () {
        }
      });
    });
  } else {
    //报关文件&&客户管理
    checkUrl = '/' + apiArr[0] + '/' + cdata.id;
    switch (searchStr){
      case 'checkFile':
        postUrl = '/' + apiArr[0].split('/')[0] + '/update/' + cdata.id;
        break;
      case 'allot':
        postUrl = '/' + apiArr[0] + '/' + cdata.id;
        break;
    }
    $.get(checkUrl, {}, function (str) {
      layer.open({
        type: 1,
        title: outerTitle,
        area: outerWidth,
        offset: '100px',
        btn: btn_content,
        content: str, //注意，如果str是object，那么需要字符拼接。
        yes: function (i) {
          var flag = validated($("." + outerDiv + " form"));
          if(flag){
            var data = $("." + outerDiv + " form").serialize();
            $.post(postUrl, data, function () {
              layer.msg('提交成功', {time: 1000}, function () {
                layer.close(i);
                getData($('[data-gctable]'));
              });
            });
          }
        }
      });
    });
  }
}

//删除
function del(data) {
  var post = '/' + data.api.split('?')[0] + '/delete' + '/' + data.id;
  $.post(post, function () {
    layer.msg('删除成功', {time: 1000}, function () {
      getData($('[data-gctable]'));
    });
  });
}

//结案
function over(data) {
  var post = '/' + data.api.split('?')[0] + '/update' + '/' + data.id;
  $.post(post, {status: 5}, function () {
    layer.msg('已结案', {time: 1000}, function () {
      getData($('[data-gctable]'));
    });
  });
}

function getQuery(name, url) {
  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
  var r = url.split('?')[1].match(reg);
  if (r != null)
    return unescape(r[2]);
  return null;
}

//选择客户,开票工厂(发票管理)
$(document).on('click', '[data-select]', function () {
  var ele,
    api = '/' + $(this).data().select + '/choose',
    outerWidth = $(this).data().outwidth,
    $this = $(this),
    outerTitle = $(this).parent().prev().text();
  if ($(this).data().after) {
    $('[name=' + $(this).data().after + ']').val('').prev().val('');
  }
  $.get(api, {}, function (str) {
    var index = layer.open({
      type: 1,
      title: outerTitle,
      area: outerWidth,
      offset: '100px',
      btn: ['确定'],
      content: str,
      yes: function (i) {
        $($this.data('target')).val(ele.find('.bg-active').data('id'));
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

//选择订单号以及自动补全（发票管理）
$(document).on('click', '[data-follow]', function () {
  var ele,
    $this = $(this),
    outerWidth = $this.data().outwidth,
    outerTitle = $this.parent().prev().text();
  //开票工厂与订单号关联
  var company_id = $('[name=' + $(this).data().before + ']').val();
  if (!company_id) {
    layer.msg('请先选择开票工厂！');
    return false;
  } else {
    var api = '/' + $this.data().follow + '/' + company_id + '/choose'
  }
  $.get(api, {}, function (str) {
    var index = layer.open({
      type: 1,
      title: outerTitle,
      area: outerWidth,
      offset: '100px',
      btn: ['确定'],
      content: str,
      yes: function (i) {
        var order_id = ele.find('.bg-active').data('id'),
          bpi = '/clearance/' + order_id;
        $($this.data('target')).val(order_id);
        $this.val(ele.find('.bg-active td').eq(1).html());
        $.each(window['ordList'], function (a, b) {
          if (order_id == b.id) {
            $('#identify_number').val(b.order.drawer_products[0].drawer.tax_id);
          }
        });
        $.get(bpi, {}, function (v) {
          $('.invBody').html('').append(addPTr(v));
        });
        layer.close(i);
      },
      end: function () {
      }
    });
    ele = $('#layui-layer' + index + ' [data-gctable]');
    tableShow(ele);
  })
});

//选择产品（开票人管理&&订单管理&&申报登记）
$(document).on('click', '[data-check]', function () {
  var ele,
    api = '/' + $(this).data().check + '/choose',
    outerWidth = $(this).data().outwidth,
    pclass = $(this).data().content,
    ptbody = $(pclass),
    outerTitle = $(this).parent().prev().text();
  $.get(api, {}, function (str) {
    var index = layer.open({
      type: 1,
      title: outerTitle,
      area: outerWidth,
      offset: '100px',
      btn: ['确定'],
      content: str,
      yes: function (i) {
        ele.find('input:checked').closest('tr').each(function () {
          pclass == '.ptbody' && ptbody.append(addTr(this.dataset.id));
          pclass == '.otbody' && ptbody.append(addOTr(this.dataset.id));
          pclass == '.ftbody' && ptbody.append(addFTr(this.dataset.id));
          pclass == '.pertbody' && ptbody.append(addPETr(this.dataset.id));
          pclass == '.roltbody' && ptbody.append(addPETr(this.dataset.id));
        });
        layer.close(i);
      },
      end: function () {
      }
    });
    ele = $('#layui-layer' + index + ' [data-gctable]');
    tableShow(ele);
  })
});

//查看产品详情(订单管理)
$(document).on('click', '[data-order]', function () {
  var api = '/' + $(this).data().order + '/read/' + $(this).data().id,
    outerWidth = $(this).data().outwidth,
    outerTitle = '产品详情：' + $(this).html();
  $.get(api, {}, function (str) {
    layer.open({
      type: 1,
      title: outerTitle,
      area: outerWidth,
      offset: '100px',
      content: str
    });
  })
});

//将所选产品渲染到页面（开票人管理）
function addTr(v) {
  var html = '';
  console.log(window['proList']);
  $.each(window['proList'], function (a, b) {
    if (v == b.id) {
      console.log(b);
      html += '<tr data-id="' + b.id + '"> ' +
        '<td><img src="' + b.picture + '" onclick="imgMagnify($(this).attr(\'src\'))"></td> ' +
        '<td> ' +
        '<input type="text" value="' + b.name + '" readonly> ' +
        '</td> ' +
        '<td> ' +
        '<input type="text" value="' + b.hscode + '" readonly> ' +
        '</td> ' +
        '<td> ' +
        '<input type="text" value="' + b.brand + '" readonly> ' +
        '</td> ' +
        '<td> ' +
        '<input type="text" value="' + b.standard + '" readonly> ' +
        '</td> ' +
        '<td> ' +
        '<input type="text" value="' + b.package + '" readonly> ' +
        '</td> ' +
        '<td> ' +
        '<input type="text" value="' + b.material + '" readonly> ' +
        '</td> ' +
        '<td> ' +
        '<input type="text" value="' + b.number + '" readonly> ' +
        '</td> ' +
        '<td class="text-center text-danger pbtn deleteBox">删除</td>' +
        '</tr>'
    }
  });
  return html;
}

//将所选产品渲染到页面（订单管理）
function addOTr(v) {
  var html = '';
  console.log(window['proList']);
  $.each(window['proList'], function (a, b) {
    if (v == b.id) {
      console.log(b);
      html += '<tr data-id="' + b.id + '">' +
        '<input type="hidden" name="pro[' + indexTr + '][drawer_product_id]" value="' + b.id + '">' +
        '<td data-id="' + b.product_id + '" data-order="product" data-outwidth="800px">' + b.product.name + '</td>' +
        '<td>' +
        '<input type="text" data-parsley-type="integer" data-parsley-trigger="change" name="pro[' + indexTr + '][number]" class="number text-center">' +
        '</td>' +
        '<td>' +
        '<input type="text" name="pro[' + indexTr + '][unit]" class="text-center">' +
        '</td>' +
        '<td>' +
        '<input type="text" data-parsley-type="number" data-parsley-trigger="change" name="pro[' + indexTr + '][single_price]" class="single_price text-center">' +
        '</td>' +
        '<td>' +
        '<input type="text" class="total_price text-center" readonly>' +
        '</td>' +
        '<td>' +
        '<input type="text" data-parsley-type="integer" data-parsley-trigger="change" name="pro[' + indexTr + '][default_num]" class="default_number text-center">' +
        '</td>' +
        '<td>' +
        '<input type="text" name="pro[' + indexTr + '][legal_unit]" class="text-center">' +
        '</td>' +
        '<td>' +
        '<input type="text" data-parsley-type="number" data-parsley-trigger="change" name="pro[' + indexTr + '][value]" class="text-center default_price">' +
        '</td>' +
        '<td>' +
        '<input type="text" data-parsley-type="number" data-parsley-trigger="change" name="pro[' + indexTr + '][total_weight]" class="total_weight text-center">' +
        '</td>' +
        '<td>' +
        '<input type="text" data-parsley-type="number" data-parsley-trigger="change" name="pro[' + indexTr + '][net_weight]" class="net_weight text-center">' +
        '</td>' +
        '<td>' +
        '<input type="text" data-parsley-type="number" data-parsley-trigger="change" name="pro[' + indexTr + '][volume]" class="text-center">' +
        '</td>' +
        '<td class="text-center text-danger deleteBox">删除</td>' +
        '</tr>';
      indexTr++;
    }
  });
  return html;
}

//将所选发票渲染到页面（申报登记）
function addFTr(v) {
  var html = '';
  console.log(window['invList']);
  $.each(window['invList'], function (a, b) {
    if (v == b.id) {
      console.log(b);
      html += '<tr data-id="' + b.id + '">' +
        '<td>' + b.clearance.order.number + '</td>' +
        '<td>' + b.number + '</td>' +
        '<td>' + b.billed_at + '</td>' +
        '<td>' + b.sum + '</td>' +
        '<td>' + b.received_at + '</td>' +
        '<td class="text-center text-danger deleteBox">删除</td>' +
        '</tr>';
    }
  });
  return html;
}

//选择权限、角色（系统管理）
function addPETr(v) {
  var html = '';
  console.log(window['perList']);
  $.each(window['perList'], function (a, b) {
    if (v == b.id) {
      console.log(b);
      html += '<tr data-id="' + b.id + '">' +
        '<td>' + b.name + '</td>' +
        '<td>' + b.description + '</td>' +
        '<td class="text-center text-danger deleteBox">删除</td>' +
        '</tr>';
    }
  });
  return html;
}

//根据所选订单，将关联产品渲染到页面（发票管理）
function addPTr(v) {
  var html = '', money = 0;
  $.each(v.order.drawer_products, function (a, b) {
    html += '<tr>' +
      '<input type="hidden" name="inv[' + b.id + '][drawer_product_id]" value="' + b.id + '">' +
      '<input type="hidden" name="inv[' + b.id + '][clearance_id]" value="' + v.id + '">' +
      '<td>' + (a + 1) + '</td>' +
      '<td>' + b.product.hscode + '</td>' +
      '<td>' + b.product.name + '</td>' +
      '<td>' + b.pivot.unit + '</td>' +
      '<td>' + b.pivot.number + '</td>' +
      '<td>' +
      '<input type="text" name="inv[' + b.id + '][rate]" data-parsley-type="integer" data-parsley-required data-parsley-trigger="change" placeholder="请填写税率" class="rate text-center">' +
      '</td>' +
      '<td class="single_price"></td>' +
      '<td>' +
      '<input type="text" name="inv[' + b.id + '][amount]" data-parsley-type="integer" data-parsley-required data-parsley-trigger="change" placeholder="请填写数量" class="amount text-center">' +
      '</td>' +
      '<td>' +
      '<input type="text" name="inv[' + b.id + '][price]" data-parsley-type="number" data-parsley-required data-parsley-trigger="change" placeholder="请填写发票金额" class="price text-center">'+
      '</td>' +
      '<td class="rest_amount" data-value="' + (b.pivot.number - (typeof (v.product_count[b.id]) == 'undefined' ? 0 : v.product_count[b.id].amount)) + '">' + (b.pivot.number - (typeof (v.product_count[b.id]) == 'undefined' ? 0 : v.product_count[b.id].amount)) + '</td>' +
      '<td class="gather_price" data-value="' + (typeof (v.product_count[b.id]) == 'undefined' ? 0 : v.product_count[b.id].sum) + '">' + (typeof (v.product_count[b.id]) == 'undefined' ? 0 : v.product_count[b.id].sum) + '</td>' +
      '<td class="text-center text-danger deleteBox">删除</td>' +
      '</tr>';
  });
  return html;
}

//添加产品为必填(开票人管理&&订单管理(货柜、产品)&&申报管理)
function addPro(pid) {
  if ($('.ptbody').length != 0) {
    if ($('.ptbody>tr').length == 0) {
      layer.msg('请添加开票人产品！');
      return false;
    } else {
      $('.ptbody>tr').each(function () {
        pid.push(this.dataset.id);
      });
      $('[name=pid]').val(pid);
    }
    return true;
  } else if ($('.ftbody').length != 0) {
    if ($('.ftbody>tr').length == 0) {
      layer.msg('请添加发票！');
      return false;
    } else {
      $('.ftbody>tr').each(function () {
        pid.push(this.dataset.id);
      });
      $('[name=invoices_id]').val(pid);
    }
    return true;
  } else if ($('.otbody').length != 0) {
    if ($('.otbody>tr').length == 0) {
      layer.msg('请添加需出货产品！');
      return false;
    }
    if ($('.boxBody>tr').length == 0) {
      layer.msg('请添加货柜！');
      return false;
    }
    return true;
  } else if ($('.pertbody').length != 0) {
    if ($('.pertbody>tr').length == 0) {
      layer.msg('请分配权限！');
      return false;
    } else {
      $('.pertbody>tr').each(function () {
        pid.push(this.dataset.id);
      });
      $('[name=permission_id]').val(pid);
    }
    return true;
  }  else if ($('.roltbody').length != 0) {
    if ($('.roltbody>tr').length == 0) {
      layer.msg('请选择角色！');
      return false;
    } else {
      $('.roltbody>tr').each(function () {
        pid.push(this.dataset.id);
      });
      $('[name=role_id]').val(pid);
    }
    return true;
  } else {
    return true;
  }
}

//js 乘法函数 返回值：arg1乘以arg2的精确结果
function accMul(arg1, arg2) {
  var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
  try {
    m += s1.split(".")[1].length
  } catch (e) {
  }
  try {
    m += s2.split(".")[1].length
  } catch (e) {
  }
  return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)
}

//js 除法函数  返回值：arg1除以arg2的精确结果
function accDiv(arg1, arg2, n) {
  var t1 = 0, t2 = 0, r1, r2;
  try {
    t1 = arg1.toString().split(".")[1].length
  } catch (e) {
  }
  try {
    t2 = arg2.toString().split(".")[1].length
  } catch (e) {
  }
  with (Math) {
    r1 = Number(arg1.toString().replace(".", ""));
    r2 = Number(arg2.toString().replace(".", ""));
    return ((r1 / r2) * pow(10, t2 - t1)).toFixed(n);
  }
}

//js 加法计算  返回值：arg1加arg2的精确结果
function accAdd(arg1, arg2, n) {
  var r1, r2, m;
  try {
    r1 = arg1.toString().split(".")[1].length
  } catch (e) {
    r1 = 0
  }
  try {
    r2 = arg2.toString().split(".")[1].length
  } catch (e) {
    r2 = 0
  }
  m = Math.pow(10, Math.max(r1, r2));
  return ((arg1 * m + arg2 * m) / m).toFixed(n);
}

//js 减法计算  返回值：arg1减arg2的精确结果
function accSub(arg1, arg2, a) {
  var r1, r2, m, n;
  try {
    r1 = arg1.toString().split(".")[1].length
  } catch (e) {
    r1 = 0
  }
  try {
    r2 = arg2.toString().split(".")[1].length
  } catch (e) {
    r2 = 0
  }
  m = Math.pow(10, Math.max(r1, r2));
  //动态控制精度长度
  n = (r1 >= r2) ? r1 : r2;
  return ((arg1 * m - arg2 * m) / m).toFixed(a);
}
