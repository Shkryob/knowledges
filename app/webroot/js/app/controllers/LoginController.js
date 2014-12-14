app.controller('LoginController', ['$scope', '$location', 'Users', function ($scope, $location, Users) {
    $scope.data = {};
    
    $scope.login = function() {
        Users.login($scope.data, function(data) {
            $scope.setUser(data);
            $location.path('/users/');
        }, function(response) {
            $scope.showError(response.data);
        });
    };
}]);