$(function () {

    // Switchery
    var switchery;
    var elems;

    // Initialize multiple switches
    if (Array.prototype.forEach) {
        elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        elems.forEach(function(html) {
            switchery = new Switchery(html);
        });
    }
    else {
        elems = document.querySelectorAll('.switchery');
        for (var i = 0; i < elems.length; i++) {
            switchery = new Switchery(elems[i]);
        }
    }

    // Colored switches
    // var primary = document.querySelector('.switchery-primary');
    // switchery = new Switchery(primary, { color: '#2196F3' });

    // Bootstrap switch

    $(".switch").bootstrapSwitch();
    
    // Cancelled transactions
    var val = $('#transaction-status').val();
    if(val == 1) {
      $('.hideField').hide();
    }
    else {
      $('.hideField').show();
    }
    
    // Modal  behavior for showing the transaction receipt
    $("#modalButton").click(function(){
        var options = {
            title: 'Recibo de Transacción #'+$(this).attr('t'),
            text: '<img width="700" src="'+$(this).attr('route')+'">',
            html: true,
            customClass: 'modal-lg',
        };
        swal(options);
    });
});

function listenerChangeStatus(){

    $(".switchStatus").change(function(){
        $.ajax({
            url: 'status',
            type: 'post',
            data: {
                id: $(this).attr("id").replace(/status-/g, ''),
                _csrf : $(this).attr("_csrf")
            }
        });
    });
}

// Change the client's blocked value
function listenerChangeBlocked(){

    $(".switchBlocked").change(function(){
        $.ajax({
            url: 'blocked',
            type: 'post',
            data: {
                id: $(this).attr("id").replace(/blocked-/g, '')
            }
        });
    });
}

// Change the exchange rate status
function listenerChangeStatusER(){

    $(".switchStatusER").change(function(){
        $.ajax({
            url: 'status',
            type: 'post',
            data: {
                id: $(this).attr("id").replace(/status-/g, '')
            }
        });
    });
}

function hideFields(){

    $("#transaction-status").change(function(){
        var val = $('#transaction-status').val();
        
        // Cancelled transaction
        if(val == 1) {
          $('.hideField').hide();
        }
        else {
          $('.hideField').show();
        }
    });
}