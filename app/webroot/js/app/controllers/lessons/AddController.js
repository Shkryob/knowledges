app.controller('LessonsAddController', ['$scope', 'Lessons',
function ($scope, Lessons) {
    $scope.data = {};
    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };
    $scope.id = 0;
    $scope.add = true;

    $scope.update = function () {
        Lessons.save($scope.data, function (data) {
            $scope.showError(data.message);
        }, function (response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.addQuestion = function () {
        if (!$scope.data.questions) {
            $scope.data.questions = [];
        }
        $scope.data.questions.push({});
    };
    
    $scope.deleteQuestion = function (question) {
        var index = $scope.data.questions.indexOf(question);
        $scope.data.questions.splice(index, 1);
    };
}]);