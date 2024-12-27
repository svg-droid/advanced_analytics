
function forgot_password_function(){
	var emailid=$("#txt_forgot_email").val();
	$.ajax( {
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'forgot_password_function_chk=1&emailid='+emailid,
		success : function(result)
		{
			if(result == 1){
				$("#forg_content").html('Check you mail we have sent you an email.');
				$("#forg_title").html("Successful");
				$('#various_1').fancybox().trigger('click');
				return false;
			}else if(result == 0){
				$("#forg_content").html('Some error occured while sending mail, please try again.');
				$("#forg_title").html("Successful");
				$('#various_1').fancybox().trigger('click');
				return false;
			}
		}
	});
}

function closepopup(){
parent.$.fancybox.close();
}

function check_script(id){
	if($("#"+id).val().indexOf('<script>') != '-1'){
		  return 'n';
	}
}

function dateexpired()
{
	alert("Request Date Expired...");
}
function deleteselected(Delete,deletee,pid){
	$.scrollTo(0,500);
	var selected = new Array();
	$("input:checkbox:checked").each(function() {
		selected.push($(this).val());
	});
	if(selected == '')
	{
		$("#fcbox_delete_selected_heading_tag").text('Remove Item');
		$("#message-red").show().fadeOut(7000);
		document.getElementById('err').innerHTML = 'Please select record to '+deletee+'.';
		$(".fcbox_delete_selected_content_btn").html(Delete);
		$("#mailuser").hide();
	}
	else
	{
		$("#fcbox_delete_selected_heading_tag").text('Remove Item');
		$("#fcbox_delete_selected_content_tag").html('Are you sure you want to '+deletee+' this '+pid+''); $(".fcbox_delete_selected_content_btn").attr("onclick","deleteselected_ok('"+selected+"');");
		$(".fcbox_delete_selected_tag").trigger('click');
		$("#mailuser").hide();
		$(".fcbox_delete_selected_content_btn").html(Delete);
	}
}
function deleteselected_ok(selected){
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		data: 'deleselected=1&delete='+selected,
		cache: false,
		success: function(data){
		$("#message-red").hide();
		$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML = /* pid_upper+ */ 'Records deleted successfully.';
		    $(".fcbox_delete_selected_content_btn").html("Delete");
			$("button[data-dismiss='modal']").trigger('click');
			noofrow();
		}
	});
}
function statusactive(Active,active,pid){
	$.scrollTo(0,500);
	var selected = new Array();
	$("input:checkbox:checked").each(function() {
		selected.push($(this).val());
	});
	if(selected == '')
	{
		$("#message-red").show().fadeOut(7000);
		$("#fcbox_delete_selected_heading_tag").text(Active);
		document.getElementById('err').innerHTML = 'Please select record to make a status '+active+'.';
	}
	else
	{
		$("#fcbox_delete_selected_heading_tag").text('Active');
		$("#fcbox_delete_selected_content_tag").html('Are you sure you want to '+active+' this '+pid+'');
		$(".fcbox_delete_selected_content_btn").attr("onclick","statusactive_ok('"+selected+"');");
        $(".fcbox_delete_selected_content_btn").html("Make "+Active);
		$(".fcbox_delete_selected_tag").trigger('click');
	}
}
function statusactive_ok(selected){
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		data: 'statusactive=1&active='+selected,
		cache: false,
		success: function(data)
		{
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML = /* pid_upper+ */ 'Record status changed successfully.';
			$("button[data-dismiss='modal']").trigger('click');
			noofrow();
		}
	});
}
function statusinactive(Inactive,inactive,pid){
	$.scrollTo(0,500);
	var selected = new Array();
	$("input:checkbox:checked").each(function() {
		selected.push($(this).val());
	});
	if(selected == '')
	{
		$("#message-red").show().fadeOut(7000);
		$("#fcbox_delete_selected_heading_tag").text(Inactive);
		document.getElementById('err').innerHTML = 'Please select record to make a status '+inactive+'.';
	}
	else
	{
		$("#fcbox_delete_selected_heading_tag").text('Inactive');
		$("#fcbox_delete_selected_content_tag").html('Are you sure you want to '+inactive+' this '+pid+''); /* +pid_lower+'?'); */
		$(".fcbox_delete_selected_content_btn").attr("onclick","statusinactive_ok('"+selected+"');");
        $(".fcbox_delete_selected_content_btn").html("Make "+Inactive);
		$(".fcbox_delete_selected_tag").trigger('click');
	}
}
function statusinactive_ok(selected){
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		data: 'statusinactive=2&inactive='+selected,
		cache: false,
		success: function(data)
		{
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML = /* pid_upper+ */' Record status changed successfully.';
			$("button[data-dismiss='modal']").trigger('click');
			noofrow();
		}
	});
}

