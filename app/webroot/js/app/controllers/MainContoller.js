app.controller('MainController', ['$scope', '$location', 'Users', function ($scope, $location, Users) {
   Users.current(function (data) {
       $scope.currentUser = data;
       var path = $location.path();
       if ($scope.isLoggedIn() && (path === '/login/' || path === '/register/')) {
           $location.path('/users/');
       } else if (!$scope.isLoggedIn()) {
           $location.path('/login/');
       }
   });
     
   $scope.showError = function (message) {
       alert(message);
   };
   
   $scope.setUser = function (user) {
       $scope.currentUser = user;
   };
   
   $scope.logout = function (event) {
       event.preventDefault();
       Users.logout();
       $scope.currentUser = {};
       $location.path('/login/');
   };
   
   $scope.isLoggedIn = function() {
       return $scope.currentUser && $scope.currentUser.email;
   };
}]);
