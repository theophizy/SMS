// JavaScript Document
$(document).ready(function() {
 	 $("#responsecontainer").load("cht.php");
   var refreshId = setInterval(function() {
      $("#responsecontainer").load('response.php?randval='+ Math.random());
   }, 9000);
   $.ajaxSetup({ cache: false });
});
