<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content='initial-scale=1,maximum-scale=1,user-scalable=no'>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>Eventmanager</title>


        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        {!! Html::style('css/app.css') !!}
        {!! Html::style('css/dashboard.css') !!}

        {!! Html::script('js/jquery.min.js') !!}
        <script src='https://api.tiles.mapbox.com/mapbox.js/v2.2.3/mapbox.js'></script>
        <link href='https://api.tiles.mapbox.com/mapbox.js/v2.2.3/mapbox.css' rel='stylesheet' />
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('js/validator.js') !!}
        {!! Html::script('js/app.js') !!}




        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>


        @yield('navcontent')

        <div class="container-fluid">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    
                    @endforeach
                    
                </ul>
                
            </div>
            @endif



            @yield('events')

        </div>
    </body>
</html>