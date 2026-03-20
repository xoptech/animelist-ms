# Anime List Management System

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=flat&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat&logo=bootstrap&logoColor=white)

A simple CRUD application for managing a personal anime watch list.

---

## Database Fields

| Field         | Type      | Description                                                            |
| ------------- | --------- | ---------------------------------------------------------------------- |
| `id`          | integer   | Primary key                                                            |
| `title`       | string    | Anime title                                                            |
| `genre`       | enum      | Action, Romance, Isekai, Fantasy, Slice of Life, Horror, Sports, Mecha |
| `episodes`    | integer   | Total episode count                                                    |
| `status`      | enum      | Watching, Completed, Plan to Watch, Dropped                            |
| `rating`      | integer   | Personal rating from 1 to 10                                           |
| `studio`      | string    | Animation studio                                                       |
| `cover_image` | string    | Cover image URL (optional)                                             |
| `created_at`  | timestamp | Auto-generated                                                         |
| `updated_at`  | timestamp | Auto-generated                                                         |

---

## Screenshots

> Index - Anime List

![Index1](docs/index1.png)
![Index2](docs/index2.png)

> Create - Add Anime

![Create](docs/create.png)

> Show - Anime Details

![Show](docs/show.png)

> Edit - Update Anime

![Edit](docs/edit.png)

> Delete - Remove Anime

![Delete](docs/delete.png)

---

## Installation

**Requirements:** Git, PHP, Composer, Laravel

```bash
git clone https://github.com/xoptech/anime-list.git
cd anime-list
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Then open `http://127.0.0.1:8000` in your browser.
