app.controller('tasksController', function($scope, $http, API_URL) {
    //retrieve mytasks listing from API
    $http.get(API_URL + "tasksdata")
            .success(function(response) {
                $scope.mytasks = response;
                
            });
    //retrieve department listing from API
    $http.get(API_URL + "tasksdata/" + 1)
            .success(function(response) {
                $scope.depttasks = response;
                
            });
    //retrieve public listing from API
    $http.get(API_URL + "tasksdata/" + 2)
            .success(function(response) {
                $scope.publictasks = response;
                
            });
     //retrieve current department       
    $http.post(API_URL + 'my_department', {status: 1}).
          success(function(data, status, headers, config) {
            $scope.my_department = data;
        });
     //retrieve current task categories within your department       
    $http.get(API_URL + 'category').
          success(function(data, status, headers, config) {
            $scope.categories = data;
        });
     //retrieve employees within your department       
    $http.get(API_URL + 'empdept').
          success(function(data, status, headers, config) {
            $scope.users = data;
        });
        //retrieve departments listing from DB       
    $http.post(API_URL + 'departments', {status: 1}).
          success(function(data, status, headers, config) {
            $scope.departments = data;
        });
        
        
    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Task";
                $('#myModal').modal('show');
                 break;
            case 'history':
                $scope.form_title = "Task comments";
                $scope.id = id;
                $http.get(API_URL + 'comments/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.comments = response;
                            //alert(response);return false;
                        });
                $('#comments').modal('show');
                break;
            case 'follow':
                $scope.id = id;
                $http.post(API_URL + 'follow/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.comments = response;
                            location.reload();
                        });
                break;
            case 'view':
                $scope.form_title = "Task Details";
                $scope.id = id;
                $http.get(API_URL + 'task/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.task = response;
                        });
             $('#myModal').modal('show');
                break;
                
            case 'close':
            $scope.id = id;
            var isConfirmClose = confirm('Are you sure you want to flag this task as Complete?');
        if (isConfirmClose) {
            $http({
                method: 'POST',
                url: API_URL + 'close/' + id
            }).
                    success(function(data) {
                        console.log(data);
                        location.reload();
                    }).
                    error(function(data) {
                        console.log(data);
                        alert('Unable to close');
                    });
        } else {
            return false;
        }
        break;
            default:
                location.reload();
                break;
        }
        console.log(id);
        
    }

    //save new record / update existing record
    $scope.save = function(modalstate, id) {
        var url = API_URL + "task";
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'view'){
            url += "/" + id;
        }
       // alert($scope.task['attachment'])
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.task),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            console.log(response);
            location.reload();
        }).error(function(response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }
    
//   
//    //check if user follows task
//    $scope.isFollow = function(id) {
//        $scope.id = id;
//                $http.post(API_URL + 'check-follows/' + id)
//                        .success(function(response) {
//                            console.log(response);
//                            return response;
//                            });
//    }
    //delete record
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want to delete this record?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + 'tasks/' + id
            }).
                    success(function(data) {
                        console.log(data);
                        location.reload();
                    }).
                    error(function(data) {
                        console.log(data);
                        alert('Unable to delete');
                    });
        } else {
            return false;
        }
    }
});
app.directive("fileread", [function () {
    return {
        scope: {
            fileread: "="
        },
        link: function (scope, element, attributes) {
            element.bind("change", function (changeEvent) {
                var reader = new FileReader();
                reader.onload = function (loadEvent) {
                    scope.$apply(function () {
                        scope.fileread = loadEvent.target.result;
                    });
                }
                reader.readAsDataURL(changeEvent.target.files[0]);
            });
        }
    }
}]);
