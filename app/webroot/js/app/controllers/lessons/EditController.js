app.controller('LessonsEditController', ['$scope', '$routeParams', '$q', '$upload', 'Lessons', 'Groups',
function ($scope, $routeParams, $q, $upload, Lessons, Groups) {
    $scope.data = {};
    $scope.id = $routeParams.id;
    $scope.groups = Groups.query();
    $scope.picFile = {};
    
    $scope.onFileSelect = function ($files) {
        var file = $files[0];
        if (!file) {
            return;
        }
        if (file.type.indexOf('image') === -1) {
            $scope.showError('Image extension not allowed, please choose a JPEG or PNG file.');
        }
        if (file.size > 2097152) {
            $scope.showError('File size cannot exceed 2 MB');
        }
        $scope.upload = $upload.upload({
            url: 'images/add',
            data: {fname: $scope.fname},
            file: file
        }).success(function (data, status, headers, config) {
            $scope.data['full_image_url'] = data['fullURL'];
            $scope.data['thumb_url'] = data['thumbURL'];
        });
    };
    
    $scope.clearImage = function () {
        $scope.data['full_image_url'] = '';
        $scope.data['thumb_url'] = '';
    };
    
    $scope.update = function() {
        $scope.data['id'] = $scope.id;
        $scope.data.group_id = $scope.data.group.Group.id;
        Lessons.update($scope.data, function(data) {
            $scope.showError(data.message);
        }, function(response) {
            $scope.showError(response.data);
        });
    };
    
    $scope.getLesson = function() {
        $scope.data = Lessons.get({id: $scope.id});
        $q.all([
            $scope.data.$promise,
            $scope.groups.$promise
        ]).then(function (data) {
            angular.forEach($scope.groups, function (val, key) {
                if (val.Group.id === $scope.data.group_id) {
                    $scope.data.group = val;
                    return false;
                }
            });
        });
    };
    
    $scope.addQuestion = function () {
        if (!$scope.data.Question) {
            $scope.data.Question = [];
        }
        $scope.data.Question.push({});
    };
    
    $scope.deleteQuestion = function (question) {
        var index = $scope.data.Question.indexOf(question);
        $scope.data.Question.splice(index, 1);
    };
    
    $scope.getLesson();
}]);