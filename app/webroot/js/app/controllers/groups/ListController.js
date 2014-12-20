app.controller('GroupsListController', ['$scope', 'Groups', function ($scope, Groups) {
    $scope.groups = [];

    $scope.getGroups = function () {
        $scope.groups = Groups.query();
    };
    
    $scope.delete = function (id) {
        Groups.delete({'id': id}, function () {
            $scope.getGroups();
        });
    };

    $scope.getGroups();
}]);