function view(id){
	loader_show();
	$("#fcbox_view_heading_tag").html('<i class = "icon-tag"></i> View Detail');
	$.ajax( {
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data: 'view=1&id='+id,
		success : function(result)
		{
			$("#fcbox_view_content_tag").html(result);
			$("#common").html('View Detail');
			jslbl_trans2('View Detail','common');
			$(".fcbox_view_tag").trigger('click');
			loader_hide();
		}
	});
}

function view_print(id){
	loader_show();
	$("#fcbox_view_heading_tag").html('<i class = "icon-tag"></i> View Detail');
	$.ajax( {
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data: 'view_print=1&id='+id,
		success : function(result)
		{

			//$("#"+show).html(result);
			//loader_hide();
		$("#"+pid).html(result);

			//$("#fcbox_view_content_tag").html(result);
			//$("#common").html('View Detail');
			//jslbl_trans2('View Detail','common');
			//$(".fcbox_view_tag").trigger('click');
			loader_hide();

		}
	});
}


function printDiv() {
	var divName='print_receipt';
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}


function viewResult(id){
	loader_show();
	$("#fcbox_view_heading_tag").html('<i class = "icon-tag"></i> Joined Users List');
	$.ajax( {
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data: 'viewResult=1&id='+id,
		success : function(result)
		{
			$("#fcbox_view_content_tag").html(result);
			$(".fcbox_view_tag").trigger('click');
			loader_hide();
		}
	});
}
function getState(Cid){
	$.ajax({
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data: 'viewState=1&id='+Cid,
		success : function(data){
			$(".1").html(data);
		}
	});
}
function getCity(cityId){
	$.ajax({
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data: 'viewCity=1&id='+cityId,
		success : function(data){
			$(".city_Ajax").html(data);
		}
	});
}
function getMonthly(id){
	loader_show();
	$.ajax({
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'viewMonthly=1&id='+id,
		success : function(data){
			loader_hide();
			$("#my_workout_chart").html(data);
		}
	});
}
function getWeekly(id){
	loader_show();
	$.ajax({
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'viewWeekly=1&id='+id,
		success : function(data){
			loader_hide();
			$("#my_workout_chart").html(data);
		}
	});
}
function getDaily(id){
	loader_show();
	$.ajax({
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'viewDaily=1&id='+id,
		success : function(data){
			loader_hide();
			$("#my_workout_chart").html(data);
		}
	});
}
function getLogOut(){
	var go = 'gettingLogout';
 	$.ajax( {
		url : site_url+'controllers/ajax_controller/logout-ajax-controller.php',
		type : 'post',
		data: 'logout=1&id='+go,
		success : function(){
			window.location.reload();
		}
	});
}
function artist(id){
	$.ajax( {
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data: 'artist=1&id='+id,
		success : function(result)
		{
			$("#view_detail").html(result);
			$("#common").html('AlbumArtist Detail');
			$("#various_1").fancybox().trigger('click');
		}
	});
}
function changeStatus(Id){
	var obj = document.getElementById('status_'+Id).value;
	if (obj.indexOf('Active') != -1)
	{
		$("#h_status").val(Id);
		$("#h_statustype").val('0');
		jslbl_transselect('This will make the ',''+pid_lower+'','inactive.','status_line');
		$("#various_3").fancybox().trigger('click');
	}
	else
	{
		$("#h_status").val(Id);
		$("#h_statustype").val('1');
		jslbl_transselect('This will make the ',''+pid_lower+'','active.','status_line');
		$("#various_3").fancybox().trigger('click');
	}
}
function status_ok()
{
	var Id=$("#h_status").val();
	var statustype=$("#h_statustype").val();
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		data: 'status='+statustype+'&statusid='+Id,
		cache: false,
		success: function(data){
		$("#message-green").show().fadeOut(5000);
		  jslbl_transmessage(''+pid_lower+'',' Record status changed successfully.','succ');
		  if(statustype==1)
		  {
			  $("#status_"+Id).val('Active');
			  $("#d_"+Id).html("<a style='cursor:pointer' title='Active' class='icon-active info-tooltip' onclick='changeStatus("+Id+")'></a>");
		  }
		  else
		  {
			  $("#status_"+Id).val('Inactive');
			  $("#d_"+Id).html("<a style='cursor:pointer' title='Inactive' class='icon-inactive info-tooltip' onclick='changeStatus("+Id+")'></a>");
		  }
		  parent.$.fancybox.close();
		}
	});
}
function deleteuser(id,deletee,pid){
	$("#h_delete").val(id);
	$("#fcbox_delete_content_tag").html('Are you sure you want to '+deletee+' this '+pid+'');
	$("#fcbox_delete_selected_heading_tag").text('Remove Item');
	$(".fcbox_delete_tag").trigger('click');
	$("#mailuser").hide();
		$(".fcbox_delete_selected_content_btn").html("Delete");
}
function delete_ok()
{
	var Id=$("#h_delete").val();
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		data: 'delete=1&id='+Id,
		cache: false,
		scroll:true,
		success: function(data){
			$("button[data-dismiss='modal']").trigger('click');
			$("#mailuser").hide();
			$("#message-green").show().fadeOut(5000);
			$(".fcbox_delete_selected_content_btn").html("Delete");
			document.getElementById('succ').innerHTML = /* pid_upper+ */' Record deleted successfully.';
			noofrow();
		}
	});
}
function status_cancel()
{
	parent.$.fancybox.close();
	$("#message-red").hide();
}
function newdata(){
	//alert('in');
	showviewdiv(0,20,0,0,0,0,0,'asc');
	$("#main_addbutton").show();
	$('#content-table-inner').css("background-color", "#FFFFFF");
	loader_hide();
}
function showviewdiv(prevnext,row,curr_page,searchval,last,first,fieldname,orderby){
$("#h_orderby").val(orderby);
	$.scrollTo(0,500);
	loader_show();
	$.ajax({
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data: 'viewdiv=1&prevnext='+prevnext+'&row='+row+'&curr_page='+curr_page+'&search='+searchval+'&last='+last+'&first='+first+'&fieldname='+fieldname+'&orderby='+orderby,
		success : function( resp ) {
			document.getElementById(pid).style.display = 'block';
			$("#"+pid).html(resp);
			loader_hide();
		}
	});
}
function edit(id,show,lan_id){
	loader_show();
	$("#message-red").hide();
	$("#message-green").hide();
	$.ajax( {
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data: 'edit=1&id='+id+'&lan_id='+lan_id,
		success : function( resp ) {
			$("#"+show).html(resp);
			loader_hide();
		}
	});
}
function editadmin(id,show){
	loader_show();
	$("#message-red").hide();
	$("#message-green").hide();
	$.ajax( {
		url : site_url+'controllers/ajax_controller/common-ajax-controller.php',
		type : 'post',
		data: 'editadmin=1&id='+id,
		success : function( resp ) {
			$("#"+show).html(resp);
			loader_hide();
		}
	});
}
function noofrow(){
	var last = 0;
	var first =0;
	var prevnext = $("#hid_prevnext").val();
	var row =  $("#sel_noofrow").val();
	if($("#hidsearch").val() == ''){
		var searchval = $("#hidsearch").val();
	}else{
		var searchval = 0;
	}

	var curr_page = $("#hid_curr_page").val();
	if($("#hid_fieldname").val() != ''){
		var fieldname = $("#hid_fieldname").val();
	}else{
		var fieldname = 0;
	}
	var orderby=$("#hid_orderby").val();
	showviewdiv(prevnext,row,curr_page,searchval,last,first,fieldname,orderby);
	loader_hide();
}
function noofrow1(){
	var last = 0;
	var first =0;
    var prevnext = $("#hid_prevnext").val();
    var row =  $("#sel_noofrow").val();
	if($("#hidsearch").val() != ''){
		var searchval = $("#hidsearch").val();
	}else{
		var searchval = 0;
	}
   if($("#hid_fieldname").val() != ''){
		var fieldname = $("#hid_fieldname").val();
	 }else{
	    var fieldname = 0;
	 }
	 var orderby=$("#hid_orderby").val();
	showviewdiv(0,row,0,searchval,last,first,fieldname,orderby);
}
function pageprev(){
	var last = 0;
	var first =0;
	var prevnext = $("#hid_prevnext").val();
	var row =  $("#sel_noofrow").val();
	if($("#hidsearch").val() != ''){
		var searchval = $("#hidsearch").val();
	}else{
		var searchval = 0;
	}
	var finalprevnext = parseInt(prevnext)-parseInt(row);
	$("#hid_prevnext").val(finalprevnext);
	var curr_page = $("#hid_curr_page").val();
	var curr_page = parseInt(curr_page)-1;
	if($("#hid_fieldname").val() != ''){
		var fieldname = $("#hid_fieldname").val();
	}else{
		var fieldname = 0;
	}
	var orderby=$("#hid_orderby").val();
	showviewdiv(finalprevnext,row,curr_page,searchval,last,first,fieldname,orderby);
}
function sortingbyfield(fieldname,orderby){
  	var last = 0;
  	var first =0;
  	var row =  $("#sel_noofrow").val();
	if($("#hidsearch").val() != ''){
		var searchval = $("#hidsearch").val();
	}else{
		var searchval = 0;
	}
	showviewdiv(0,row,0,searchval,last,first,fieldname,orderby);
}
function pagenext(){
	var last = 0;
	var first =0;
	var prevnext = $("#hid_prevnext").val();
	var row =  $("#sel_noofrow").val();
	if($("#hidsearch").val() != ''){
		var searchval = $("#hidsearch").val();
	}else{
		var searchval = 0;
	}
	if($("#hid_fieldname").val() != ''){
		var fieldname = $("#hid_fieldname").val();
	}else{
		var fieldname = 0;
	}
	var finalprevnext = parseInt(prevnext)+parseInt(row);
	$("#hid_prevnext").val(finalprevnext);
	var curr_page = $("#hid_curr_page").val();
	var curr_page = parseInt(curr_page)+1;
	var orderby=$("#hid_orderby").val();
	showviewdiv(finalprevnext,row,curr_page,searchval,last,first,fieldname,orderby);
}
function pagelast(totalpage){
	var last = 0;
	var first = 1;
	var row =  $("#sel_noofrow").val();
	if($("#hidsearch").val() != ''){
		var searchval = $("#hidsearch").val();
	}else{
		var searchval = 0;
	}
	if($("#hid_fieldname").val() != ''){
		var fieldname = $("#hid_fieldname").val();
	}else{
		var fieldname = 0;
	}
	var finalprevnext = totalpage;
	var orderby=$("#hid_orderby").val();
	showviewdiv(finalprevnext,row,0,searchval,last,first,fieldname,orderby);
}
function pagefirst(){
	var last = 1;
	var first = 0;
	var row =  $("#sel_noofrow").val();
	if($("#hidsearch").val() != ''){
		var searchval = $("#hidsearch").val();
	}else{
		var searchval = 0;
	}
	if($("#hid_fieldname").val() != ''){
		var fieldname = $("#hid_fieldname").val();
	}else{
		var fieldname = 0;
	}
	var orderby=$("#hid_orderby").val();
	showviewdiv(0,row,0,searchval,last,first,fieldname,orderby);
}
function showadd1(show){

	$("#message-red").hide();
	$("#message-green").hide();
    edit(0,show);
}
function show_search(){
	document.getElementById('search').value = 1;
	$("#various_2").fancybox().trigger('click');
}
function hide(){
	document.getElementById('search').value = 0;
	Popup.hide('search');
}
function show_upload(){
  $("#various_5").fancybox().trigger('click');
  $("#errorfile_uploadcsv").hide();
}
function loader_show(){
	var v = jQuery(document).height();
	var wheight=jQuery(window).height();
	var wheight=parseInt(wheight)/parseInt(2);
	var scrolling = jQuery(window).scrollTop();
	var $marginTop = parseInt(wheight)+parseInt(scrolling)-parseInt(50);

	var v2 = parseInt(v)-parseInt($marginTop);
	jQuery("#div_loader2").css({'margin-top': $marginTop});
	document.getElementById('div_loader').style.height=v+'px';
	jQuery('#div_loader').fadeIn();
}
function loader_hide(){
	jQuery('#div_loader').fadeOut();
}


