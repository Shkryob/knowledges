app.controller('GroupsEditController', ['$scope', '$routeParams', 'Groups', 
function ($scope, $routeParams, Groups) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    
    $scope.update = function() {
        $scope.data['id'] = $scope.id;
        Groups.update($scope.data, function(data) {
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.getGroups = function() {
        $scope.data = Groups.get({id: $scope.id});
    };
    
    $scope.getGroups();
}]);