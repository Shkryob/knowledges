app.controller('AnswersEditController', ['$scope', '$routeParams', '$q', 'Lessons', 'Groups', 'Answers',
function ($scope, $routeParams, $q, Lessons, Groups, Answers) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    $scope.groups = Groups.query();
    $scope.answers = Answers.view_my({'id': $scope.id});
    
    $scope.update = function() {
        $scope.data['id'] = $scope.id;
        $scope.data.group_id = $scope.data.group.Group.id;
        Lessons.update($scope.data, function(data) {
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