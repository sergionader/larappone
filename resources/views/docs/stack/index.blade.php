@extends('layouts.master') 
//<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Stack </h1>
            Here you have the list of what has been used to build the solution.
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Package Matrix</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="package-bold">Package</th>
                                <th>URL</th>
                                <th>Version</th>
                                <th>Where</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="firstRow">
                                <td class="package-bold">AdminLTE</td>
                                <td>
                                    <a href='https://adminlte.io/' class='doc-link' target='_blank'>https://adminlte.io/</a>
                                </td>
                                <td class="text-right">2</td>
                                <td>Frontend</td>
                                <td>A very good and free admin template</td>
                            </tr>
                             
                            
                            <tr>
                                <td class="package-bold">Bootstrap</td>
                                <td>
                                    <a href='https://getbootstrap.com/' class='doc-link' target='_blank'>https://getbootstrap.com/</a>
                                </td>
                                <td class="text-right">3.3.7</td>
                                <td>Frontend</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="package-bold">Bootstrap Dialog</td>
                                <td>
                                    <a href='https://github.com/nakupanda/bootstrap3-dialog' class='doc-link' target='_blank'>https://github.com/nakupanda/bootstrap3-dialog</a>
                                </td>
                                <td class="text-right">1.35.4</td>
                                <td>Frontend</td>
                                <td>For alert, confirm and error dialogs.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Carbon</td>
                                <td>
                                    <a href='http://carbon.nesbot.com/' class='doc-link' target='_blank'>http://carbon.nesbot.com/</a>
                                </td>
                                <td class="text-right">1.22.1</td>
                                <td>Backend</td>
                                <td>A simple PHP API extension for DateTime.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Date Range Picker</td>
                                <td>
                                    <a href='https://github.com/dangrossman/bootstrap-daterangepicker' class='doc-link' target='_blank'>https://github.com/dangrossman/bootstrap-daterangepicker</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Frontend</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="package-bold">Elasticsearch</td>
                                <td>
                                    <a href='https://www.elastic.co/' class='doc-link' target='_blank'>https://www.elastic.co/</a>
                                </td>
                                <td class="text-right">5.6.4</td>
                                <td>Grid search</td>
                                <td>Full text search engine</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Faker</td>
                                <td>
                                    <a href='https://github.com/fzaninotto/Faker' class='doc-link' target='_blank'>https://github.com/fzaninotto/Faker</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Backend</td>
                                <td>Fake data generator with very interesting options.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Flood IO</td>
                                <td>
                                    <a href='https://flood.io' class='doc-link' target='_blank'>https://flood.io</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Test</td>
                                <td>Load Tests</td>
                            </tr>
                            <tr>
                                <td class="package-bold">FontAwesome</td>
                                <td>
                                    <a href='http://fontawesome.io/' class='doc-link' target='_blank'>http://fontawesome.io/</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Frontend</td>
                                <td>Uses what come with AdminLTE.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Glyphicons</td>
                                <td>
                                    <a href='http://glyphicons.com/' class='doc-link' target='_blank'>http://glyphicons.com/</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Frontend</td>
                                <td>Uses what come with AdminLTE.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Google Charts/GeoChart</td>
                                <td>
                                    <a href='https://developers.google.com/chart/' class='doc-link' target='_blank'>https://developers.google.com/chart/</a>
                                </td>
                                <td class="text-right">Current</td>
                                <td>Frontend</td>
                                <td>Used fo the map shown on the
                                    <a href="{{route('app.dashboard')}}" class="doc-link">dashboard</a>.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Google Fonts</td>
                                <td>
                                    <a href='https://fonts.google.com/' class='doc-link' target='_blank'>https://fonts.google.com/</a>
                                </td>
                                <td class="text-right">Current</td>
                                <td>Frontend</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="package-bold">Highcharts</td>
                                <td>
                                    <a href='https://www.highcharts.com/' class='doc-link' target='_blank'>https://www.highcharts.com/</a>
                                </td>
                                <td class="text-right">6.0.0</td>
                                <td>Frontend</td>
                                <td>A very powerful JS library for generating live charts.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Highlight</td>
                                <td>
                                    <a href='https://highlightjs.org/' class='doc-link' target='_blank'>https://highlightjs.org/</a>
                                </td>
                                <td class="text-right">9.12.0</td>
                                <td>Frontend</td>
                                <td>
                                    <code>HTML Code Highlight</code>
                                </td>
                            </tr>
                            <tr>
                                <td class="package-bold">ImageOptim</td>
                                <td>
                                    <a href='https://imageoptim.com/mac' class='doc-link' target='_blank'>https://imageoptim.com/mac</a>
                                </td>
                                <td class="text-right">1.7.3</td>
                                <td>Frontend</td>
                                <td>Image size optimizer -- simple, easy to use and free!</td>
                            </tr>
                            <tr>
                                <td class="package-bold">IonIcons</td>
                                <td>
                                    <a href='http://ionicons.com/' class='doc-link' target='_blank'>http://ionicons.com/</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Frontend</td>
                                <td>Uses what come with AdminLTE.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">jQuery</td>
                                <td>
                                    <a href='http://jquery.com/' class='doc-link' target='_blank'>http://jquery.com/</a>
                                </td>
                                <td class="text-right">2.2.4</td>
                                <td>Frontend</td>
                                <td>The Zurb Responsive Tables (below in this page) will not work with jQuery 3.x.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">JWT (tymon/jwt-auth)</td>
                                <td>
                                    <a href='https://github.com/tymondesigns/jwt-auth' class='doc-link' target='_blank'>https://github.com/tymondesigns/jwt-auth</a>
                                </td>
                                <td class="text-right">0.5</td>
                                <td>API Authentication</td>
                                <td>A very handy implementation of the
                                    <a href="https://jwt.io/" class="doc-link" target="_blank">JSON Web Tokens</a> for Laravel.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Laravel</td>
                                <td>
                                    <a href='https://laravel.com/' class='doc-link' target='_blank'>https://laravel.com/</a>
                                </td>
                                <td class="text-right">5.5</td>
                                <td>Backend/Frontend</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="package-bold">Laravel Dusk</td>
                                <td>
                                    <a href='https://laravel.com/docs/5.5/dusk' class='doc-link' target='_blank'>https://laravel.com/docs/5.5/dusk</a>
                                </td>
                                <td class="text-right">5.5</td>
                                <td>Tests</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="package-bold">laravel-scout-elastic</td>
                                <td>
                                    <a href='https://github.com/ErickTamayo/laravel-scout-elastic' class='doc-link' target='_blank'>https://github.com/ErickTamayo/laravel-scout-elastic</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Scout Driver for Elasticsearch</td>
                                <td>Makes it possible to use Laravel with Elasticsearch.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Laravelcollective - HTML</td>
                                <td>
                                    <a href='https://laravelcollective.com/' class='doc-link' target='_blank'>https://laravelcollective.com/</a>
                                </td>
                                <td class="text-right">5.2</td>
                                <td>Frontend</td>
                                <td>Binds the forms to the controllers' variables.</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Moment JS</td>
                                <td>
                                    <a href='https://momentjs.com/' class='doc-link' target='_blank'>https://momentjs.com/</a>
                                </td>
                                <td class="text-right">2.18.1</td>
                                <td>Frontend</td>
                                <td>JS library for date and time manipulation./td>
                            </tr>
                            <tr>
                                <td class="package-bold">mySQL</td>
                                <td>
                                    <a href='https://www.mysql.com/' class='doc-link' target='_blank'>https://www.mysql.com/</a>
                                </td>
                                <td class="text-right">5.7.17</td>
                                <td>Database</td>
                                <td>MySQL Community Server (GPL).</td>
                            </tr>
                            <tr>
                                <td class="package-bold">Postman</td>
                                <td>
                                    <a href='https://www.getpostman.com/' class='doc-link' target='_blank'>https://www.getpostman.com/</a>
                                </td>
                                <td class="text-right"></td>
                                <td>Backend</td>
                                <td>API Development Environment </td>
                            </tr>
                            <tr>
                                <td class="package-bold">OS</td>
                                <td>
                                    <a href='https://www.debian.org/' class='doc-link' target='_blank'>https://www.debian.org/</a>
                                </td>
                                <td class="text-right">Debian GNU/Linux 8</td>
                                <td>Backend</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="package-bold">PHP</td>
                                <td>
                                    <a href='https://secure.php.net/' class='doc-link' target='_blank'>https://secure.php.net/</a>
                                </td>
                                <td class="text-right">7.1.11</td>
                                <td>Backend and frontend.</td>
                                <td></td>
                            </tr>
                            <tr>
                                    <td class="package-bold">PHPUnit</td>
                                    <td>
                                        <a href='https://phpunit.de/' class='doc-link' target='_blank'>https://phpunit.de/</a>
                                    </td>
                                    <td class="text-right">6.4.4</td>
                                    <td>Tests</td>
                                    <td></td>
                                </tr>
                            <tr>
                                <td class="package-bold">Scout</td>
                                <td>
                                    <a href='https://laravel.com/docs/5.5/scout' class='doc-link' target='_blank'>https://laravel.com/docs/5.5/scout</a>
                                </td>
                                <td class="text-right">5.5</td>
                                <td>Laravel's Elasticsearch integration module.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="package-bold">Versioning</td>
                                <td>
                                    <a href='https://bitbucket.com' class='doc-link' target='_blank'>https://bitbucket.com</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Using GIT</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="package-bold">Web Server</td>
                                <td>
                                    <a href='https://www.apache.org/' class='doc-link' target='_blank'>https://www.apache.org/</a>
                                </td>
                                <td class="text-right">Apache 2.4.29</td>
                                <td>Backend</td>
                                <td></td>
                            </tr>
                            <tr class="lastRow">
                                <td class="package-bold">Zurb Responsive Tables</td>
                                <td>
                                    <a href='https://foundation.zurb.com/responsive-tables.html' class='doc-link' target='_blank'>https://foundation.zurb.com/responsive-tables.html</a>
                                </td>
                                <td class="text-right">N/A</td>
                                <td>Frontend</td>
                                <td>Makes the
                                    <a href="{{route('app.index')}}?sort_column=id&sort_az_za=asc&page=1" class="doc-link">grid</a> responsive.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ./row -->
</div>
<!--./ main -->
@endsection

