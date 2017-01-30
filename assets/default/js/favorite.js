
    function doLike(videoId,type){
        $.post(site_url+'store-likes'
            ,{videoId:videoId,type:type}, function(data){
               // console.log(videoId);
                $('#'+videoId+'_'+type+'s').html(data);
            });
    }



    function doUnLike(videoId,type){
        $.post(site_url+'store-unlikes'
            ,{videoId:videoId,type:type}, function(data){
                $('#'+videoId+'_un'+type+'s').html(data);
            });
    }


$(document).ready(function(){
    $('#doo-like').click(function() {
        location.reload();
    });
});
