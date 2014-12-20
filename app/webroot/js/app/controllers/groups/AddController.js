app.controller('GroupsAddController', ['$scope', 'Groups',
function ($scope, Groups) {
    $scope.data = {};
    $scope.id = 0;
    $scope.add = true;

    $scope.update = function () {
        Groups.save($scope.data, function (data) {
            $scope.showError(data.message);
        }, function (response) {
            $scope.showError(response.data);
        });
    };
}]);