app.controller('MainController', ['$scope', '$location', 'Users', function ($scope, $location, Users) {
    Users.current(function (data) {
        $scope.currentUser = data;
        if ($scope.currentUser.username) {
            $location.path('/users/');
        } else {
            $location.path('/login/');
        }
    });
      
    $scope.showError = function (error) {
        alert(error.message);
    };
    
    $scope.setUser = function (user) {
        $scope.currentUser = user;
    };
    
    $scope.logout = function (event) {
        event.preventDefault();
        Users.logout();
        $scope.currentUser = {};
        $location.path('/login/');
    };
}]);