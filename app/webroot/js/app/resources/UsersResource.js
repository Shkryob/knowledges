app.factory('Users', ['$resource', function($resource) {
    var userMethods = {
        'update': {method:'PUT'},
        'login': {method:'POST', url: '/login'},
        'register': {method:'POST', url: '/register'},
        'current': {method: 'GET', url: '/current'},
        'logout': {method: 'GET', url: '/logout'},
        query: { method: "GET", isArray: true }
    };
    return $resource('/users/:id', null, userMethods);
}]);
