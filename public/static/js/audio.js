$('#audio').click(function(){
    var id=$(this).attr('attr-id');
    getsound(id);
});
function getsound(id){
    var data={};
    data['place_id']=id;
    var url="/erciyuan/public/index.php/index/sound/getsound"
    $.post(url,data,function(result){
        if(result&&result!='') {
            var sound=new Audio(result);
            sound.play();
        }
    },"JSON");
}
$("#loginout").click(function(){
    var url="/erciyuan/public/index.php/index/login/loginout";
    $.post(url,[],function(result){
        if(result.status==1) {
            dialog.success(result.message,result['jump_url']);
            getsound(4);
        }else{
            dialog.error(result.message);
        }
    },'JSON');
});
$('.widget-container #change-style').click(function(){
    var id=$(this).attr('attr-id');
    var data={};
    data['id']=id;
    var url="/erciyuan/public/index.php/index/sound/updateStyle"
    $.post(url,data,function(result){
        if(result.status==1) {
            document.getElementById('style-address').setAttribute("href",result.address);
            document.getElementById('audio').src=result.thumb;
            getsound(2);//切换主题声音
        }else{
            dialog.error(result.message);
        }
    },"JSON");
});