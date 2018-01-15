<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-62464230-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-62464230-1');
</script>

    <meta charset="UTF-8">
    <title> LarAppOne from The Dev Project - Laravel, PHP, Javascript and more!</title>

    <meta name="google-site-verification" content="7GLRnGzWgykV3O7X6ChaDniA49RJ2VlSh74xq_kTh2s" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ URL::to('/vendor/adminlte/css/all.css') }}" rel="stylesheet" type="text/css" />



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        // window.trans = @@php
        //     // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
        //     $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
        //     $trans = [];
        //     foreach ($lang_files as $f) {
        //         $filename = pathinfo($f)['filename'];
        //         $trans[$filename] = trans($filename);
        //     }
        //     // $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
        //     echo json_encode($trans);
        // @@endphp
    </script>
</head>
