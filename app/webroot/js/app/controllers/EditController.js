app.controller('EditController', ['$scope', '$routeParams', 'Users', 
function ($scope, $routeParams, Users) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    
    $scope.update = function() {
        $scope.data['id'] = $scope.id;
        Users.update($scope.data, function(data) {
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.getUser = function() {
        $scope.data = Users.get({id: $scope.id});
    };
    
    $scope.getUser();
}]);