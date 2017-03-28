$( document ).ready(function() {


    $( 'input[type="radio"]' ).on( "click", function() {
        $('input[name="flyer_size"]').parent().removeClass('checked');
        $(this).parent().addClass('checked');
    });

    $( 'input[type=checkbox]' ).on( "click", function() {

        $('input[type=checkbox]').parent().removeClass('checked');
        $('input[type=checkbox]:checked').parent().addClass('checked');
    });

});



