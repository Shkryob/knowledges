app.factory('Users', ['$resource', function($resource) {
    var userMethods = {
        update: {method:'PUT', url: '/users/edit/:id'},
        login: {method:'POST', url: '/users/login'},
        register: {method:'POST', 
            url: '/users/register', 
            headers:{'Content-Type': 'application/json'}},
        current: {method: 'GET', url: '/users/current'},
        logout: {method: 'GET', url: '/users/logout'},
        delete: {method: 'DELETE', url: '/users/delete/:id'},
        query: { method: "GET", isArray: true }
    };
    return $resource('/users/:id', {id:'@id'}, userMethods);
}]);
