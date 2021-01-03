<?php 

/**
 * converte a data ao formato de Angola
 * @param string $date 
 * @param string $slashe / or -
 * @return string date, formato de Angola
 */

function dateTransform($date,$slashe = "/"){
    return date_format(new \DateTime($date),"d".$slashe."m".$slashe."Y");
}