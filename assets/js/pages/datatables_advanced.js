/* ------------------------------------------------------------------------------
*
*  # Advanced datatables
*
*  Specific JS code additions for datatable_advanced.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': '<i class="fa fa-step-backward"></i>', 'last': '<i class="fa fa-step-forward"></i>', 'next': '<i class="fa fa-forward"></i>', 'previous': '<i class="fa fa-backward"></i>'}
        },
    });


	$.fn.DataTable.ext.pager.numbers_length = 5;
    
	// Highlighting rows and columns on mouseover
    var lastIdx = null;
    var table = $('.datatable-highlight').DataTable({
        "pagingType": "full_numbers",
		
        dom: 'Blfrtip',
		buttons: [
			 {
                text: '<i class="fa fa-file-o"></i> Import',
                action: function ( e, dt, node, config ) {
                   
                }
            },
			{
                text: '<i class="fa fa-file-excel-o"></i> Export',
                action: function ( e, dt, node, config ) {
                   
                }
            },
            {
                text: '<i class="fa fa-file-o"></i> Import',
                action: function ( e, dt, node, config ) {
                   
                }
            },
			{
                text: '<i class="fa fa-file-excel-o"></i> Export',
                action: function ( e, dt, node, config ) {
                   
                }
            },
			
			
        ],
	});
	
     
    $('.datatable-highlight tbody').on('mouseover', 'td', function() {
        var colIdx = table.cell(this).index().column;

        if (colIdx !== lastIdx) {
            $(table.cells().nodes()).removeClass('active');
            $(table.column(colIdx).nodes()).addClass('active');
        }
    }).on('mouseleave', function() {
        $(table.cells().nodes()).removeClass('active');
    });


    // Columns rendering
    $('.datatable-columns').dataTable({
        columnDefs: [ 
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                render: function (data, type, row) {
                    return data +' ('+ row[3]+')';
                },
                targets: 0
            },
            { visible: false, targets: [ 3 ] }
        ]
    });



    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: "-1"
    });
    
	
});
