<?php
namespace App\services;



class GamificationServices{

public function awardXp($user, $amount){

if($amount <= 0){
    return;
}
$user->xp += $amount;
$user->level = $this->getLevel($user->xp);
$user->title = $this->getTitle($user->title);
$user->save();
}

public function passQuiz($user){
    $this->awardXp($user, 30);
}

public function getLevel($xp){

$level = 1;
$requiredXp = 100;
$totalNeeded = 0;

while($xp >= $requiredXp + $totalNeeded)
{
    $totalNeeded += $requiredXp;
    $requiredXp += 50;
    $level ++;
}

return $level;
}


public function getTitle($level){

return match (true){
    $level >= 15 => 'Master',
    $level >= 10 => 'Artist',
    $level >= 5  => 'Sketcher',
    default      => 'Beginner',
};
}
}

?>



