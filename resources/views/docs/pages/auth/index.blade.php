@extends('layouts.master') 
//<!-- extends('layouts.docs')  --> 
@section('content')
<div class="main">
    <div class="row">
        <div class="col-md-12">
            <h1>Authentication Forms </h1>


            <p>As mentioned in the <a href="{{route('docs.laravel.index')}}" class="doc-link"> Laravel</a> document, 
                the command   <code class="php">php artisan make:auth</code> creates the the basic structure for the authentication process, 
                including the following forms and email message.             
            </p>
            <p>For the email be sent when registering or reseting the password, it's necessary to add valid SMTP credentials to the .env file:</p>
            <pre><code>
        MAIL_DRIVER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=your_user_name
        MAIL_PASSWORD=your_password
        MAIL_ENCRYPTION=null
                </code></pre>
            <p>The <a href="https://mailtrap.io/" class="doc-link" target="_blank">Mailtrap</a> service is very handy for the development and testing stages as you can test it with several email addresses without really sending the messages 
                to the real inbox; instead, mailtrap will "trap" the email into their system. </p>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Forms</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Registration</strong>
                            <img class="img-responsive" src="/img/auth/register.png" alt="Register"></li>
                        <li class="list-group-item"><strong>Login</strong>
                            <img class="img-responsive" src="/img/auth/login.png" alt="Register">
                        </li>
                        <li class="list-group-item"><strong>Forgot Password</strong>
                            <img class="img-responsive" src="/img/auth/forgetpassword.png" alt="Register">
                        </li>    
                        <li class="list-group-item"><strong>Reset Passoword</strong>
                            <img class="img-responsive" src="/img/auth/reset_password.png" alt="Register">
                                
                        </li> 
                        <li class="list-group-item"><strong>Reset Email</strong>
                            <table class="table-bordered">
                                <tr>
                                    <td>
                                        <img class="img-responsive my-border" src="/img/auth/reset_password_email.png" alt="Reset Password Email">
                                    </td>
                                </tr>
                            </table>
                            <!-- <span class="border-0"> -->
                                
                            <!-- </span> -->
                       </li> 
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ./row -->
</div> <!--./ main -->
@endsection

