app.controller('AnswersListController', ['$scope', 'Lessons', function ($scope, Lessons) {
    $scope.rows = [];

    $scope.getLessons = function () {
        var lessons = Lessons.query(function (){
            var row = [];
            angular.forEach(lessons, function (val, key) {
                if (row.length === 4) {
                    $scope.rows.push(row);
                    row = [];
                }
                row.push(val);
            });
            if (row.length > 0) {
                $scope.rows.push(row);
            }
        });
    };
    
    $scope.delete = function (id) {
        Lessons.delete({'id': id}, function () {
            $scope.getLessons();
        });
    };

    $scope.getLessons();
}]);