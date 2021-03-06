app.controller('RegisterController', ['$scope', '$location', 'Users', function ($scope, $location, Users) {
    $scope.data = {};
    
    if ($scope.isLoggedIn()) {
        $location.path('/users/');
    }
    
    $scope.register = function() {
        Users.register($scope.data, function(data) {
            if (data.success && data.user) {
                $scope.setUser(data.user);
                $scope.redirectAfterLogin();
            }
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
}]);