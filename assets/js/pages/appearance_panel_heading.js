/* ------------------------------------------------------------------------------
*
*  # Panel heading elements
*
*  Specific JS code additions for appearance_panel_heading.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Sliders
    // -------------------------

    // jQuery UI slider
    $( ".ui-slider" ).slider({
        range: true,
        min: 0,
        max: 60,
        values: [ 10, 50 ]
    });


   



    // Selects
    // -------------------------

    // SelectBoxIt dropdowns
    $(".selectbox").selectBoxIt({
        autoWidth: false 
    });


    // Bootstrap select
    $('.bootstrap-select').selectpicker();


    // Select2 selects
    $('.select').select2({
        minimumResultsForSearch: "-1",
        width: 200
    });


    // Multiselect
    $('.multiselect').multiselect({
        dropRight: true,
        onChange: function(option, checked, select) {
            $.uniform.update();
        }
    });



    // Form components
    // -------------------------

    // Touchspin spinners
    $(".touchspin-postfix").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        postfix: '%'
    });


    // Switchery toggles
    if (Array.prototype.forEach) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
    else {
        var elems = document.querySelectorAll('.switchery');

        for (var i = 0; i < elems.length; i++) {
            var switchery = new Switchery(elems[i]);
        }
    }

    // Bootstrap switches
    $(".switch").bootstrapSwitch();


    // Checkboxes and radios
    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });


    // Single file uploader
    $('.file-styled').uniform({
        fileButtonHtml: '<i class="icon-googleplus5"></i>',
        wrapperClass: 'bg-file-icon'
    });



    // Other components
    // -------------------------

    // jQuery UI Sortable
    $(".sortable").sortable({
        connectWith: '.sortable',
        items: '.panel',
        helper: 'original',
        cursor: 'move',
        handle: '[data-action=move]',
        revert: 100,
        forceHelperSize: true,
        placeholder: 'sortable-placeholder',
        forcePlaceholderSize: true,
        tolerance: 'pointer',
        start: function(e, ui){
            ui.placeholder.height(ui.item.outerHeight());
        }
    });

});
