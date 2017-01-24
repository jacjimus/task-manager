app.controller('tasksController', function($scope, $http, API_URL) {
    //retrieve categories listing from API
    $http.get(API_URL + "mydata")
            .success(function(response) {
                $scope.mytasks = response;
                
            });
     //retrieve current department       
    $http.post(API_URL + 'my_department', {status: 1}).
          success(function(data, status, headers, config) {
            $scope.my_department = data;
        });
    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Task";
                break;
            case 'view':
                $scope.form_title = "Task Details";
                $scope.id = id;
                $http.get(API_URL + 'task/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.cat = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    }

    //save new record / update existing record
    $scope.save = function(modalstate, id) {
        var url = API_URL + "task";
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'view'){
            url += "/" + id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.mytask),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            console.log(response);
            location.reload();
        }).error(function(response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }

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