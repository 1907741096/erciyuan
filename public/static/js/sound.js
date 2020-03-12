/**
 * 主题上传功能
 */
$(function() {
    $('#file_upload').uploadify({
        'swf'      : SCOPE.ajax_upload_swf,
        'uploader' : SCOPE.ajax_upload_image_url,
        'buttonText': '上传音频',
        'fileTypeDesc': 'All Files',
        'fileObjName' : 'file',
        //允许上传的文件后缀
        'fileTypeExts': '*.mp3; *.ogg',
        'onUploadSuccess' : function(file,data,response) {
            // response true ,false
            if(response) {
                var obj = JSON.parse(data); //由JSON字符串转换为JSON对象
                $('#' + file.id).find('.data').html(' 上传完毕');

                $("#sound_address").html(obj.address);
                $("#file_upload_image").attr('value',obj.address);
            }else{
                alert('上传失败');
            }
        },
    });
});





