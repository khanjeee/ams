/*@Description:Custom javascript */
jQuery(document).ready( function() {
    jQuery( "#datepicker" ).datepicker({
    	dateFormat: 'yy-mm-dd',
		autoclose: true
    }).attr('readonly','readonly');
	/*jQuery("#formID").validationEngine();*/
});