function common_back(){
	var step1=$("#hid_step1").val();
	var step2=$("#hid_step2").val();
	var step1_1=step1.split("|");
	var step1_2=(step1_1.length-2);
	var new_step1="";
	var i;
	for(i=0;i<step1_2;i++){
		if(new_step1==''){
			new_step1=step1_1[i];
		}else{
			new_step1=new_step1+"|"+step1_1[i];
		}
	}
	var myfunction1=step1_1[step1_2];
	var step2_1=step2.split("|");
	if(step1_1.length==step2_1.length){
		var step2_2=(step2_1.length-2);
		var new_step2="";
		var i;
		for(i=0;i<step2_2;i++){
			if(new_step2==''){
				new_step2=step2_1[i];
			}else{
				new_step2=new_step2+","+step2_1[i];
			}
		}
		var myfunction2=step2_1[step2_2];
	}else if(step1_1.length>parseInt(step2_1.length)+parseInt(1)){
		myfunction2="";
		var new_step2="";
		var i;
		for(i=0;i<step2_1.length;i++){
			if(new_step2==''){
				new_step2=step2_1[i];
			}else{
				new_step2=new_step2+"|"+step2_1[i];
			}
		}
	}else{
		if(step2_1.length==1){
			var new_step2=step2;
			var myfunction2=step2;
		}else{
			var step2_2=(step2_1.length-1);
			var new_step2="";
			var i;
			for(i=0;i<step2_2;i++){
				if(new_step2==''){
					new_step2=step2_1[i];
				}else{
					new_step2=new_step2+"|"+step2_1[i];
				}
			}
			var myfunction2=step2_1[step2_2];
		}
	}
	$("#hid_step1").val(new_step1);
	$("#hid_step2").val(new_step2);
	eval(myfunction1);
	setTimeout(function () {
            eval(myfunction2);
        }, 2000);
}
function change_adminlang(id){
	$.ajax({
		url : site_url+'controllers/ajax_controller/employeemanagement-ajax-controller.php',
		type : 'post',
		data: 'changelang=1&id='+id,
		success : function(result)
		{
                    jslbl_trans_chg_lng('Language has been changed successfully');
		}
	});
}
function jslbl_transerr(lable,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable=1&lable='+lable,
		success : function(result)
		{
			$("#"+title).html(result);
		}
	});
}
function jslbl_transselect(lable,pgid,lable1,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lableselect=1&lable='+lable+'&lable1='+pgid+'&lable2='+lable1,
		success : function(result)
		{
			$("#"+title).html(result);
		}
	});
}
function jslbl_transgnrl(lable,pgid,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable_gnrl=1&lable='+lable+'&lable1='+pgid,
		success : function(result)
		{
			$("#"+title).html(result);
		}
	});
}
function jslbl_transd(lable,pgid,sel,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable_dai=1&lable='+lable+'&lable1='+pgid+'&selid='+sel,
		success : function(result)
		{
			$("#"+title).html(result);
		}
	});
}
function jslbl_transa(lable,pgid,sel,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable_a=1&lable='+lable+'&lable1='+pgid+'&selid='+sel,
		success : function(result)
		{
			$("#"+title).html(result);
		}
	});
}
function jslbl_transi(lable,pgid,sel,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable_i=1&lable='+lable+'&lable1='+pgid+'&selid='+sel,
		success : function(result)
		{
			$("#"+title).html(result);
		}
	});
}
function jslbl_transmessage(pgid,lable,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable_message=1&lable1='+pgid+'&lable='+lable,
		success : function(result)
		{
			$("#"+title).html(result);
		}
	});
}
function jslbl_trans2(lable,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable=1&lable='+lable,
		success : function(result)
		{
			$("#view_detail_15").html(result);
			$("#common_15").html("Dogrulama");
			$('#various_15').fancybox().trigger('click');
		}
	});
}
function jslbl_trans3(lable)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable=1&lable='+lable,
		success : function(result)
		{
			alert(result);
		}
	});
}
function jslbl_transplan(lable,title)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable=1&lable='+lable,
		success : function(result)
		{
			$("#view_detail_15").html(result);
			$("#common_15").html("Dogrulama");
			$('#various_15').fancybox().trigger('click');
		}
	});
}
function jslbl_trans(lable,field){
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable=1&lable='+lable,
		success : function(result)
		{
			$("#error-inner"+field).show().fadeOut(5000);
			$("#error-inner"+field).html(result);
			$("#"+field).focus();
			return false;
		}
	});
}
function jslbl_trans2(lable,id)

