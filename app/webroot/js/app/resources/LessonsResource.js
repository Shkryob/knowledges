app.factory('Lessons', ['$resource', function($resource) {
    var lessonMethods = {
        update: {method:'PUT', url: '/lessons/edit/:id'},
        delete: {method: 'DELETE', url: '/lessons/delete/:id'},
        query: { method: "GET", isArray: true },
        view_my: { method: "GET", isArray: true, url: '/lessons/view_my/' }
    };
    return $resource('/lessons/:id', {id:'@id'}, lessonMethods);
}]);
