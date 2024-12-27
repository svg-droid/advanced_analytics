function filterRecord() {

	//alert("hello"); 
	 var country_id = $('#country_id').val();
	 
	// var paidStatus = $('#paidStatus').val();
	 
	
//alert(country_id);
	  if(country_id == ''){
		$("#erorrdpd2").fadeIn(2000);

		 $("#erorrdpd2").html('Select Country');

		 $("#erorrdpd2").fadeOut(2000);

		 return false;
	 
	 } else {

		 $("#tbl_data_display").dataTable().fnDestroy();

		 $('#tbl_data_display').dataTable({

			  "bProcessing": true,
                            "bServerSide": true,
                            "aoColumnDefs": [{
                                'bSortable': false,
                                'aTargets': [0, 6,7]
                            }],
                            "aaSorting": [
                                [0, "desc"]
                            ],

			 "sAjaxSource": site_url + 'controllers/ajax_controller/report-ajax-controller.php?action=filterRecord&country_id='+country_id,

		 });



	 }



}