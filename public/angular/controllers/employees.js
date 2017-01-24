app.controller('employeesController', function($scope, $http, API_URL) {
    //retrieve employees listing from API
    $http.get(API_URL + "employee")
            .success(function(response) {
                $scope.employees = response;
                
            });
     //retrieve departments listing from DB       
    $http.post(API_URL + 'departments', {status: 1}).
          success(function(data, status, headers, config) {
            $scope.departments = data;
        });
        
     //retrieve roles listing from DB       
    $http.post(API_URL + 'roles', {status: 1}).
          success(function(data2, status, headers, config) {
            $scope.roles = data2;
        });
    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;
        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Employee";
                break;
            case 'edit':
                $scope.form_title = "Employee Detail";
                $scope.id = id;
                $http.get(API_URL + 'employee/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.employee = response;
                         
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
        var url = API_URL + "employee";
        
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit'){
            url += "/" + id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.employee, $scope.dept),
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
                url: API_URL + 'employee/' + id
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