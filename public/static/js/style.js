/**
 * 主题上传功能
 */
$(function() {
    $('#file_upload_sty').uploadify({
        'swf'      : SCOPE.ajax_upload_swf,
        'uploader' : SCOPE.ajax_upload_style_url,
        'buttonText': '上传Css文件',
        'fileTypeDesc': 'All Files',
        'fileObjName' : 'file',
        //允许上传的文件后缀
        'fileTypeExts': '*.css',
        'onUploadSuccess' : function(file,data,response) {
            // response true ,false
            if(response) {
                var obj = JSON.parse(data); //由JSON字符串转换为JSON对象
                $('#' + file.id).find('.data').html(' 上传完毕');

                $("#style_address").html(obj.address);
                $("#file_upload_style").attr('value',obj.address);
            }else{
                alert('上传失败');
            }
        },
    });
});





