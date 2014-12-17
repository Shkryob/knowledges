app.controller('MainController', ['$scope', '$location', 'Users', function ($scope, $location, Users) {
    Users.current(function (data) {
        $scope.currentUser = data;
        if ($scope.isLoggedIn()) {
            $location.path('/users/');
        } else {
            $location.path('/login/');
        }
    });
      
    $scope.showError = function (message) {
        alert(message);
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
    
    $scope.isLoggedIn = function() {
        return $scope.currentUser && $scope.currentUser.email;
    }
}]);
