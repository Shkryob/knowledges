app.controller('LessonsAddController', ['$scope', '$upload', '$location', 'Lessons', 'Groups',
function ($scope, $upload, $location, Lessons, Groups) {
    $scope.data = {};
    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };
    $scope.id = 0;
    $scope.add = true;
    $scope.groups = Groups.query();
    
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
            $scope.data['Image'] = data['image'];
            $scope.data['image_id'] = data['image']['id'];
        });
    };
    
    $scope.clearImage = function () {
        $scope.data['Image'] = {};
        $scope.data['image_id'] = 0;
    };

    $scope.update = function () {
        if ($scope.data.group) {
            $scope.data.group_id = $scope.data.group.Group.id;
        }
        Lessons.save($scope.data, function (data) {
            $location.path('/lessons/' + data['lesson']['id'] + '/')
            $scope.showError(data.message);
        }, function (response) {
            $scope.showError(response.data);
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
}]);