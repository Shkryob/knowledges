app.controller('RolesEditController', ['$scope', '$routeParams', 'Roles', 
function ($scope, $routeParams, Roles) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    
    $scope.update = function() {
        $scope.data['id'] = $scope.id;
        Roles.update($scope.data, function(data) {
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.getRoles = function() {
        $scope.data = Roles.get({id: $scope.id});
    };
    
    $scope.getRoles();
}]);