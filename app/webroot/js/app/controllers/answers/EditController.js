app.controller('AnswersEditController', ['$scope', '$routeParams', '$q', '$sce', 'Lessons', 'Groups', 'Answers',
function ($scope, $routeParams, $q, $sce, Lessons, Groups, Answers) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    $scope.answers = Answers.view_my({'id': $scope.id});
    $scope.encodeURIComponent = encodeURIComponent;
    $scope.trustAsHtml = $sce.trustAsHtml;
    
    $scope.update = function() {
        var answers = [];
        $scope.data['lesson_id'] = $scope.id;
        angular.forEach($scope.answers, function (val, key) {
            if (key !== '$promise' && key !== '$resolved') {
                val['question_id'] = key;
                answers.push(val);
            }
        });
        Answers.save_my(answers, function(data) {
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.getLesson = function() {
        $scope.data = Lessons.get({id: $scope.id});
    };
    
    $scope.getLesson();
}]);