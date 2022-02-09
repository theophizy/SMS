displayTable();
 $("#armid").change(function(){
     
       var getarmid= $("#armid").val();
        var getclassid= $("#classid").val();

		 $.ajax({
			 url:"load.php",
			 type:"POST",
			 async:false,
			 data:{
				 "transferresult":1,
				 "armid":getarmid,
				  "classid":getclassid,
				
				
				
			 },
			 success: function(bronze){
				 $('#displayselectefield').html(data);
			 }
		 });
    });
	function displayTable(){
$.ajax({
	url:"load.php",
	type:"POST",
	async:false,
data:{
	"nochanges":1
},
success:function(datum){
		$('#displayselectefield').html(datum);	
}
});
}