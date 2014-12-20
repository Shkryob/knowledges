app.controller('LessonsEditController', ['$scope', '$routeParams', 'Lessons', 
function ($scope, $routeParams, Lessons) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    
    $scope.update = function() {
        $scope.data['id'] = $scope.id;
        Lessons.update($scope.data, function(data) {
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.getLesson = function() {
        $scope.data = Lessons.get({id: $scope.id});
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
    
    $scope.getLesson();
}]);