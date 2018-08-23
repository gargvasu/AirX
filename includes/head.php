<!-- Website head placed here -->
    
<head>

    <meta charset="utf-8">

    <title><?php if (isset($title)) {echo $title;}
        else {echo "AirX Airlines";} ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="AirX is Flight Booking System">
  <meta name="keywords" content="Flight,Air Ticket,AirX,Booking,Online">
  <meta name="author" content="Vasu Garg">
    <link rel="stylesheet" href="./vendor/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="./vendor/css/bootswatch.min.css">
	
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118294394-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118294394-1');
</script>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
    <script src="./vendor/js/bootstrap.min.js"></script>
    <script src="./vendor/js/bootswatch.js"></script>

    <script type="text/javascript">
               	$(document).ready(function(){
					
               	     $("#departure_date").datepicker({
          					     maxDate: 30,
          					     minDate: 0,
          					     dateFormat:"dd-mm-yy"
          					  });
							  //$("#departure_date").datepicker().datepicker("setDate", new Date());
                      $("#return_date").datepicker({
          					     maxDate: 30,
          					     minDate: 1,
          					     dateFormat:"dd-mm-yy"
          					  });
                });
               	function setReadOnly(obj){
				   if(obj.value == "oneway"){
				     $('#departure_date').datepicker('enable');
				     $('#return_date').datepicker('disable');
				   } 
				   else {
				     $('#departure_date').datepicker('enable');
				     $('#return_date').datepicker('enable');
				   }
				}
          $(function() {
            var airports = [
            "Chennai MAA","Delhi DEL","Kolkata CCU","Mumbai BOM","Bengaluru BLR","Hyderabad HYD","Kochi COK","Pune PNQ","Goa GOI","Amritsar ATQ","Chandigarh IXC"
            ];
            $( "#from_city" ).autocomplete({
            source: airports
            });
          });
          $(function() {
            var airports = [
            "Chennai MAA","Delhi DEL","Kolkata CCU","Mumbai BOM","Bengaluru BLR","Hyderabad HYD","Kochi COK","Pune PNQ","Goa GOI","Amritsar ATQ","Chandigarh IXC"
            ];
			
            $( "#to_city" ).autocomplete({
            source: airports
            });
					
          });
	
       </script>
       
</head>
