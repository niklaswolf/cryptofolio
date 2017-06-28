CryptoFolio
===============================
This is a web-application which should help you have the overview over your cryptocurrency portfolio!  
It uses Yii2 on the server-application and Vue.js on the frontend-application. For the ease of development, this repository packs both applications in one place.

# Requirements
- Webserver for PHP (Apache), e.g. XAMPP
- MySQL Database
- Composer
- Node.js & NPM

# Setup
1. Clone this repo into your webserver-environment
2. Create a new database
3. Create the file `common/config/main-local.php`
    ```
    return [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=127.0.0.1;dbname=cryptofolio',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@common/mail',
                // send all mails to a file by default. You have to set
                // 'useFileTransport' to false and configure a transport
                // for the mailer to send real emails.
                'useFileTransport' => true,
            ],
        ],
    ];
    ```
    Adapt the values for `dbname`, `username` and `password`  
4. Set up the PHP-backend (powered by Yii2): `composer install`
5. Set up the Vue.js-frontend: 
    - `cd frontend/web/vue`
    - `npm install`
    - `npm run build`

You can now run the application by visiting `http://localhost/cryptofolio/frontend/web/vue/index.html`

# Frontend-Application
The frontend application is build using Vue.js and querys the backend-application via AJAX-calls. Furthermore it uses Webpack as a bundler.   
By running `npm run dev` a development-server gets started at `http://localhost:8080` with hot reloading.  
If you run `npm run build` only the files get generated and bundled together. 
