app.controller('RolesListController', ['$scope', 'Roles', function ($scope, Roles) {
    $scope.roles = [];

    $scope.getRoles = function () {
        $scope.roles = Roles.query();
    };
    
    $scope.delete = function (id) {
        Roles.delete({'id': id}, function () {
            $scope.getRoles();
        });
    };

    $scope.getRoles();
}]);