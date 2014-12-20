<html>
    <head>
        <title>Knowledges</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body data-ng-app="UserManager" data-ng-controller="MainController">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Knowledges</a>
                    <ul class="nav navbar-nav">
                        <li data-ng-class="{'active': path=='/roles/'}">
                            <a href="#/roles/">Roles</a>
                        </li>
                        <li data-ng-class="{'active': path=='/users/'}">
                            <a href="#/users/">Users</a>
                        </li>
                        <li data-ng-class="{'active': path=='/lessons/'}">
                            <a href="#/lessons/">Lessons</a>
                        </li>
                        <li data-ng-class="{'active': path=='/groups/'}">
                            <a href="#/groups/">Groups</a>
                        </li>
                    </ul>
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
                <div class="alerts-wrap">
                    <alert ng-repeat="alert in alerts"
                           type="{{alert.type}}"
                           close="closeAlert($index)">{{alert.message}}</alert>
                </div>
                <div class="col-md-12" ng-view>

                </div>
            </div>
            <hr>

            <footer>
                <p>&copy; <a href="http://geeksforless.com/" target="_blank"><i>Geeks<font color="red">For</font>Less</i></a></p>
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-resource.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-route.js"></script>
        <script src="js/vendor/ui-bootstrap-tpls-0.12.0.min.js"></script>

        <script src="js/app/app.js"></script>

        <script src="js/app/resources/RolesResource.js"></script>
        <script src="js/app/resources/UsersResource.js"></script>
        <script src="js/app/resources/LessonsResource.js"></script>
        <script src="js/app/resources/GroupsResource.js"></script>
        
        <script src="js/app/controllers/roles/ListController.js"></script>
        <script src="js/app/controllers/roles/EditController.js"></script>
        <script src="js/app/controllers/roles/AddController.js"></script>

        <script src="js/app/controllers/MainContoller.js"></script>
        <script src="js/app/controllers/users/RegisterController.js"></script>
        <script src="js/app/controllers/users/LoginController.js"></script>
        <script src="js/app/controllers/users/ListController.js"></script>
        <script src="js/app/controllers/users/EditController.js"></script>

        <script src="js/app/controllers/groups/ListController.js"></script>
        <script src="js/app/controllers/groups/EditController.js"></script>
        <script src="js/app/controllers/groups/AddController.js"></script>
        
        <script src="js/app/controllers/lessons/ListController.js"></script>
        <script src="js/app/controllers/lessons/EditController.js"></script>
        <script src="js/app/controllers/lessons/AddController.js"></script>
    </body>
</html>
