var app = angular.module('UserManager', ['ui.bootstrap', 'ngResource', 'ngRoute']);
app.config(function($routeProvider, $locationProvider) {
    $routeProvider
    .when('/login/', {
        templateUrl: 'views/users/login.html',
        controller: 'LoginController'
    })
    .when('/register/', {
        templateUrl: 'views/users/register.html',
        controller: 'RegisterController'
    })
    .when('/users/', {
        templateUrl: 'views/users/list.html',
        controller: 'ListController'
    })
    .when('/users/:id/', {
        templateUrl: 'views/users/edit.html',
        controller: 'EditController'
    })
    .otherwise('/login/');
});