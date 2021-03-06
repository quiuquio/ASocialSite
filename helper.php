<?php
    
/*
 * 
 * Contiene tutte le funzioni utili per gestire il sito. Tutto andrebbe
 * un po' commentato.
 * 
 */

ini_set("soap.wsdl_cache_enabled", "0");



//**********************PHP side ambient setter*****************************

$rob = true;
$forg = false;

if($rob){
    //Rob's wsdl
    $wsdl = "http://127.0.0.1:8084/ASocialServer/ASocialService?wsdl";
    $commentsFile = "commentsfile.xml";
    $xmlFile = "file.xml";
    $avatarFolder = "avatar\\";
}else if ($forg){
    //Forg's wsdl
    $wsdl = "http://127.0.0.1:8084/ASocialServer/ASocialService?wsdl";
    $commentsFile = "commentsfile.xml";
    $xmlFile = "file.xml";
    $avatarFolder = "avatar\\";
    //Setta qui le tue variabili
}

//**************************** END OF AMBIENT SETTER ***********************

$user_id = 0;
function setUser_id ($id){
    global $user_id;
    $user_id = $id;
}

//agrega i parametri da inviare al WSDL come elementXML 'parameters'
function paramWrapper ($parameters){
    return array('parameters' => $parameters);
}

function monitor(){
	global $wsdl;
	$client = @new SoapClient($wsdl, array('trace' => 1));
	echo "Request : <br/><xmp>".htmlentities($client->__getLastRequest()).'</xmp><br/><br/>';
	echo "Response : <br/>".htmlentities($client->__getLastResponse()).'<br/><br/>';
	echo "REQUEST HEADERS:\n" . $client->__getLastRequestHeaders() . "<br/>";
	echo "RESPONSE HEADERS:\n" . $client->__getLastResponseHeaders() . "<br/>";
	var_dump($client->__getFunctions());
	echo "<br/><br/><br/>";
	var_dump($client->__getTypes());
}

/*  controlla che la combinazione unica nomeutente->password sia presente nel db
 *  restituisce -1 con un errore o in caso di password sbagliata.
 */
function checkPassword($username, $password){
    global $wsdl;
    $client = @new SoapClient($wsdl, array('trace' => 1));
    $function = "loginRequest";
    $params = array('username' =>$username,'password'=>$password);
    $tmp = $client->__soapCall($function, paramWrapper($params));
    return $tmp->return; 
}

/*  Prende in input un l'indirizzo assoluto di una immagine e un bool. Se
 *  settato a 1, fa un resize dell'immagine fino a portala a 50x50px.
 *  Cancella l'immagine originale senza lasciare copia, per ora.
 *  Se il bool va a zero, usa un algoritmo un po' più veloce, ma di qualità
 *  inferiore (più leggero sul server).
 * 
 */
function avatarResize($image, $resizedAddress, $width, $height, $HD){
    global $wsdl;
    $client = @new SoapClient($wsdl, array('trace' => 1));
    $function = "resizeImmage";
    $params = array('image'=>$image,'width'=>$width, 'height'=>$height, 'HD'=>$HD);
    $tmp = $client->__soapCall($function, paramWrapper($params));
    $resizedFile = base64_decode($tmp->return);
    return file_put_contents($resizedAddress,$resizedFile);
}

/* Updates the db so that now we know there is an avatar for the user*/
function setAvatar($userID){
    global $wsdl;
    $client = @new SoapClient($wsdl, array('trace' => 1));
    $function = "setAvatar";
    $params = array('userID'=>$userID);
    $tmp = $client->__soapCall($function, paramWrapper($params));
    return $tmp->return;
}
/* Checks if the avatar atribute is set to 1 or 0*/
function checkAvatar($userID){
    global $wsdl;
    $client = @new SoapClient($wsdl, array('trace' => 1));
    $function = "checkAvatar";
    $params = array('userID'=>$userID);
    $tmp = $client->__soapCall($function, paramWrapper($params));
    return $tmp->return;
}


/*replaces any complete URL in a string with a link*/
function URLify($str){
    global $wsdl;
    $client = @new SoapClient($wsdl, array('trace' => 1));
    $function = "URLify";
    $params = array("str"=>$str);
    $tmp = $client->__soapCall($function, paramWrapper($params));
    return $tmp->return;
}

/*
 * beh.. stampa il form di login
 * -1 per stampare un messaggio di errore standard. Altri numeri per form 
 * normale
 */
function printLoginForm($value){
    if ($value == -1){
        echo '<form action="index.php" method="post" name="login">
                <span style="color:red">(Username o password sbagliati)</span>
                User:<input class="login_textarea" name="username" type="text" size="10" maxlength="15" />&nbsp;
                Password:<input class="login_textarea" name="password" type="password" size="10" maxlength="15" />&nbsp;
                <input name="submit" class="coloredinput" type="submit" value="log in" onMouseOver="mouse_over_button(this.form.name,this.name)" onMouseOut="mouse_out_button(this.form.name,this.name)" />
                </form>';
    }else{
        echo '<form action="index.php" method="post" name="login">
                User:<input class="login_textarea" name="username" type="text" size="10" maxlength="15" />&nbsp;
                Password:<input class="login_textarea" name="password" type="password" size="10" maxlength="15" />&nbsp;
                <input name="submit" class="coloredinput" type="submit" value="log in" onMouseOver="mouse_over_button(this.form.name,this.name)" onMouseOut="mouse_out_button(this.form.name,this.name)" />
                </form>';    
    }
    
}

function logOut(){
    unset($_SESSION["username"]);
}

function getUsername($userID){
    try{
        global $wsdl;
        $client = @new SoapClient($wsdl, array('trace' => 1));
        $function = "getUserName";
        $params = array('userID'=>$userID);
        $tmp = $client->__soapCall($function, paramWrapper($params));
        return $tmp->return;
    }catch (Exception $e) {
	echo $e->getMessage();
    }
}

function getUserBio($userID){
    try{
        global $wsdl;
        $client = @new SoapClient($wsdl, array('trace' => 1));
        $function = "getUserBio";
        $params = array('userID'=>$userID);
        $tmp = $client->__soapCall($function, paramWrapper($params));
        return $tmp->return;
    }catch (Exception $e) {
	echo $e->getMessage();
    }
}

function setUserBio($userID, $bio){
    try{
        global $wsdl;
        $client = @new SoapClient($wsdl, array('trace' => 1));
        $function = "setUserBio";
        $params = array('userID'=>$userID, 'bio'=>$bio);
        $tmp = $client->__soapCall($function, paramWrapper($params));
        return $tmp->return;
    }catch (Exception $e) {
	echo $e->getMessage();
    }
}

function check_not_empty($s, $include_whitespace = false)
{
    if ($include_whitespace) {
        // make it so strings containing white space are treated as empty too
        $s = trim($s);
    }
    return (isset($s) && strlen($s)); // var is set and not an empty string ''
}

function checkWichSession($userID){
    /*
     * Prende in input userID e dice se quella sessione è attiva o meno
     * 
     */
}

function isAdmin($userID){
    try{
        global $wsdl;
        $client = new SoapClient($wsdl, array('trace' => 1));
        $function = "isAdmin";
        $params = array('userID' => $userID);
        $res = $client->__soapCall($function, paramWrapper($params));
        return $res->return;
        header("location: index.php");
} catch (Exception $e) {
	echo $e->getMessage();
}	
}

?>
