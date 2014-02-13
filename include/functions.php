<?php
/* Get Current Age */
function get_age($dob) 
{
	$date = new DateTime($dob);
	$now = new DateTime();
	$interval = $now->diff($date);
	return $interval->y;
}
	
/* Get Zodiac Sign */
function get_sign($dob)
{
     list($month,$day,$year)=explode("/",$dob);
     if(($month==1 && $day>20)||($month==2 && $day<20)){
          return "Aquarius";
     }else if(($month==2 && $day>18 )||($month==3 && $day<21)){
          return "Pisces";
     }else if(($month==3 && $day>20)||($month==4 && $day<21)){
          return "Aries";
     }else if(($month==4 && $day>20)||($month==5 && $day<22)){
          return "Taurus";
     }else if(($month==5 && $day>21)||($month==6 && $day<22)){
          return "Gemini";
     }else if(($month==6 && $day>21)||($month==7 && $day<24)){
          return "Cancer";
     }else if(($month==7 && $day>23)||($month==8 && $day<24)){
          return "Leo";
     }else if(($month==8 && $day>23)||($month==9 && $day<24)){
          return "Virgo";
     }else if(($month==9 && $day>23)||($month==10 && $day<24)){
          return "Libra";
     }else if(($month==10 && $day>23)||($month==11 && $day<23)){
          return "Scorpio";
     }else if(($month==11 && $day>22)||($month==12 && $day<23)){
          return "Sagittarius";
     }else if(($month==12 && $day>22)||($month==1 && $day<21)){
          return "Capricorn";
     }
}

/* Create Session */
function createSession($username,$name,$token,$membership,$remember) 
{
	$_SESSION['name'] = $name;
    $_SESSION['username'] = $username;
    $_SESSION['token'] = $token;
    $_SESSION['membership'] = $membership; 
     
    if($remember == 'true') { 
        /* Set Cookie for 100 days */
        setcookie("name", $name, time()+8640000);
        setcookie("username", $username, time()+8640000); 
        setcookie("token", $token, time()+8640000);
        setcookie("membership", $membership, time()+8640000); 
    }
    return true; 
} 

/* Clear Session and Cookies */
function clearSessionCookies() 
{
	$_SESSION = array();
    session_unset(); 
    session_destroy();  

    /* Set Cookie for 100 days */
    setcookie("name", '', time()-3600);
    setcookie("username", '', time()-3600); 
    setcookie("token", '', time()-3600);
    setcookie("membership", '', time()-3600); 
    
    return true; 
} 

/* Check if member is logged in */
function checkLoggedIn() 
{	 
    if(isset($_SESSION['username']) && isset($_SESSION['token'])) { 
        return true;
    } 
    else if(isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
        if(createSession($_COOKIE['username'],$_COOKIE['name'],$_COOKIE['token'],$_COOKIE['membership'],true)) {
            return true; 
        } 
        else { 
            clearSessionCookies(); 
            return false; 
        } 
    } 
    else {
        return false;
    } 
}

/* Check if member has paid membership */
function checkMembership() 
{
	if(isset($_SESSION['membership']) && $_SESSION['membership'] == 'paid') {
		return true;
	}
	else {
		return false;
	}
}  
?>