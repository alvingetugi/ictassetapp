var calculateOverdue = function () {
    const paymentdate = new Date($('#planledger-0-paymentdate').val());
    const startdate = new Date($('#remedialactionplans-startdate').val());
    const diffpaymenttime = (paymentdate.getTime() - startdate.getTime()) / 1000;
    const diffpaymentdays = Math.floor(diffpaymenttime / (60 * 60 * 24));
    const yesoverdue = "Yes";
    const notoverdue = "No";
    var nextdue = (paymentdate.getFullYear()+1)+"-"+(paymentdate.getMonth()+1)+"-"+paymentdate.getDate();      
    
    if(diffpaymentdays > 30) {            
        document.getElementById("planledger-0-overdue").style.color = "red";
        overduemessage = yesoverdue;
        } else {
            document.getElementById("planledger-0-overdue").style.color = "green";
            overduemessage = notoverdue;
                }                        
    $('#planledger-0-overdue').val(overduemessage);
    $('#planledger-0-nextdue').val(nextdue);
};
$(document).on('change', function () {
    calculateOverdue();
});