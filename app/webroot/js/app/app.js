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
        controller: 'UsersListController'
    })
    .when('/users/:id/', {
        templateUrl: 'views/users/edit.html',
        controller: 'UsersEditController'
    })
    
    .when('/lessons/', {
        templateUrl: 'views/lessons/list.html',
        controller: 'LessonsListController'
    })
    .when('/lessons/add/', {
        templateUrl: 'views/lessons/edit.html',
        controller: 'LessonsAddController'
    })
    .when('/lessons/:id/', {
        templateUrl: 'views/lessons/edit.html',
        controller: 'LessonsEditController'
    })

    .otherwise('/login/');
});