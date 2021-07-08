/**
 * Theme: Highdmin - Responsive Bootstrap 4 Admin Dashboard
 * Author: Coderthemes
 * Form Pickers
 */
jQuery(document).ready(function () {

    // Date Picker
    jQuery('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    }).val();

    // Date Picker
    jQuery('.datepicker-month').datepicker({
        format: 'yyyy-mm',
        autoclose: true,
		viewMode: 'months', 
		minViewMode: 'months'
    }).val();

});