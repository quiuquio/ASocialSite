<html>
<head>
	<title>Send post result</title>
</head>
<body>

<?php
require_once("helper.php");

ini_set("soap.wsdl_cache_enabled", "0");
try{
    global $wsdl;
    $client = new SoapClient($wsdl, array('trace' => 1));
    $function = "setPost";
    $params = array('postTitle' => $_POST['post_title'], 'postBody' => $_POST['post_body'], 'userID' => $_POST['user_id']);
    $res = $client->__soapCall($function, paramWrapper($params));
    echo "<h2>Invio: " . $res->return . "</h2>";
    //header("location: index.php#postn".$_POST['post_id']);
    include_once("update_xml_call.php");
    header("location: index.php");
} catch (Exception $e) {
	echo $e->getMessage();
}	
?>
</body>
</html>