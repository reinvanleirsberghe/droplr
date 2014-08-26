function showErrors(errors){
    // show errors in alert-ajax
    $('.alert-ajax').show();
    $.each(errors, function(index, error){
        $('.alert-ajax').find('ul').append('<li>' + error + '</li>');
    });
}