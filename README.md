# CRM

## Installation

1. Clone the repository: Clone the repository to your local machine using the command

   ```bash
   git clone https://github.com/dimitrytar22/ox-test-task.git

2. Install dependencies

   ```bash
   composer install

3. Set up your environment file (Database, Test Database, API Key):
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=YOUR_DBNAME
   DB_USERNAME=YOUR_USERNAME
   DB_PASSWORD=YOUR_PASSWORD
   

   TEST_DB_CONNECTION=mysql
   TEST_DB_HOST=127.0.0.1
   TEST_DB_PORT=3306
   TEST_DB_DATABASE=test_DB_NAME
   TEST_DB_USERNAME=YOUR_USERNAME
   TEST_DB_PASSWORD=YOUR_PASSWORD

   CLIENTS_API_URL=https://my.api.mockaroo.com/clients.json
   CLIENTS_API_KEY=dc625760

4. In config/database.php add new connection for test database
    ```
   'testing' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('TEST_DB_DATABASE', 'forge'),
            'username' => env('TEST_DB_USERNAME', 'forge'),
            'password' => env('TEST_DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
5. Set Test DB connection in phpunit.xml
    ```bash
   <env name="DB_CONNECTION" value="testing"/>
   
6. Roll migrations on both databases
    ```bash
   php artisan migrate
   php artisan migrate --database=testing
7. Start local server
    ```bash
   php artisan serve
8. Install frontend dependencies:
   ```bash
   npm install
   npm run dev

## Run Tests

	php artisan test

## Import data
First register/login, then you can click `Import Clients` on `home` page and get 500 clients from API.
