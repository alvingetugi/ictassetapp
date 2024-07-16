function getNextdue(item) {
    var index  = item.attr("id").replace(/[^0-9.]/g, "");
    var total = current = next = 0;

    var id = item.attr("id");
    var myString = id.split("-").pop();

    if(myString == "paymentdate") {
        fetch = index.concat("-paymentdate");
    } 

    // temp = $("#planledger-"+fetch+"").val();
    const temp = new Date($("#planledger-"+fetch+"").val());
    const nextdue = (temp.getFullYear()+1)+"-"+(temp.getMonth()+1)+"-"+temp.getDate(); 

    if(!isNaN(temp) && temp.length != 0) {
        next = temp;
    }

    current = item.val();
    if(isNaN(current) || current.length == 0) {
        current = 0;
    }

    if(!isNaN(current) && !isNaN(next)) {
        total = nextdue;
    }

    totalItem = "planledger-".concat(index).concat("-nextdue");

    $("#"+totalItem+"").val(total);
}