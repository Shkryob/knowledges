app.controller('LoginController', ['$scope', '$location', 'Users', function ($scope, $location, Users) {
    $scope.data = {};
    
    $scope.login = function() {
        Users.login($scope.data, function(data) {
            if (data.success && data.user) {
                $scope.setUser(data.user);
                $location.path('/users/');
            }
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
}]);