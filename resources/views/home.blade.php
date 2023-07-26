<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <style>
        #formDiv,
        #formDiv_copy {
            display: none;
            position: fixed;
            top: 5%;
            left: 10%;
            z-index: 1213;
            background-color: white;
            padding: 20px;
            width: 50%;
            box-shadow: 3px 3px 3px rgba(128, 128, 128, 0.8);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h1 class="card-title">Student Registration</h1>
                <button class="btn btn-danger" onclick="deleteSelectedRows()">Delete Selected Rows</button>
                <button onclick="toggleAddForm()" class="btn btn-primary">Add new</button>
            </div>
            <div class="card-body">
                <table id="students_table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Branch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr data-id="{{ $student->id }}">
                                <td><input type="checkbox" data-id="{{ $student->id }}"></td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->state }}</td>
                                <td>{{ $student->city }}</td>
                                <td>{{ $student->branch }}</td>
                                <td><a onclick="editForm('{{ $student->id }}','{{ $student->full_name }}','{{ $student->gender }}', '{{ $student->email }}','{{ $student->state }}', '{{ $student->city }}', '{{ $student->branch }}')"
                                        class="btn text-white btn-info">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container" id="formDiv">
                    <form id="registrationForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input required placeholder="Enter full name" type="text" autocomplete="off"
                                class="form-control" name="full_name" id="full_name">
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Gender</label>
                            <select required class="form-control" name="gender" id="gender">
                                <option value="Male">Male</option>
                                <option value="Male">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input required autocomplete="off" placeholder="Enter email" type="email"
                                class="form-control" name="email" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Password</label>
                            <input required autocomplete="off" placeholder="Enter password" type="password"
                                autocomplete="off" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select required class="form-control" name="state" id="state">
                                @foreach ($states as $state)
                                    <option id="{{$state->id}}" value="{{ $state->name }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <select required class="form-control" name="city" id="city">
                                @foreach ($cities as $city)
                                    <option class="{{$city->state_id}}" value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="branch" class="form-label">Branch</label>
                            <input required placeholder="Enter branch" type="text" autocomplete="off"
                                class="form-control" name="branch" id="branch">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a onclick="toggleAddForm()" class="btn btn-secondary">Close</a>
                    </form>
                </div>
                <div class="container" id="formDiv_copy">
                    <form id="registrationForm_copy" method="POST">
                        @csrf
                        <input type="text" hidden id="id" name="id">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input required placeholder="Enter full name" type="text" autocomplete="off"
                                class="form-control" name="full_name" id="full_name_copy">
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Gender</label>
                            <select required class="form-control" name="gender" id="gender_copy">
                                <option value="Male">Male</option>
                                <option value="Male">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input required autocomplete="off" placeholder="Enter email" type="email"
                                class="form-control" name="email" id="email_copy">
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Password</label>
                            <input required autocomplete="off" placeholder="Enter password" type="password"
                                autocomplete="off" class="form-control" name="password" id="password_copy">
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select required class="form-control" name="state" id="state_copy">
                                @foreach ($states as $state)
                                    <option id="{{$state->id}}" value="{{ $state->name }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <select required class="form-control" name="city" id="city_copy">
                                @foreach ($cities as $city)
                                    <option class="{{$city->state_id}}"  value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="branch" class="form-label">Branch</label>
                            <input required placeholder="Enter branch" type="text" autocomplete="off"
                                class="form-control" name="branch" id="branch_copy">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a onclick="toggleAddFormCopy()" class="btn btn-secondary">Close</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validateForm() {
        var fullName = document.getElementById("full_name").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var branch = document.getElementById("branch").value;
        var errors = [];

        if (fullName.trim() === "") {
            errors.push("Please enter your Full Name.");
        }

        if (email.trim() === "") {
            errors.push("Please enter your Email.");
        } else if (!email.includes("@")) {
            errors.push("Please enter a valid Email address.");
        }

        if (password.trim() === "") {
            errors.push("Please enter a Password.");
        }

        if (branch.trim() === "") {
            errors.push("Please enter your Branch.");
        }

        // Display error messages, if any
        if (errors.length > 0) {
            alert(errors.join("\n"));
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }

    function validateForm_copy() {
        var fullName = document.getElementById("full_name_copy").value;
        var email = document.getElementById("email_copy").value;
        var password = document.getElementById("password_copy").value;
        var branch = document.getElementById("branch_copy").value;
        var errors = [];

        if (fullName.trim() === "") {
            errors.push("Please enter your Full Name.");
        }

        if (email.trim() === "") {
            errors.push("Please enter your Email.");
        } else if (!email.includes("@")) {
            errors.push("Please enter a valid Email address.");
        }

        if (password.trim() === "") {
            errors.push("Please enter a Password.");
        }

        if (branch.trim() === "") {
            errors.push("Please enter your Branch.");
        }

        // Display error messages, if any
        if (errors.length > 0) {
            alert(errors.join("\n"));
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>

<script>
    $(document).ready(function() {
        $("#registrationForm").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            if (validateForm()) {
                $.ajax({
                    type: "POST",
                    url: "add-student",
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        var studentsTable = $("#students_table").find("tbody");
                        studentsTable.empty();

                        $.each(response.students, function(index, student) {
                            var row = $("<tr></tr>");
                            row.append($(`<td><input type="checkbox" data-id="` +
                                student.id + `"></td>`));
                            row.append($("<td></td>").text(student.full_name));
                            row.append($("<td></td>").text(student.gender));
                            row.append($("<td></td>").text(student.email));
                            row.append($("<td></td>").text(student.state));
                            row.append($("<td></td>").text(student.city));
                            row.append($("<td></td>").text(student.branch));
                            row.append($(`<td><a onclick="editForm('` + student.id +
                                `','` + student.full_name + `','` + student
                                .gender + `','` + student.email + `','` +
                                student.state + `','` + student.city +
                                `','` + student.branch +
                                `',)" class="btn text-white btn-info">Edit</a></td>`
                            ));
                            studentsTable.append(row);
                        });
                        toggleAddForm();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("An error occurred while submitting the form.");
                    }
                });
            }
        });
        $("#registrationForm_copy").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            if (validateForm_copy()) {
                $.ajax({
                    type: "POST",
                    url: "add-student",
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        var studentsTable = $("#students_table").find("tbody");
                        studentsTable.empty();

                        $.each(response.students, function(index, student) {
                            var row = $("<tr></tr>");
                            row.append($(`<td><input type="checkbox" data-id="` +
                                student.id + `"></td>`));
                            row.append($("<td></td>").text(student.full_name));
                            row.append($("<td></td>").text(student.gender));
                            row.append($("<td></td>").text(student.email));
                            row.append($("<td></td>").text(student.state));
                            row.append($("<td></td>").text(student.city));
                            row.append($("<td></td>").text(student.branch));
                            row.append($(`<td><a onclick="editForm('` + student.id +
                                `','` + student.full_name + `','` + student
                                .gender + `','` + student.email + `','` +
                                student.state + `','` + student.city +
                                `','` + student.branch +
                                `',)" class="btn text-white btn-info">Edit</a></td>`
                            ));
                            studentsTable.append(row);
                        });
                        toggleAddFormCopy();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("An error occurred while submitting the form.");
                    }
                });
            }
        });
    });

    function toggleAddForm() {
        $("#formDiv").toggle();
    }

    function toggleAddFormCopy() {
        $("#formDiv_copy").toggle();
    }

    function editForm(id, name, gender, email, state, city, branch) {
        document.getElementById("id").value = id;
        document.getElementById("full_name_copy").value = name;
        document.getElementById("gender_copy").value = gender;
        document.getElementById("email_copy").value = email;
        document.getElementById("state_copy").value = state;
        document.getElementById("city_copy").value = city;
        document.getElementById("branch_copy").value = branch;
        toggleAddFormCopy();
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function deleteSelectedRows() {
        const table = document.getElementById('students_table');
        const checkboxes = table.querySelectorAll('input[type="checkbox"]:checked');

        const selectedIds = [];
        checkboxes.forEach(checkbox => {
            const id = checkbox.getAttribute('data-id');
            selectedIds.push(id);
        });
        console.log(csrfToken);

        fetch('/delete-students', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ selectedIds: selectedIds })
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    console.error('Error deleting rows.');
                }
            })
            .catch(error => {
                console.error('Error sending data to the server.', error);
            });
    }
</script>

</html>
