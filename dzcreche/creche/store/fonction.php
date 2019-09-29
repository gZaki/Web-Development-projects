<?php
function gettitle(){
    global $title;
    if($title){
        echo $title;
    }else{
        echo 'Admin Panal DZ-Creche ';
    }
}

?>