{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable=1&lable='+lable,
		success : function(result)
		{
			document.getElementById(id).innerHTML = result;
		}
	});
}
function jslbl_trans3(first,second,third,label)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable=1&lable='+lable,
		success : function(result)
		{
			document.getElementById(id).innerHTML = result;
			$("#"+first).html(result);
			$("#"+second).html(result);
			$("#"+third).fancybox().trigger('click');
		}
	});
}

function jslbl_trans_chg_lng(lable){
	$.ajax({
		url : site_url+'controllers/ajax_controller/lbltrans-ajax-controller.php',
		type : 'post',
		data: 'translate_lable=1&lable='+lable,
		success : function(result)
		{
            window.location.href=site_url+'index.php?pid='+pid;
		}
	});
}
function viewInviteList(id){
	loader_show();
	$("#fcbox_view_heading_tag").html('<i class="icon-tag"></i> Users List');
		$.ajax({
			url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
			type : 'post',
			data: 'viewResult=1&id='+id,
			success : function(result){
				loader_hide();
				$("#fcbox_view_content_tag").html(result);
				$(".fcbox_view_tag").trigger('click');
			}
		});
	}
function getForgotPassword(){
	$.ajax({
		url : 'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'POST',
		data : 'getForgotForm=1',
		success : function(result){
			$("#dyDivForgot").html(result);
		}
	});
}

