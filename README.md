# LarAppOne

LarAppOne is a Laravel/Elasticsearh demo site with a beatiful dashboard and many cool features. 

## Getting Started

It is recommended some previous experience with Laravel and Elasticsearch. In other words, it should be important to use this app in a computer where Laravel and Elasticsearch are already configured. 

### Demo Site
[http://thedevproject.info](http://thedevproject.info)

### Prerequisites

You will need:
* PHP 7.x
* Composer
* Laravel 5.5 -- not tested with other versions
* Elasticsearch 5.6 -- not test other versions

Elasticsearch uses the default port and your /config/scout.php file should show

````
 'driver' => env('SCOUT_DRIVER', 'elasticsearch'),

    'elasticsearch' => [
        'index' => env('ELASTICSEARCH_INDEX', 'larappone'),
        'hosts' => [
            env('ELASTICSEARCH_HOST', 'http://localhost'),
        ],
    ],
````

After cloning the repo, rename the /.env.example to /.env, insert your database credentials and optionally your [mailtrap.io](http://mailtrap.io) account info if you want to test any email function.
Then run: 
````
composer update
````

### Documentation
Just navigate to the [LarAppOne Official Documentation](http://app.thedevproject.info/docs/project).

## Built With

* [Full Stack](http://app.thedevproject.info/docs/stack) - All packages used in the project

## Author

* **[Sergio Nader](http://app.thedevproject.info/docs/author)**  

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments
* [AdminLTE 2](https://adminlte.io/themes/AdminLTE/index2.html)
* [Laracasts](https://laracasts.com)
* [Packt Books](https://packtpub.com)
* [Plural Sight](https://pluralsight.com)
* [Safari Books](https://safaribooksonline.com)
* [Stack Overflow](https://stackoverflow.com)

