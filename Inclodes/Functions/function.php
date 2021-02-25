<?php


//name the page 
function gettitle()
{
 global $pagetitle;
 if (isset($pagetitle)) {
    echo $pagetitle;
 }
 else {
     echo "non";
 }  
}
//name the page 

