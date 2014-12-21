app.controller('LessonsAddController', ['$scope', 'Lessons', 'Groups',
function ($scope, Lessons, Groups) {
    $scope.data = {};
    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };
    $scope.id = 0;
    $scope.add = true;
    $scope.groups = Groups.query();

    $scope.update = function () {
        $scope.data.group_id = $scope.data.group.Group.id;
        Lessons.save($scope.data, function (data) {
            $scope.showError(data.message);
        }, function (response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.addQuestion = function () {
        if (!$scope.data.Question) {
            $scope.data.Question = [];
        }
        $scope.data.Question.push({});
    };
    
    $scope.deleteQuestion = function (question) {
        var index = $scope.data.Question.indexOf(question);
        $scope.data.Question.splice(index, 1);
    };
}]);