app.controller('LessonsListController', ['$scope', 'Lessons', function ($scope, Lessons) {
    $scope.lessons = [];

    $scope.getLessons = function () {
        $scope.lessons = Lessons.query();
    };
    
    $scope.delete = function (id) {
        Lessons.delete({'id': id}, function () {
            $scope.getLessons();
        });
    };

    $scope.getLessons();
}]);