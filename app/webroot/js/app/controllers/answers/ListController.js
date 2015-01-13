app.controller('AnswersListController', ['$scope', 'Lessons', function ($scope, Lessons) {
    $scope.rows = {
        'Current': [],
        'Passed': []
    };

    $scope.getLessons = function () {
        var lessons = Lessons.view_my(function (){
            var current = [];
            var passed = [];
            var curDate = new Date();
            angular.forEach(lessons, function (val, key) {
                var lessonDate = new Date(val.Lesson.end);
                if (lessonDate < curDate) {
                    passed.push(val);
                } else {
                    current.push(val);
                }
            });
            $scope.rows['Current'] = sortByRows(current);
            $scope.rows['Passed'] = sortByRows(passed);
        });
    };
    
    var sortByRows = function (lessons) {
        var row = [];
        var rows = [];
        angular.forEach(lessons, function (val, key) {
            if (row.length === 4) {
                rows.push(row);
                row = [];
            }
            row.push(val);
        });
        if (row.length > 0) {
            rows.push(row);
        }
        return rows;
    };
    
    $scope.delete = function (id) {
        Lessons.delete({'id': id}, function () {
            $scope.getLessons();
        });
    };

    $scope.getLessons();
}]);