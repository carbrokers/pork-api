<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/icons/iconfont.css">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>
<body>
    <div id="app">
        <admin-header avatar={{Auth::user()->avatar}}>
        </admin-header>

        <main>
            <div class="sidebar">
                <nav-menu class="df_nav"></nav-menu>
            </div>
            @yield('content')
        </main>
    </div>
    <script src="{{mix('js/app.js')}}"></script>
</body>
</html>