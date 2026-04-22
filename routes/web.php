<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AdminBoard;
use App\Livewire\ArtBattleList;
use App\Livewire\ArtBattleShow;
use App\Livewire\Home;
use App\Livewire\LearningPath;
use App\Livewire\LearningPathList;
use App\Livewire\Lesson;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');

    Route::get('/home', Home::class)->name('home');
    Route::get('/list', LearningPathList::class)->name('list');
    Route::get('/learning-path/{path}', LearningPath::class)->name('learning-path.show');
    Route::get('/lesson/{lesson}', Lesson::class)->name('lesson.show');
    Route::get('/battles', ArtBattleList::class)->name('battles.index');
    Route::get('/battles/{battle}', ArtBattleShow::class)->name('battles.show');    

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', AdminBoard::class)->name('admin.dashboard');
});

require __DIR__ . '/auth.php';