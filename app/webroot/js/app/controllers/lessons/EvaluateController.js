app.controller('LessonsEvaluateController', ['$scope', '$routeParams', '$q', 'Lessons', 'Groups', 'Answers',
function ($scope, $routeParams, $q, Lessons, Groups, Answers) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    $scope.groups = Groups.query();
    $scope.answers = Answers.view_all({'id': $routeParams.id});
    $scope.maxMark = 10;
    
    $scope.evaluate = function() {
        var answers = [];
        angular.forEach($scope.answers, function (user, user_id) {
            angular.forEach(user.answers, function (answer, question_id) {
                answers.push(answer);
            });
        });
        Answers.save_all(answers, function(data) {
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