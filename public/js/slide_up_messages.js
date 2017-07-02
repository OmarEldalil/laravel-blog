/**
 * Created by Omar on 21/04/2017.
 */
if(($(".closeMessage").length)){
    $(".closeMessage").click(function(){
        $("div.alert").slideUp();
    });
}else{
    $('div.alert').delay(3000).slideUp();
}
