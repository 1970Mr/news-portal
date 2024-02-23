$("#txt-search").keyup(function(){
    var key = $(this).val().trim();
    if(key){
        $(".icon-box, .alert").css("display", "none");
        $(".icon-box .item").each(function(){
            if($(this).text().indexOf(key)>=0){
                $(this).parent().css("display", "block");
            }
        });
        
    }else{
        $(".icon-box, .alert").css("display", "block");
    }
});


$(".icon-box .item").click(function(){
    var text = this;
    var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(text);
    selection.removeAllRanges();
    selection.addRange(range);

    document.execCommand('copy');

    noty({
        text: "کپی شد!",
        type: "success",
        dismissQueue: true,
        layout: "bottomLeft",
        timeout: 5000,
        theme: "flat"
    });
});
