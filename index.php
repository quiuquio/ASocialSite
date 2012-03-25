<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="asocial_icon.png" rel="icon" title="Ascl" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>A-Soc!aL</title>
<style type="text/css">
#top_container {
	background-color: rgb(17,17,15);
	position: fixed;
	width: 100%;
	height: 46px;
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
        margin-top:auto;
        margin-bottom:auto;
}
#main {
	position: relative;
	width: 50%;
	float: left;
	height:100%;
	padding-left:3%;
	padding-right:3%;
        border-left-width: 1px;
	border-left-style: solid;
	border-left-color: rgb(63,189,237);
        border-right-width: 1px;
	border-right-style: solid;
	border-right-color: rgb(63,189,237);
}
#left {
	float:left;
	height:100%;
	width: 14%;
	padding-left:2%;
	padding-right:2%;
}
#right {
	position: fixed;
	right:0px;
	top:10%;
	height:100%;
	width: 18%;
	padding-right:2%;
	padding-left:2%;
}
#down {
	position: fixed;
	bottom: 0px;
	left: 0px;
	background-color: #000;
	height: 40px;
	width: 100%;
	border-top: 1px solid rgb(63,189,237);
	z-index:999;		
}
.coloredinput {
   color:#FFFFFF;
   background-color:rgb(17,17,15);
   border-style:solid;
   border-color:rgb(63,189,237);
}
.tits {
    background-color:lightgrey;
}
.comm {
    color:grey;
}

.post_content{
	position:relative;
	width: 650px;
}
.image_block{
	margin:20px;
}
.image{
	float: left;
	margin-top: 0px;
	margin-right: 10px;
	margin-bottom: 10px;
	margin-left: 10px;
	border: thin solid rgb(63,189,237);
}
.post_inner_content{
    border: thin solid rgb(247,247,247);
}
.post_author{
	font-weight: bold;
	left: 30px;
        margin-bottom: 10px;
}
.post_title{
	font-style: italic;
	font-weight: bold;
}
.post_text{
	margin-left: 5em;
        margin-right: 1em;
        padding:5px;
        background-color:rgb(247,247,247);
}
.post_date{
	font-size:10px;
	text-align: right;
	background-color: rgb(247,247,247);
        margin-top:1em;
}

.comment_content{
	position:relative;
	width: 550px;
	margin-top: 0px;
	margin-bottom: 0px;
}
.comment_image_block{
	margin:20px;
	position: relative;
	left: 100px;
}
.comment_image{
	float: left;
	margin-top: 0px;
	margin-right: 10px;
	margin-bottom: 10px;
	margin-left: 10px;
	border: thin solid rgb(63,189,237);	
}
.comment_inner_content{
	border: thin solid rgb(247,247,247);	
}
.comment_author{
	font-weight: bold;
	left: 30px;
	margin-bottom: 0px;
}
.comment_text{
	margin-left: 3.5em;
	margin-right: 1em;
	padding:5px;
	background-color:rgb(247,247,247);
}
.comment_date{
	font-size:10px;
	text-align: right;
	position: absolute;
	right: 2em;
	top: 5px;
}
.comment_textarea {
        margin-left:15em;
        margin-top:0px;
	border: thin solid rgb(230,230,230);
}
.post_textarea {
        margin:0px;
	border: thin solid rgb(230,230,230);
}
iframe{
    position:relative;
    z-index:998;
}
</style>
<script language="javascript">
function mouse_over_button(FRM,BTN)
{
   window.document.forms[FRM].elements[BTN].style.color = "rgb(63,189,237)";
   window.document.forms[FRM].elements[BTN].style.borderColor = "rgb(17,17,15)";
}
function mouse_out_button(FRM,BTN)
{
   window.document.forms[FRM].elements[BTN].style.color = "white";
   window.document.forms[FRM].elements[BTN].style.borderColor = "rgb(63,189,237)";
}
</script>
</head>

