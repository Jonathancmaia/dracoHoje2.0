# Draco Hoje

Draco hoje is a website developed in Laravel and Vue.js that displays the current values in Brazilian real and US dollars of two coins named Draco and Hydra (From Mir4). The site also has the functionality of saving the values of these currencies every 30 minutes in a database to generate some graphs.

## Features

- Display of current values in Brazilian real and US dollars of Draco and Hydra
- Saving of currency values every 30 minutes in a database
- Generation of a graph with the currency values over time

## Technologies Used

- Laravel
- Vue.js
- Mysql

## Installation in development enviroment

1. Clone the repository
2. Run "artisan install" and "npm i" to install all the dependencies
3. Configure the database
4. Run the "php artisan migrate" to create tables in the database
5. Start the Laravel and Vue.js servers with "php artisan serve" and "npm run dev" commands
6. Start the Laravel Scheduling with "php artisan schedule:work" command

## See this in production

- This project is in production enviroment in: https://www.dracohoje.com

## Contribution

This project is open for contributions. If you encounter any issues or have suggestions for improvements, feel free to create an issue or send a pull request.

## License

This project is licensed under the MIT License. See the LICENSE file for more information.
