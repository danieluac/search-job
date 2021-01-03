<?php 
use App\Helpers\OwnerHelpers;
/**
 * converte a data ao formato de Angola
 * @param string $date 
 * @param string $slashe / or -
 * @return string date, formato de Angola
 */

function dateTransform($date,$slashe = "/"){
    if($slashe != "Y")
        return date_format(new \DateTime($date),"d".$slashe."m".$slashe."Y");
    else
        return date_format(new \DateTime($date),"Y");
}
function verifica_candidatura($seeker_id, $job_id){
    $job_seeker = (OwnerHelpers::job_seekers)::where("job_id", $job_id)->where("seeker_id", $seeker_id)->get()->count();
    if ($job_seeker > 0) return true;
    else return false;

}
function count_candidatura($job_id){
    return (OwnerHelpers::job_seekers)::where("job_id", $job_id)->get()->count();
}
function verifica_selecao($job_seeker_id){
    return (OwnerHelpers::job_seekers)::where("id", $job_seeker_id)->where("status", "selected")->get()->count();
}