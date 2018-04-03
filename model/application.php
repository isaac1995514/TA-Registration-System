<html>
    <head>
        <link rel="stylesheet" type="text/css" href="app-style.css">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    <form action="$_SERVER[PHP_SELF]" method="post">
        <div class="form-group" id="contact-info">
        <label for="contact-info">Contact Information</label>
            <div class="col-xs-3">
                <label for="last-name">Last Name:</label>
                <input type="text" class="form-control" name="last-name" id="last-name" required>
                <label for="first-name">First Name:</label>
                <input type="text" class="form-control" name="first-name" id="first-name" required>
                <label for="middle-initial">Middle Initial:</label>
                <input type="text" class="form-control" name="middle-initial" id="middle-initial">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" name="email" id="email" required>
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" name="phone" id="phone" required>
            </div>
        </div>
        <div class="form-group" id="student-info">
        <label for="student-info">Student Information</label>
            <div class="col-xs-3">
                <label for="directory-id">Directory ID:</label>
                <input type="text" class="form-control" name="directory-id" id="directory-id" required>
                <label for="uid">University ID:</label>
                <input type="number" class="form-control" name="uid" id="uid" required>
            </div>
            <input type="file" class="form-control-file" name="transcript" accept="application/pdf" value="Upload Transcript">
            <label for="standing">Current Education Level:</label>
            <div class="radio" id="standing">
                <label><input type="radio" name="edu-level" required>Bachelors Student</label>
                <label><input type="radio" name="edu-level">Masters Student</label>
                <label><input type="radio" name="edu-level">Ph.D Student</label>
            </div>
            <label for="department">Department</label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="department" id="department" value="Computer Science">
            </div>
            <label for="advisor">Advisor</label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="advisor" id="advisor">
            </div>
            <div class="container">
                <a href="#table-exp" class="btn btn-info" data-toggle="collapse">Click to Enter Experience</a>
                <div id="table-exp" class="collapse">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>TA'd for Course?</th>
                                <th>Currently TA?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CMSC131</td>
                                <td><input type="checkbox" name="131-past"></td>
                                <td><input type="checkbox" name="131-current"></td>
                            </tr>
                            <tr>
                                <td>CMSC132</td>
                                <td><input type="checkbox" name="132-past"></td>
                                <td><input type="checkbox" name="132-current"></td>
                            </tr>
                            <tr>
                                <td>CMSC216</td>
                                <td><input type="checkbox" name="216-past"></td>
                                <td><input type="checkbox" name="216-current"></td>
                            </tr>
                                <tr>
                                <td>CMSC250</td>
                                <td><input type="checkbox" name="250-past"></td>
                                <td><input type="checkbox" name="250-current"></td>
                            </tr>
                            <tr>
                                <td>CMSC330</td>
                                <td><input type="checkbox" name="330-past"></td>
                                <td><input type="checkbox" name="330-current"></td>
                            </tr>
                            <tr>
                                <td>CMSC351</td>
                                <td><input type="checkbox" name="351-past"></td>
                                <td><input type="checkbox" name="351-current"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group" id="non-us-info">
            <label for="mei-eval">Have you passed the Maryland English Institue?</label>
            <div class="form-group" id="mei-eval">
                <label><input type="radio" name="mei-ans">Yes</label>
                <label><input type="radio" name="mei-ans">No</label>
            </div>
            <label for="umei-course">Are you currently taking a UMEI course?</label>
            <div class="form-group" id="umei-course">
                <label><input type="radio" name="umei-ans">Yes</label>
                <label><input type="radio" name="umei-ans">No</label>
            </div>
        </div>
        <div class="form-group" id="app-prefs">
            <label for="app-time"><u>Preferred Time</u></label>
            <div id="app-time">
                <label for="pos-type-id">Position Type:</label>
                <div class="radio" id="pos-type-id">
                    <label><input type="radio" name="pos-type">Full Time (20hrs/week)</label>
                    <label><input type="radio" name="pos-type">Part Time (10hrs/week)</label>
                </div>
                <label for="semester">Semester:</label>
                <select class="form-control" id="semester">
                    <option>Fall</option>
                    <option>Spring</option>
                    <option>Summer</option>
                </select>
            </div>
            <label for="pref-courses">Select Classes to TA</label>
            <div id="pref-courses">
                <select class="form-control" id="top-courses" multiple>
                    <option>CMSC131</option>
                    <option>CMSC132</option>
                    <option>CMSC216</option>
                    <option>CMSC250</option>
                    <option>CMSC330</option>
                    <option>CMSC351</option>
                </select>
            </div>
        </div>
        <input type="submit" class="btn btn-block" name="submit" value="Submit Application">
    </form>
<?php
?>