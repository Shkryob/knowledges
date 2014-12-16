<html>
    <head>
        <title>User Manager</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body data-ng-app="UserManager" data-ng-controller="MainController">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Knowledges</a>
                </div>
                <div class="navbar-form navbar-right">
                    <a href="#/login/"
                       class="btn btn-success"
                       data-ng-if="!isLoggedIn()">Sign in</a>
                    <a href="#/register/"
                       class="btn btn-success"
                       data-ng-if="!isLoggedIn()">Register</a>

                    <a href="#"
                       class="btn btn-success"
                       data-ng-click="logout($event)"
                       data-ng-if="isLoggedIn()">Logout</a>
                </div>

            </div>
        </nav>


        <div class="container">
            <div class="row">
                <div class="col-md-12" ng-view>

                </div>
            </div>
            <hr>

            <footer>
                <p>&copy; <a href="http://geeksforless.com/" target="_blank">GeeksForLess</a> 2014</p>
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-resource.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-route.js"></script>
        <script src="js/vendor/ui-bootstrap-0.12.0.min.js"></script>

        <script src="js/app/app.js"></script>

        <script src="js/app/resources/UsersResource.js"></script>

        <script src="js/app/controllers/MainContoller.js"></script>
        <script src="js/app/controllers/RegisterController.js"></script>
        <script src="js/app/controllers/LoginController.js"></script>
        <script src="js/app/controllers/ListController.js"></script>
    </body>
</html>
