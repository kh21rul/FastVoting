# FastVoting

## Installation

1. Clone this repository.
2. Install the dependencies. Run `composer install` command, then run `npm install` command.
3. Create `.env` file by simply copying the `.env.example` file and rename it.
4. Configure the `.env` file with your **database connection**, **seeder configuration**, **mailer**, etc.
5. Generate the application key with `php artisan key:generate` command.
6. Generate the database structure with this commands based on your preferences:
   - Use **`php artisan migrate`** for [creating / updating the database](https://laravel.com/docs/9.x/migrations).
   - Use **`php artisan db:seed`** for [seeding the database](https://laravel.com/docs/9.x/seeding#running-seeders).
   - Use `php artisan migrate:fresh` for fresh installation.
   - Use `php artisan migrate:fresh --seed` for fresh installation and seeding the database.

> **Warning!** If you use `php artisan migrate:fresh` command, all tables will be dropped and recreated. **All data in the tables will be lost**.

7. Generate the app resources (public assets, like: styles, scripts, etc.) with Laravel Mix.
   - In **development**, use `npm run dev` command. For watching the file changes (**watch mode**), use `npm run watch` command instead.
   - In **production**, use `npm run prod` command.

> Note: Before **running in watch mode**, you need to start the application first.

8. Finally, start the application with `php artisan serve` command.


## Demo : [FastVoting Web](https://fastvoting.online/)