function getSate(id)
{
	$.ajax({
		url : 'controllers/ajax_controller/city-ajax-controller.php',
		type : 'POST',
		data : 'getState=1&id='+id,
		success : function(result){
			$("#AddState").html(result);
		}
	});
}

function getBannerList(id){

	alert(id); return false;

	$.ajax({
		url : site_url+'controllers/ajax_controller/shopnow-ajax-controller.php',
		type : 'post',
		dataType : "json",
		data: 'getBanner=1&id='+id,
		success : function(data){
			//alert(data);
			$("#addbanner").html(data[0]);
			$("#addbrand").html(data[1]);
		}
	});
  }
function getCollectionList(id)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data : 'getCollection=1&id='+id,
		success : function(data){
			$("#addcategory").html(data);
		}
	});
}
function getCollectionsList(id)
{
	$.ajax({
		url : site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		type : 'post',
		data : 'getCollections=1&id='+id,
		success : function(data){
			$("#AddCat").html(data);
		}
	});
}

function getProductList(id)
{
	$.ajax({
		url : 'controllers/ajax_controller/shopnow-ajax-controller.php',
		type : 'post',
		data : 'getProduct=1&id='+id,
		success : function(data){
			$("#addproduct").html(data);
		}
	});
}

function getBrandList(id)
{
	$.ajax({
		url : 'controllers/ajax_controller/product-ajax-controller.php',
		type : 'post',
		data : 'getBrand=1&id='+id,
		success : function(data){
			$("#brand_name").html(data);
		}
	});
}