<body>
<div id="top_container">
  <div id="logo"><a href="index.php"><img src="asocial_logo_gallo.jpg" width="150" height="46px" alt="logo" /></a></div>	
  <div id="login">

  <?php
    require_once("param_wrapper.php");
            
        if((isset($_POST['username']) && isset($_POST['password'])) &&
            $_POST['username'] != "" && $_POST['password'] != ""){
       try{
        $wsdl = "http://localhost:8080/ASocialServer/ASocialService?wsdl";
        $client = new SoapClient($wsdl, array('trace' => 1));
        $function = "loginRequest";
        $user = $_POST['username'];
        $password = $_POST['password'];
        $params = array('username' =>$user,'password'=>$password);
        $tmp = $client->__soapCall($function, paramWrapper($params));
        $res = $tmp->return; 
        echo "risultato: ".$tmp->return.";<br/>";
        if($res=="Login effettuato!"){
            $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['username']));
            echo "Welcome ".$user."!";
        }
        else{
            echo "Invalid username or password.";
        }
        
        
        } catch (Exception $e){
        echo $e->getMessage();
        }
        }else{
            echo '<form action="index.php" method="post" name="login">
                User:<input class="post_textarea" name="username" type="text" size="10" maxlength="15" />&nbsp;
                Password:<input class="post_textarea" name="password" type="password" size="10" maxlength="15" />&nbsp;
                <input name="submit" class="coloredinput" type="submit" value="log in" onMouseOver="mouse_over_button(this.form.name,this.name)" onMouseOut="mouse_out_button(this.form.name,this.name)" />
                </form>';
        }
        
        
        ?>
  
  </div>
</div>

<div id="body_container">

  <div id="left">
  <?php include_once("update_xml_call.php"); ?>
  
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies posuere lobortis. Suspendisse potenti. Nunc non imperdiet leo. Donec fermentum purus ac diam mollis quis pulvinar turpis lacinia. Aliquam ut augue augue. Cras non ante vel lectus convallis tincidunt accumsan quis lorem. Vestibulum tempor urna sed nibh semper eget vehicula massa sagittis. Nam sem nibh, lacinia at adipiscing scelerisque, accumsan eu justo. Nullam pulvinar, ligula egestas lobortis hendrerit, arcu dolor faucibus dolor, et accumsan enim dolor ac nibh. Nam id magna velit, in aliquet mauris. Sed facilisis convallis lacinia. Fusce id justo dolor. Duis sem mauris, dictum sit amet interdum at, dapibus ac mauris.

Nullam id nibh nisi. Praesent vel lectus libero. Maecenas consectetur fringilla quam, aliquam aliquam velit posuere id. Sed at nisl ante, id gravida velit. Donec pellentesque enim et mauris placerat quis feugiat nisi vestibulum. Nunc id leo felis. Aliquam sit amet odio in augue vestibulum dignissim. Nunc sit amet enim quis erat accumsan auctor. Cras fringilla, nisi et laoreet porta, felis ipsum pretium libero, eu consequat nunc massa vitae enim. Duis nibh tortor, malesuada vitae commodo at, malesuada et felis. Quisque sed vestibulum dui. Nullam ac mauris nunc. Morbi ut justo ligula, non hendrerit urna.
 
  </div>
  <div id="main">
    <div>
        <?php include("send_post.php"); ?>
    </div>
      <hr/>
    <div>
        <?php include("php_parse_xml.php"); ?>
    </div>
  <div id="right">Content for id "right" Goes Here. This content is fixed".
      <div>
          <ul>
              <li><a href="register.php">Register</a></li>
              <li><a href="login.php">Login</a></li>
              <li><a href="send_post.php">Send Post</a></li>
              <li><a href="send_comment.php">Send Comment</a></li>
              <li><a href="upload_file_form.php">Upload File</a></li>
              <li><a href="update_xml_call.php">Update XML</a></li>
              <li><a href="php_parse_xml.php">Parse XML</a></li>
          </ul>
      </div>
  </div>  
</div>
<div id="down">Content for id "down" Goes Here</div>

</body>
</html>
