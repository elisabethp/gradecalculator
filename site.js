$(document).ready(function(){
    
    var thisElem = 0;

    function addField() {
        if (thisElem < $(".hidden").length) {
            $(".hidden").eq(thisElem).css("display", "inline-block");
            //$(".hidden").eq(thisElem).show();
            thisElem++;
        }
    }

    $("#add-button").click(addField);
    
});