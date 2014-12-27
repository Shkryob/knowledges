app.controller('AnswersEditController', ['$scope', '$routeParams', '$q', 'Lessons', 'Groups', 'Answers',
function ($scope, $routeParams, $q, Lessons, Groups, Answers) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    $scope.groups = Groups.query();
    $scope.answers = Answers.view_my({'id': $scope.id});
    $scope.encodeURIComponent = encodeURIComponent;
    
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
        $q.all([
            $scope.data.$promise,
            $scope.groups.$promise
        ]).then(function (data) {
            angular.forEach($scope.groups, function (val, key) {
                if (val.Group.id === $scope.data.group_id) {
                    $scope.data.group = val;
                    return false;
                }
            });
        });
    };
    
    $scope.getLesson();
}]);