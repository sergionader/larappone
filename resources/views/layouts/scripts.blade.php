<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="7GLRnGzWgykV3O7X6ChaDniA49RJ2VlSh74xq_kTh2s" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ URL::to('vendor/bootstrap/dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('css/bootstrap-dialog.min.css') }}">
    
    <!-- DATA RANGE PICKER -->
  
    <link rel="stylesheet" href="{{ URL::to('/vendor/bootstrap-daterangepicker/daterangepicker.css') }}"> 

    <!-- HIGHLIGHT -->
    <link rel="stylesheet" href="{{ URL::to('css/highlight/darcula.css') }}">

    <!-- IONICONS -->
    <link rel="stylesheet" href="{{ URL::to('/vendor/Ionicons/css/ionicons.min.css') }}"> 
    
    <!-- SELECT 2 -->
    <link rel="stylesheet" href="{{ URL::to('/vendor/select2/dist/css/select2.min.css') }}"> 
    
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ URL::to('/vendor/font-awesome/css/font-awesome.min.css') }}">
    
    <!-- ADMIN LTE ELEMENTS -->    
    <link rel="stylesheet" href="{{ URL::to('/vendor/adminlte/css/AdminLTE.css') }}">
    
    <!-- GOOGLE FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- RESPONSIVE TABLES -->
    <link rel="stylesheet" href="{{ URL::to('/vendor/zurb-responsive-tables/responsive-tables.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}"> 
    
    <!-- ****** JAVASCRIPT ******* -->

      <!-- jQuery -->
      
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>

        <!-- Bootstrap JavaScript -->
        <script src="{{ URL::to('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.0/js/foundation.min.js"></script>   

         <!-- FastClick -->
         <script src="{{URL::to('vendor/fastclick/lib/fastclick.js')}}"></script>

         <!-- MOMENT -->
         <script src="{{URL::to('/vendor/moment/min/moment.min.js')}}"></script>
         
         <!-- DATA RANGE PICKER -->
         <script src="{{URL::to('vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

        <!-- AdminLTE App -->
        <script src="{{URL::to('vendor/adminlte/js/adminlte.min.js')}}"></script>
        <script src="{{ URL::to('js/handlebars.min.js') }}"></script>        
        
        <!-- bootstrap3-dialog  -->                
        <script src="{{ URL::to('js/bootstrap-dialog.min.js') }}"></script>        
      
        <!-- highlight  -->        
        <script src="{{URL::to('js/highlight.pack.js')}}"></script>
        <script>hljs.initHighlightingOnLoad();</script>
      
          <!-- Internal Helper  -->                
          <script src="{{ URL::to('js/helper.js') }}"></script>        
        

        <!-- HighCharts  -->   
        <script src="{{URL::to('vendor/highchart/js/highcharts.src.js')}}"></script>
        <!-- Google Charts  Maps -->
        <script src="https://www.gstatic.com/charts/loader.js"></script>

     

        <!-- RESPONSIVE TABLES -->
        <script src="{{ URL::to('/vendor/zurb-responsive-tables/responsive-tables.js') }}"></script>
        

        @stack('scripts') 
</head>
