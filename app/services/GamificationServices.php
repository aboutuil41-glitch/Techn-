<?php
namespace App\services;



class GamificationServices{

public function awardXp($user, $amount){

if($amount <= 0){
    return;
}
$user->xp += $amount;

}





}

?>



