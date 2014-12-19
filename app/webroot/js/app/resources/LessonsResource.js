app.factory('Lessons', ['$resource', function($resource) {
    var lessonMethods = {
        update: {method:'PUT', url: '/lessons/edit/:id'},
        current: {method: 'GET', url: '/lessons/current'},
        delete: {method: 'DELETE', url: '/lessons/delete/:id'},
        query: { method: "GET", isArray: true }
    };
    return $resource('/lessons/:id', {id:'@id'}, lessonMethods);
}]);
