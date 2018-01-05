# LarAppOne

LarAppOne is a Laravel/Elasticsearh demo site with a beatiful dashboard and many cool features. Please fell free to fork it. There many, many nice features to be added to it. 

## Getting Started

It is recommended some previous experience with Laravel and Elasticsearch. In other words, it should be important to use this app in a computer where Laravel and Elasticsearch are already configured. 

### Demo Site
[http://thedevproject.info](http://thedevproject.info)

### Prerequisites

You will need:
* PHP 7.x
* mySQL (tested with 5.7.17)
* Composer
* Laravel 5.5 -- not tested with other versions
* Elasticsearch 5.6 -- not tested with other versions

### Installation
1. Clone this repository: ````git clone https://github.com/sergionader/larappone/ ```` 
1. ````cd larappone````
1. Update config/scout.php to reflect your Elasticsearch installation (see the instructions in the next section)
1. Rename .env.example to /.env, edit it to insert your mySQL credentials -- if you want to test the email features, put your mailtrap.io credentials as well.
1. Run ````php artisan key:generate```` to generate a key (if you haven't done it yet) and add it to the APP_KEY variable in .env file.
1. From your project folder run ````composer update```` 
1. Run the migration: ````php artisan migrate````
1. Start the server ```` php artisan serve --port 8000 ```` 
1. Run the seeder that will create the user admin@example.org: ````php artisan db:seed --class=UsersTableSeeder````
1. Browser the app: http://localhost:8000
1. Log in with user admin@example.org and password test1234
1. Go to the settings menu (gear icon at the upper right)
1. Open the section Populate Aux Tables and then click on Populate -- proceed when the confirmation dialog appears.
1. Open the section Add Random Records. Try adding 10 records and choose "Today" from the date list
1. Goto to the left menu, App, List, Search, Edit, Delete & Add and see your records. 
1. Enjoy! -  and make sure to read the [LarAppOne Official Documentation](http://app.thedevproject.info/docs/project)

### Elasticsearch Setup
Larapone uses Elasticsearch's default port. Your /config/scout.php file should show:

````
 'driver' => env('SCOUT_DRIVER', 'elasticsearch'),

    'elasticsearch' => [
        'index' => env('ELASTICSEARCH_INDEX', 'larappone'),
        'hosts' => [
            env('ELASTICSEARCH_HOST', 'http://localhost'),
        ],
    ],
````

The Elasticsearch driver used in the project does not create the index automacally, so we have to do so: 
````
curl -XPUT 'localhost:9200/larappone?pretty' -H 'Content-Type: application/json' -d'
{
    "settings" : {
        "index" : {
            "number_of_shards" : 3, 
            "number_of_replicas" : 2 
        }
    }
}'
`````


### Adding records automatically each X minutes

If you are using a Linux or a Mac computer, run the following: 
```` 
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```` 
Detailed instructions on how to change the time interval of the cronjob can be found at the 
[Task Scheduling page](https://laravel.com/docs/5.5/scheduling) from the official Laravel documentation. 

### About the mySQL user
If you ever put this app in a production server, please create a user to run it and update the .env file accordingly. You should never run any production application with the root user! 

## Questions
Please open an issue if you have any question. 

## To Do
* Move the remaining chart selects to eloquent
* Implement Roles & permissions
* Analyze where and implement wueues
* Make it multilanguage
* Revise ES implementation -- there is room from improvement
* Grid export (at least to CVS
* Implement reCaptcha
  

## Documentation
Just navigate to the [LarAppOne Official Documentation](http://app.thedevproject.info/docs/project)

## Built With

* [Full Stack](http://app.thedevproject.info/docs/stack) - All the packages used in the project

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

