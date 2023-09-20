    //Put the function on top of the single execution construct
    var calculateDepreciation = function () {
        var purchaseStr = parseInt($('#purchase_value').val());
        var purchasevalue = isNaN(purchaseStr) ? 0 : purchaseStr;
        var currentvalue = purchasevalue * 5;
        $('#current_value').val(currentvalue);
    };
    //Now go ahead do catch the keyup events
    $(document).on('keypress', '#current_value', function () {
        calculateDepreciation();
    });on('keypress', '#purchase_value', function () {
        calculateDepreciation();
    });