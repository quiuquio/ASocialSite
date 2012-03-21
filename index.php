<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="asocial_logo_gallo.jpg" rel="icon" title="Ascl" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>A-Soc!aL</title>
<style type="text/css">
#top_container {
	background-color: rgb(17,17,15);
	position: fixed;
	width: 100%;
	height: 10%;
	top: 0px;
	left: 0px;
	right: 0px;
	font-family: Verdana, Geneva, sans-serif;
	color: rgb(255,255,255);
	font-size: 10px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: rgb(63,189,237);
	z-index:999;
}
#body_container {
	
	position: absolute;
	top:10%;
	height:80%;
	height: auto;
	width: 98%;
	z-index:1;
}
#login {
	position: absolute;
	right: 1em;
	top: 2em;
}
#logo {
	position:absolute;
	left:5em;
}
#main {
	position: relative;
	width: 50%;
	float: left;
	height:100%;
	padding-left:3%;
	padding-right:3%;
}
#left {
	float:left;
	height:100%;
	width: 14%;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: rgb(63,189,237);
	padding-left:2%;
	padding-right:2%;
}
#right {
	position: fixed;
	right:0px;
	top:10%;
	height:100%;
	width: 18%;
	border-left-width: 1px;
	border-left-style: solid;
	border-left-color: rgb(63,189,237);
	padding-right:2%;
	padding-left:2%;
}
#down {
	position: fixed;
	bottom: 0px;
	left: 0px;
	background-color: #000;
	height: 9%;
	width: 100%;
	border-top: 1px solid rgb(63,189,237);
	z-index:999;
		
}
</style>
</head>

<body>
<div id="top_container">
  <div id="logo"><img src="asocial_logo_gallo.jpg" width="150" height="46px" alt="logo" /></div>	
  <div id="login">

  <?php
          function paramWrapper ($parameters){
            //filtra i parametri per farli accettare da SOAP..
            return array('parameters' => $parameters);
        }
        
        
        if((isset($_POST['username']) && isset($_POST['password'])) &&
            $_POST['username'] != "" && $_POST['password'] != ""){
       try{
        $wsdl = "http://127.0.0.1:8080/ASocioalApplication/ASocial?wsdl";
        $client = new SoapClient($wsdl, array('trace' => 1));
        $function = "login";
        $user = $_POST['username'];
        $password = $_POST['password'];
        $params = array('username' =>$user,'password'=>$password);
        $tmp = $client->__soapCall($function, paramWrapper($params));
        $res = $tmp->return; 
        echo "risultato: ".$tmp->return.";<br/>";
        if($res){
            $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['username']));
            echo "WELCOME ".$user."!";
        }
        else{
            echo "Invalid username or password or argument.";
        }
        
        
        } catch (Exception $e){
        echo $e->getMessage();
        }
        }else{
            echo '<form action="index.php" method="post" name="login">
                User:<input name="username" type="text" size="10" maxlength="15" />&nbsp;
                Password:<input name="password" type="password" size="10" maxlength="15" />&nbsp;
                <input name="submit" type="submit" value="log in" />
                </form>';
        }
        
        
        ?>
  
  </div>
</div>

<div id="body_container">

  <div id="left">
  
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies posuere lobortis. Suspendisse potenti. Nunc non imperdiet leo. Donec fermentum purus ac diam mollis quis pulvinar turpis lacinia. Aliquam ut augue augue. Cras non ante vel lectus convallis tincidunt accumsan quis lorem. Vestibulum tempor urna sed nibh semper eget vehicula massa sagittis. Nam sem nibh, lacinia at adipiscing scelerisque, accumsan eu justo. Nullam pulvinar, ligula egestas lobortis hendrerit, arcu dolor faucibus dolor, et accumsan enim dolor ac nibh. Nam id magna velit, in aliquet mauris. Sed facilisis convallis lacinia. Fusce id justo dolor. Duis sem mauris, dictum sit amet interdum at, dapibus ac mauris.

Nullam id nibh nisi. Praesent vel lectus libero. Maecenas consectetur fringilla quam, aliquam aliquam velit posuere id. Sed at nisl ante, id gravida velit. Donec pellentesque enim et mauris placerat quis feugiat nisi vestibulum. Nunc id leo felis. Aliquam sit amet odio in augue vestibulum dignissim. Nunc sit amet enim quis erat accumsan auctor. Cras fringilla, nisi et laoreet porta, felis ipsum pretium libero, eu consequat nunc massa vitae enim. Duis nibh tortor, malesuada vitae commodo at, malesuada et felis. Quisque sed vestibulum dui. Nullam ac mauris nunc. Morbi ut justo ligula, non hendrerit urna.


  
  
  </div>
  <div id="main">
  
  			Content for  id "main" Goes Here
  	Cras enim mauris, convallis consectetur mollis ac, pretium ut metus. Curabitur adipiscing erat at mauris condimentum nec laoreet turpis auctor. Nam euismod ante ac augue suscipit semper. Praesent nunc augue, fermentum quis feugiat non, iaculis a nisl. Cras luctus ipsum in eros faucibus commodo. Donec vehicula leo a tortor imperdiet a tincidunt massa fermentum. Sed luctus pretium sem, eu egestas magna sagittis in. Nam dapibus sem non ligula rutrum bibendum laoreet dui tempor. Morbi mollis, orci sed bibendum laoreet, dolor tortor elementum ipsum, vitae accumsan dolor leo sit amet velit. Fusce in nisi rutrum leo laoreet faucibus ac et lectus.

Maecenas dignissim cursus metus et iaculis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis metus tellus, consequat in pretium sit amet, tempus eu lorem. Quisque mollis feugiat magna, quis consectetur leo laoreet ac. Ut at dictum arcu. Integer posuere luctus varius. Donec quis enim dolor, non ultrices elit. Suspendisse tristique fringilla iaculis. Praesent ornare dui eget sapien lacinia fermentum bibendum turpis ornare. Aliquam erat volutpat. Etiam quam nulla, gravida in consectetur ac, consequat nec risus. Aliquam et mattis ante.

Nam purus ante, varius in rutrum vitae, aliquam nec sem. Nullam lobortis dui eget libero tristique dictum. Nulla facilisi. Aenean neque justo, malesuada mollis fermentum id, viverra sed odio. Suspendisse accumsan varius tortor. Fusce nec lorem non quam volutpat sollicitudin vitae sed risus. Quisque faucibus congue iaculis.
    
  </div>
  <div id="right">Content for id "right" Goes Here. This content is "
fixed".</div>  
</div>

<div id="down">Content for id "down" Goes Here</div>

</body>
</html>