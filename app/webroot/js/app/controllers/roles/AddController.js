app.controller('RolesAddController', ['$scope', 'Roles',
function ($scope, Roles) {
    $scope.data = {};
    $scope.id = 0;
    $scope.add = true;

    $scope.update = function () {
        Roles.save($scope.data, function (data) {
            $scope.showError(data.message);
        }, function (response) {
            $scope.showError(response.data);
        });
    };
}]);