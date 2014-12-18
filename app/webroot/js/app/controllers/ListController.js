app.controller('ListController', ['$scope', 'Users', function ($scope, Users) {
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