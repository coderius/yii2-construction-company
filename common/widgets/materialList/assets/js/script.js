 $('.linkbox-elem').on('click', function(e){
        var link = $(this).attr("data-link");
        window.location.assign(link);
        
});  
     
var setMaxHeigt = function(elem){
    var mHeight = 0;
    elem.each(function(index,element){
        if ($(this).height() > mHeight) {
            mHeight = $(this).height(); 
        }
    });
    
    return elem.css({'min-height' : mHeight});
}


setMaxHeigt($('.linkbox-elem-title')); 
setMaxHeigt($('.linkbox-elem-img')); 
//setMaxHeigt($('.linkbox-elem-header img')); 