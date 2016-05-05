
<html>

<head>
	<title>Link Checker 5000</title>	
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">


<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>
  <body style="background-color: #606D80">  


  <div class="container">
<br>
<div class="jumbotron">
<h2 class="text-muted"> <span class="glyphicon glyphicon-eye-open"></span> Link Checker 5000</h2>
<form action="<?php $_PHP_SELF?>" class="form-inline" method="POST" >
<button class="btn btn-lg btn-success pull-right" type="submit" name="submit" value="submit" label="Check Links">Check Links</button>
	<textarea name="linkpaste" rows="5" cols="100"></textarea>
<br>
	<p>Why click the links when the computer can click for you? </p>
</form>

<?php
 $linkpaste = Null;
 $upcount = Null;
 $downcount = Null;
 if( isset($_POST['submit'])) {

	if (strlen($_POST['linkpaste'])==0) {
 		 echo 'no input';
 		 exit; }
   
  	$linkpaste = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", ($_POST['linkpaste']));
   	$yee= str_replace("\r", "", $linkpaste);
    $linkarray = explode("\n",$yee);

function get_http_response_code($url) {
	echo $url;
		    $workingheaders = get_headers($url);
		  if ($workingheaders !=null)
		    return substr($workingheaders[0], 9, 3);
		
}

?><ul id="all-links" style="list-style:none;margin-left:-40px;"><?php
	foreach ($linkarray as $i) {
  		$thelink =  $i;


		$url = $thelink;
		$code = FALSE;


		$code = get_http_response_code($url);
	 if ($code != null)
		  if ($code == 200){
		     $color = "green";
		 	 $alertcolor = "success";
		 	 $upcount++;}
		  else if ($code == 404){
		     $color = "red";
		 	 $alertcolor = "danger";
		     $downcount++;}
		  else
		  {	
		  	$color = "black";
		  	$code = "000";
		    $alertcolor = "warning";
		  }

		
		echo "<li class='alert alert-$alertcolor' style='color:$color'>
		<strong>Status code: $code </strong>: <a class='alert-link' href="."$url>$url"."</a></li>";
		$code = null;
	}
	echo "<div id='headcount' style='width:100px;'>
			<span class='glyphicon glyphicon-arrow-up'></span>$upcount
			<span class='glyphicon glyphicon-arrow-down'></span>$downcount</div>";
}
?>
</ul>
<script>
$(function() {
    $.fn.sortList = function() {
    var mylist = $(this);
    var listitems = $('li', mylist).get();
    listitems.sort(function(a, b) {
        var compA = $(a).text().toUpperCase();
        var compB = $(b).text().toUpperCase();
        return (compA < compB) ? -1 : 1;
    });
    $.each(listitems, function(i, itm) {
        mylist.append(itm);
    });
   }

    $("ul#all-links").sortList();


});</script>
</body>
</html>