function addForgotPassword(){
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;

	if($("#txt_addforemail").val()==''){
		$("#aj_error_content").fadeIn();
		$("#aj_error_content").html('Please enter email address.');
		$("#txt_addforemail").focus();
		$("#aj_error_content").fadeOut(9000);
			return false;
	}else if(emailchk.test($("#txt_addforemail").val())==false){
		$("#aj_error_content").fadeIn();
		$("#aj_error_content").html('Please enter valid email address.');
		$("#txt_addforemail").focus();
		$("#aj_error_content").fadeOut(9000);
			return false;
	} else {
		var getEmail=$("#txt_addforemail").val();
		$.ajax({
			url : 'controllers/ajax_controller/comman-ajax-controller.php',
			type : 'POST',
			data : 'forgotVal=1&email='+getEmail,
			success : function(resp){
				if(resp==0){
					$("#aj_error_content").fadeIn();
					$("#aj_error_finc").fadeIn();
					$("#aj_error_finc").html('Note : Your can have maximum limit of 3 attempts only.');
					$("#aj_error_content").html('Email does not exists in system.');
					$("#aj_error_content").fadeOut(6000);
						return false;
				}else if(resp==1){
					$("#aj_error_content").css('color','green');
					$("#aj_error_content").show();
					$("#aj_error_finc").fadeOut();
					$("#aj_error_content").html('Password reset successfully. Please check your e-mail.');
					setInterval(function(){ window.location.reload(); }, 2500);
				}else if(resp==2){
					$("#aj_error_content").fadeIn();
					$("#aj_error_content").html('You have attepmt your maximum try. please try again after 24 hours.');
					$("#aj_error_content").fadeOut(6000);
						return false;
				}else if(resp==3){
					$("#aj_error_content").fadeIn();
					$("#aj_error_content").html('Please try again after 24 hours.');
					$("#aj_error_content").fadeOut(6000);
						return false;
				}
			}
		});
		return false;
	}
}
function getCancel(){
	window.location.href='./';
}
function getBack(rid){
	window.location.href='index.php?pid='+rid;
}
function checked(id){

	$('input.chk').on('change', function() {
    $('input.chk').not(this).prop('checked', false);
});


}

function iscontactNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 43 || charCode == 44 || charCode == 45 )
		{
		return true;
		}
		else if (charCode > 31 && charCode < 48 || charCode > 57)
		{
			return false;
		}else {
		return true;
		}
	}
/*----------PAYMENT STATUS -----------------------*/


function pending(Pending,pending,pid){
	$.scrollTo(0,500);
	var selected = new Array();
	$("input:checkbox:checked").each(function() {
		selected.push($(this).val());
	});
	if(selected == '')
	{
		$("#message-red").show().fadeOut(7000);
		$("#fcbox_delete_selected_heading_tag").text(Pending);
		document.getElementById('err').innerHTML = 'Please select record to make a status '+pending+'.';
	}
	else
	{
		$("#fcbox_delete_selected_heading_tag").text('Pending');
		$("#fcbox_delete_selected_content_tag").html('Are you sure you want to '+pending+' this '+pid+'');
		$(".fcbox_delete_selected_content_btn").attr("onclick","pending_ok('"+selected+"');");
        $(".fcbox_delete_selected_content_btn").html("Make "+Pending);
		$(".fcbox_delete_selected_tag").trigger('click');
	}
}
function pending_ok(selected){
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		data: 'pending=1&pending='+selected,
		cache: false,
		success: function(data)
		{
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML = /* pid_upper+ */ 'Record status changed successfully.';
			$("button[data-dismiss='modal']").trigger('click');
			noofrow();
		}
	});
}

