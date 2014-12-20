app.factory('Groups', ['$resource', function($resource) {
    var groupMethods = {
        update: {method:'PUT', url: '/groups/edit/:id'},
        delete: {method: 'DELETE', url: '/groups/delete/:id'},
        query: { method: "GET", isArray: true }
    };
    return $resource('/groups/:id', {id:'@id'}, groupMethods);
}]);
