<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FYP</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/pro/css/bootstrap.css">
    <link rel="stylesheet" href="/node_modules/angular2-busy/build/style/busy.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="node_modules/angular2/bundles/angular2-polyfills.js"></script>
    <script src="node_modules/systemjs/dist/system.src.js"></script>
    <script src="node_modules/rxjs/bundles/Rx.js"></script>
    <script src="node_modules/angular2/bundles/angular2.js"></script>
    <script src="node_modules/angular2/bundles/router.js"></script>
    <script src="https://code.angularjs.org/2.0.0-beta.0/http.dev.js"></script>
    <script src="http://localhost/pro/js/jquery-3.1.1.min.js"></script>

    <script>
        System.config({
            packages: {
                'angular-app': {
                    format: 'register',
                    defaultExtension: 'js'
                }
            }
        });
        System.import('angular-app/boot')
                .then(null, console.error.bind(console));
    </script>

</head>
<base href="//">
<body>
    <app>Loading...</app>
</body>

</html>