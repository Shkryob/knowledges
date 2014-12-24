app.factory('Answers', ['$resource', function($resource) {
    var lessonMethods = {
        update: {method:'PUT', url: '/answers/edit/:id'},
        view_my: {method:'GET', url: '/answers/view_my/:id'},
        view_all: {method:'GET', url: '/answers/view_all/:id'},
        save_my: {method:'POST', url: '/answers/save_my/'},
        save_all: {method:'POST', url: '/answers/edit_all/'},
        query: {method: "GET", isArray: true}
    };
    return $resource('/answers/:id', {id:'@id'}, lessonMethods);
}]);
