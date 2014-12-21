app.controller('LessonsEditController', ['$scope', '$routeParams', '$q', 'Lessons', 'Groups',
function ($scope, $routeParams, $q, Lessons, Groups) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    $scope.groups = Groups.query();
    
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