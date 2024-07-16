function getOverdue(item) {
    var index  = item.attr("id").replace(/[^0-9.]/g, "");
    var total = current = next = 0;

    var id = item.attr("id");
    var myString = id.split("-").pop();

    if(myString == "paymentdate") {
        fetch = index.concat("-paymentdate");
    } 

    // temp = $("#planledger-"+fetch+"").val();
    const temp = new Date($("#planledger-"+fetch+"").val());
    const startdate = new Date($('#remedialactionplans-startdate').val());
    const diffpaymenttime = (temp.getTime() - startdate.getTime()) / 1000;
    const diffpaymentdays = Math.floor(diffpaymenttime / (60 * 60 * 24));

    if(!isNaN(temp) && temp.length != 0) {
        next = temp;
    }

    current = item.val();
    if(isNaN(current) || current.length == 0) {
        current = 0;
    }

    if(!isNaN(current) && !isNaN(next)) {
        total = diffpaymentdays;
    }

    totalItem = "planledger-".concat(index).concat("-overdue");

    $("#"+totalItem+"").val(total);
}