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
    
    .when('/roles/', {
        templateUrl: 'views/roles/list.html',
        controller: 'RolesListController'
    })
    .when('/roles/add/', {
        templateUrl: 'views/roles/edit.html',
        controller: 'RolesAddController'
    })
    .when('/roles/:id/', {
        templateUrl: 'views/roles/edit.html',
        controller: 'RolesEditController'
    })
    
    .when('/groups/', {
        templateUrl: 'views/groups/list.html',
        controller: 'GroupsListController'
    })
    .when('/groups/add/', {
        templateUrl: 'views/groups/edit.html',
        controller: 'GroupsAddController'
    })
    .when('/groups/:id/', {
        templateUrl: 'views/groups/edit.html',
        controller: 'GroupsEditController'
    })

    .otherwise('/login/');
});