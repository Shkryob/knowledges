app.controller('UsersEditController', ['$scope', '$routeParams', '$q', 'Users', 'Roles', 'Groups', 
function ($scope, $routeParams, $q, Users, Roles, Groups) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    $scope.roles = Roles.query();
    $scope.groups = Groups.query();
    
    $scope.update = function() {
        $scope.data['id'] = $scope.id;
        if ($scope.data.role) {
            $scope.data.role_id = $scope.data.role.Role.id;
        } else {
            $scope.data.role_id = 0;
        }
        if ($scope.data.group) {
            $scope.data.group_id = $scope.data.group.Group.id;
        } else {
            $scope.data.group_id = 0;
        }
        Users.update($scope.data, function(data) {
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.getUser = function() {
        $scope.data = Users.get({id: $scope.id});
        $q.all([
            $scope.data.$promise,
            $scope.roles.$promise,
            $scope.groups.$promise
        ]).then(function (data) {
            angular.forEach($scope.roles, function (val, key) {
                if (val.Role.id === $scope.data.role_id) {
                    $scope.data.role = val;
                    return false;
                }
            });
            
            angular.forEach($scope.groups, function (val, key) {
                if (val.Group.id === $scope.data.group_id) {
                    $scope.data.group = val;
                    return false;
                }
            });
        });
    };
    
    $scope.getUser();
}]);