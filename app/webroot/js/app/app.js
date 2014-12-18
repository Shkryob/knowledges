var app = angular.module('UserManager', ['ui.bootstrap', 'ngResource', 'ngRoute']);
app.config(function($routeProvider, $locationProvider) {
    $routeProvider
    .when('/login/', {
        templateUrl: 'views/login.html',
        controller: 'LoginController'
    })
    .when('/register/', {
        templateUrl: 'views/register.html',
        controller: 'RegisterController'
    })
    .when('/users/', {
        templateUrl: 'views/list.html',
        controller: 'ListController'
    })
    .when('/users/:id/', {
        templateUrl: 'views/edit.html',
        controller: 'EditController'
    })
    .otherwise('/login/');
});