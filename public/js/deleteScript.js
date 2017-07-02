$(".delete-btn").click(function(){
    var reply=confirm("Are you sure you want to delete this?");
    if(reply == 1){

    }else{
        event.preventDefault();
    }
});
