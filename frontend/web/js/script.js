$(function () {
    // Cancelled transactions
    $.post( "listb?id="+$('#countryId').val(), function( data ) {
      $( "#accountclient-bankid" ).html( data );
    });
    
    $('#form-calculator-button').on('click', function () {
        var url = $(this).attr('url');
        var amount = $('#amount').val();
        var currencyIdFrom = $('#currencyIdFrom').val();
        var currencyIdTo = $('#currencyIdTo').val();

        $.ajax({
            url: url,
            type: 'post',
            data: {
                amount: amount,
                currencyIdFrom: currencyIdFrom,
                currencyIdTo: currencyIdTo,
                _csrf: yii.getCsrfToken()
            },
            success: function (data) {
                $('#result').html(data);
            }

        });
    })
});