app.controller('MainController', ['$scope', '$location', '$timeout', 'Users', 
function ($scope, $location, $timeout, Users) {
    $scope.path = '';
    $scope.maxMark = 12;
    $scope.alerts = [];

    $scope.showError = function (message) {
        var alert = {message: message, type: "danger"};
        $scope.alerts.push(alert);
        $timeout(function(){
            var index = $scope.alerts.indexOf(alert);
            if (index !== -1) {
                $scope.alerts.splice(index, 1);
            }
        }, 6000); 
    };

    $scope.closeAlert = function (index) {
        $scope.alerts.splice(index, 1);
    };

    Users.current(function (data) {
        $scope.currentUser = data;
        var path = $location.path();
        if ($scope.isLoggedIn() && (path === '/login/' || path === '/register/')) {
            $location.path('/users/');
        } else if (!$scope.isLoggedIn()) {
            $location.path('/login/');
        }
    });

    $scope.setUser = function (user) {
        $scope.currentUser = user;
    };

    $scope.logout = function (event) {
        event.preventDefault();
        Users.logout();
        $scope.currentUser = {};
        $location.path('/login/');
    };

    $scope.isLoggedIn = function () {
        return $scope.currentUser && $scope.currentUser.email;
    };

    $scope.$on('$locationChangeStart', function (next, current) {
        $scope.path = $location.path();
    });
}]);
