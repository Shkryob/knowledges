app.controller('ListController', ['$scope', '$location', 'Users', function ($scope, $location, Users) {
    $scope.users = [];

    $scope.getUsers = function () {
        $scope.users = Users.query();
    };
    
    $scope.delete = function (id) {
        Users.delete({'id': id}, function () {
            $scope.getUsers();
        });
    };

    $scope.getUsers();
}]);