# FastVoting

## Installation

1. Clone this repository.
2. Install the dependencies. Run `composer install` command, then run `npm install` command.
3. Create `.env` file by simply copying the `.env.example` file and rename it.
4. Configure the `.env` file with your **database connection**, **mailer**, etc.
5. Generate the application key with `php artisan key:generate` command.
6. Generate the database structure with `php artisan migrate` command.
7. Generate the app resources (public assets, like: styles, scripts, etc.) with Laravel Mix.
   - In **development**, use `npm run dev` command. For watching the file changes (**watch mode**), use `npm run watch` command instead.
   - In **production**, use `npm run prod` command.

> Note: Before **running in watch mode**, you need to start the application first.

8. Finally, start the application with `php artisan serve` command.
