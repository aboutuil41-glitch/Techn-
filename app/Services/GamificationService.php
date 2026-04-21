<?php
namespace App\Services;

use App\Models\Certificate;
use App\Models\UserProgress;
use Illuminate\Support\Str;

class GamificationService{

public function awardXp($user, int $amount){

if($amount <= 0){
    return;
}
$user->xp += $amount;
$user->level = $this->getLevel($user->xp);
$user->title = $this->getTitle($user->level);
$user->save();
}

public function passQuiz($user){
    $this->awardXp($user, 30);
}

public function getLevel(int $xp){

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


public function getTitle(int $level){

return match (true){
    $level >= 15 => 'Master',
    $level >= 10 => 'Artist',
    $level >= 5  => 'Sketcher',
    default      => 'Beginner',
};
}

    public function earnCertificate($user, $path)
    {
        $lessonIds = $path->modules()
            ->with('lessons:id,module_id')
            ->get()
            ->flatMap(fn($module) => $module->lessons->pluck('id'))
            ->unique()
            ->values();

        if ($lessonIds->isEmpty()) {
            return;
        }

        $completedLessons = UserProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', $lessonIds)
            ->where('completed', true)
            ->count();

        if ($completedLessons !== $lessonIds->count()) {
            return;
        }

        $alreadyHasCertificate = Certificate::where('user_id', $user->id)
            ->where('learning_path_id', $path->id)
            ->exists();

        if ($alreadyHasCertificate) {
            return;
        }

        $this->awardXp($user, 200);

        Certificate::create([
            'user_id' => $user->id,
            'learning_path_id' => $path->id,
            'certificate_code' => 'TECH-' . now()->format('Y') . '-' . Str::upper(Str::random(10)),
            'issued_at' => now(),
        ]);
    }
}

?>



