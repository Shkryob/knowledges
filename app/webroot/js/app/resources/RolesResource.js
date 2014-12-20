app.factory('Roles', ['$resource', function($resource) {
    var roleMethods = {
        update: {method:'PUT', url: '/roles/edit/:id'},
        delete: {method: 'DELETE', url: '/roles/delete/:id'},
        query: { method: "GET", isArray: true }
    };
    return $resource('/roles/:id', {id:'@id'}, roleMethods);
}]);
