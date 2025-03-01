<?PHP session_start(); 
    require_once'../../library/sw-config.php';
    require_once'../../library/sw-function.php';
    include_once '../mod/sw-header.php';
    
    $iduserx = $row_user['id'];
     
    $COOKIES_MEMBER=$_COOKIE['COOKIES_MEMBER'];$COOKIES_COOKIES =$_COOKIE['COOKIES_COOKIES'];
    
    $idxUSX = epm_decode($COOKIES_MEMBER);
    // var_dump($idxUSX);
    // die;
    
    if(!empty($_COOKIE['COOKIES_COOKIES'])){$COOKIES_COOKIES =  $_COOKIE['COOKIES_COOKIES'];}

	$query_user = "SELECT * FROM employees where id='$COOKIES_MEMBER' AND created_cookies='$COOKIES_COOKIES'";
    $result_user  = $connection->query($query_user);
    $row_user     = $result_user->fetch_assoc();
    $employees_id = $row_user['id'];

    // $save=mysqli_query($connection,"UPDATE employees set created_cookies='-', mlogin='0' where id='$employees_id'");
    
    $update ="UPDATE employees set created_cookies='-', mlogin='0' where id=$idxUSX";
     if($connection->query($update) === false) { 
        die($connection->error.__LINE__);
     }else{
         
     
    $expired_cookie = time()+60*60*24*3;
    $COOKIES_MEMBER='';$COOKIES_COOKIES ='';
    header("location:./login&app=2.7");
    unset($_SESSION['COOKIES_MEMBER']);
    unset($_SESSION['COOKIES_COOKIES']);
    setcookie("COOKIES_MEMBER", "", time()-3600);
    setcookie("COOKIES_COOKIES", "", time()-3600);
    setcookie('COOKIES_COOKIES', '', 0, '/');
    setcookie('COOKIES_MEMBER', '', 0, '/');
	session_destroy();
exit();
}
?>

		
