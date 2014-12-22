app.factory('Answers', ['$resource', function($resource) {
    var lessonMethods = {
        update: {method:'PUT', url: '/answers/edit/:id'},
        view_my: {method:'GET', url: '/answers/view_my/:id'},
        query: {method: "GET", isArray: true}
    };
    return $resource('/answers/:id', {id:'@id'}, lessonMethods);
}]);