function inprogress(Inprocess,inprogress,pid){
	$.scrollTo(0,500);
	var selected = new Array();
	$("input:checkbox:checked").each(function() {
		selected.push($(this).val());
	});
	if(selected == '')
	{
		$("#message-red").show().fadeOut(7000);
		$("#fcbox_delete_selected_heading_tag").text(Inprocess);
		document.getElementById('err').innerHTML = 'Please select record to make a status '+inprogress+'.';
	}
	else
	{
		$("#fcbox_delete_selected_heading_tag").text('Inprogress');
		$("#fcbox_delete_selected_content_tag").html('Are you sure you want to inprocess this '+pid+'');
		$(".fcbox_delete_selected_content_btn").attr("onclick","inprogress_ok('"+selected+"');");
        $(".fcbox_delete_selected_content_btn").html("Make Inprocess");
		$(".fcbox_delete_selected_tag").trigger('click');
	}
}
function inprogress_ok(selected){
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		data: 'inprogress=1&inprogress='+selected,
		cache: false,
		success: function(data)
		{
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML = /* pid_upper+ */ 'Record status changed successfully.';
			$("button[data-dismiss='modal']").trigger('click');
			noofrow();
		}
	});
}



function delivered(Delivered,delivered,pid){
	$.scrollTo(0,500);
	var selected = new Array();
	$("input:checkbox:checked").each(function() {
		selected.push($(this).val());
	});
	if(selected == '')
	{
		$("#message-red").show().fadeOut(7000);
		$("#fcbox_delete_selected_heading_tag").text(Delivered);
		document.getElementById('err').innerHTML = 'Please select record to make a status '+delivered+'.';
	}
	else
	{
		$("#fcbox_delete_selected_heading_tag").text('Inprogress');
		$("#fcbox_delete_selected_content_tag").html('Are you sure you want to '+delivered+' this '+pid+'');
		$(".fcbox_delete_selected_content_btn").attr("onclick","delivered_ok('"+selected+"');");
        $(".fcbox_delete_selected_content_btn").html("Make "+Delivered);
		$(".fcbox_delete_selected_tag").trigger('click');
	}
}
function delivered_ok(selected){
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/'+pid+'-ajax-controller.php',
		data: 'delivered=1&delivered='+selected,
		cache: false,
		success: function(data)
		{
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);
			document.getElementById('succ').innerHTML = /* pid_upper+ */ 'Record status changed successfully.';
			$("button[data-dismiss='modal']").trigger('click');
			noofrow();
		}
	});
}

function exportdataMember(){
	$.ajax({
		type: "POST",
		url: site_url+'controllers/ajax_controller/exportmember-ajax-controller.php',
		data: 'his_export=1',
		cache: false,
		success: function(data)
		{
			window.location.href=site_url+'controllers/ajax_controller/export-user.csv';
		}
	});
}
