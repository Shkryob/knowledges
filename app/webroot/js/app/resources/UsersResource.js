app.factory('Users', ['$resource', function($resource) {
    var userMethods = {
        update: {method:'PUT'},
        login: {method:'POST', url: '/users/login'},
        register: {method:'POST', 
            url: '/users/register', 
            headers:{'Content-Type': 'application/json'}},
        current: {method: 'GET', url: '/users/current'},
        logout: {method: 'GET', url: '/users/logout'},
        query: { method: "GET", isArray: true }
    };
    return $resource('/users/:id', null, userMethods);
}]);
