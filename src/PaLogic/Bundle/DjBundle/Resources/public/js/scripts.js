$(document).ready(function(){
    
    /*initialize image-pickers*/
    $(".image-picker").imagepicker({
        hide_select: false
    });
    
    /*make a nice image-grid*/
    $('.image_picker_selector').masonry({
        itemSelector: '.thumbnail',
        gutter: 10
    });
    $('.image_picker_selector').imagesLoaded( function() {
        $(this).masonry({
            itemSelector: '.thumbnail',
            gutter: 10
        });
    });

    /*Autocomplete*/
    function split(val) {
        return val.split( /,\s*/ );
    }

    function extractLast(term) {
        return split(term).pop();
    }

    $("#palogic_bundle_djbundle_dj_genres").autocomplete({
        source: function( request, response ) {
            $.getJSON( Routing.generate('pa_logic_dj_genres') , {
                term: extractLast( request.term )
            }, response );
        },
        search: function() {
            // custom minLength
            var term = extractLast( this.value );
            if ( term.length < 1 ) {
                return false;
            }
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
        }
    });
});
