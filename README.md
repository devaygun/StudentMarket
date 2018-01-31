# Student Market Project
A university project with the goal of providing students with a local buying, selling and trading platform.

By keeping the audience of the platform set to students we can help to ensure that items within the platform are much more relevant and of interest.

## Setup for Windows
1 - Install [Xampp PHP7](https://www.apachefriends.org/download.html) and install [Composer](https://getcomposer.org/download/)
```
Install Xampp with PHP7 or a preferred local web server solution.
```
2 -  Edit `C:\xampp\apache\conf\extra\httpd-vhosts.conf` and add the following to it

```
<VirtualHost studentmarket.test:80>
  DocumentRoot "C:\xampp\htdocs\studentmarket\public"
  ServerAdmin studentmarket.test
  <Directory "C:\xampp\htdocs\studentmarket></Directory>
</VirtualHost>
```
3 - Add a new host to `C:\Windows\System32\drivers\etc` 
```
127.0.0.1       studentmarket.test
```

4 - Run Xampp as admin, install the Apache and MySQL components then start them
 
5 - Visit [phpMyAdmin](http://localhost/phpmyadmin/) and create a local database with the name `StudentMarket`

6 - Git pull or copy the project files into `C:\xampp\htdocs\StudentMarket` and then `cd` into this directory from command prompt

7 - Run `composer update` to download all the packages required by Laravel

8 - Copy `.env.example` and save as `.env` then in terminal run `php artisan key:generate`

9 - Finally run `php artisan migrate:refresh --seed` and visit [Student Market (Local)](http://studentmarket.test/), login with `da332@kent.ac.uk` `deniz123`
## Built With

* [Laravel](https://laravel.com/) - The MVC driven PHP framework
* [Chart.js](http://www.chartjs.org/) - Graph visualisations
* [Bootstrap 3](http://www.chartjs.org/) - Responsive front-end component library
* [Lumen](https://bootswatch.com/3/lumen/) - Bootstrap theme
* [Font Awesome](http://fontawesome.io/license/) - Scalable vector icons
 

## Authors

* **Deniz Aygun**
* **Richard Dight**
* **Sam Wood**