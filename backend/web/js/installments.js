var calculateInstallments = function () {
    var deficitStr = parseInt($('#remedialactionplans-deficit').val());
    var deficitvalue = isNaN(deficitStr) ? 0 : deficitStr;
    const startdate = new Date($('#remedialactionplans-startdate').val());
    const enddate = new Date($('#remedialactionplans-enddate').val());
    const diffTime = (enddate.getTime() - startdate.getTime()) / 1000;
    const diffDays = Math.floor(diffTime / (60 * 60 * 24));
    const diffYears = Math.round(diffDays / 365.25);
    var duration = diffYears;
    
    if(deficitvalue > 0) {
        document.getElementById("remedialactionplans-deficit").style.color = "red";
        installments = deficitvalue/duration;
        } else {
            document.getElementById("remedialactionplans-deficit").style.color = "green";
            installments = 0;
                }
                    
    $('#remedialactionplans-installments').val(installments);
    $('#remedialactionplans-duration').val(duration);
};
$(document).on('change', function () {
    calculateInstallments();
});
