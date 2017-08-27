$(function () {
    // Cancelled transactions
    $.post( "listb?id="+$('#countryId').val(), function( data ) {
      $( "#accountclient-bankid" ).html( data );
    });
});