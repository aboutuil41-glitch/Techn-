<p align="center">
  <h1 align="center">⚡ Technē</h1>
  <p align="center">
    Learning & Skill Development Platform
  </p>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel">
  <img src="https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/Livewire-Dynamic-purple?style=for-the-badge">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql">
  <img src="https://img.shields.io/badge/Status-Active-success?style=for-the-badge">
</p>

---

## 📌 About

Technē is a modern learning platform designed to help users **build skills through structured learning paths**.

It focuses on:
- Clear progression 📈  
- Interactive learning 🧠  
- Clean user experience 🎨  

---

## 🚀 Features

- 📚 Learning paths with modules & lessons  
- ✅ Progress tracking system  
- 🧠 Quiz system with scoring  
- 🏆 Gamification elements  
- 🔐 Authentication & role management  
- 📊 Dashboard with statistics  

---

## 🧠 Core Logic

- User → Learning Path → Modules → Lessons  
- Progress stored per user (`user_progress`)  
- Completion % calculated dynamically  
- Quiz attempts tracked with scoring system  

---

## 🛠️ Tech Stack

| Layer       | Technology        |
|------------|------------------|
| Backend     | Laravel 12 (PHP 8.2) |
| Frontend    | Blade + Livewire |
| Database    | MySQL            |
| Styling     | Tailwind CSS     |
| Auth        | Laravel Auth     |

---

## 🗄️ Database Structure

Main tables:

- users  
- learning_paths  
- modules  
- lessons  
- user_progress  
- quizzes  
- quiz_attempts  

---

## ⚙️ Installation

```bash
git clone https://github.com/your-username/techne.git
cd techne
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve