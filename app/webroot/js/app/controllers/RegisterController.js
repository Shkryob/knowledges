app.controller('RegisterController', ['$scope', '$location', 'Users', function ($scope, $location, Users) {
    $scope.data = {};
    
    $scope.register = function() {
        Users.register($scope.data, function(data) {
            $scope.setUser(data);
            $location.path('/users/');
        }, function(response) {
            $scope.showError(response.data);
        });
    };
}]);