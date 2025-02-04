<?php

function isUser_logged_in(){
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}


function redirect($location){
    header(header:"Location: login.php");
    exit;
}

function setActiveClass($pageName){

    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page === $pageName)  ? "active": '';

}

function getPageClass(){
    return basename($_SERVER['PHP_SELF'], suffix:".php");
}




function full_month_date($date){
    date_default_timezone_set('Europe/Bucharest');
    if (strtotime($date)) {
        return date("F j", strtotime($date));
    } else {
        return "Dată invalidă";
    }
               

}


?>

