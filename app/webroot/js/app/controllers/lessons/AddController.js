app.controller('LessonsAddController', ['$scope', '$routeParams', 'Lessons', 
function ($scope, $routeParams, Lessons) {
    $scope.data = {};
    $scope.id = 0;
    $scope.add = true;
    
    $scope.add = function() {
        Lessons.create($scope.data, function(data) {
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
}]);