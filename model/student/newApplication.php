
<?php
    require_once("studentSupport.php");
    $content = <<<CONTENT
    <form action="$_SERVER[PHP_SELF]" method="post">
    <div class="col-xs-4">
        <div class="form-group" id="student-info">
            <label for="directory-id">Directory ID</label>
            <input type="text" class="form-control" name="directory-id" id="directory-id" required>
            <label for="transcript">Upload Transcript</label>
            <input type="file" class="form-control-file" name="transcript" accept="application/pdf" value="Upload Transcript" id="transcript">
            <div class="container">
                    <a href="#table-exp" class="btn btn-info" data-toggle="collapse">Click to Enter Experience</a>
                    <div id="table-exp" class="collapse">
                        <table class="table" id="exp-table">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Have you been a TA for this class in past?</th>
                                    <th>Are you currently a TA for this class?</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>CMSC131</td>
                                    <td><input type="checkbox" name="CMSC131-past"></td>
                                    <td><input type="checkbox" name="CMSC131-current"></td>
                                </tr>
                                <tr>
                                    <td>CMSC132</td>
                                    <td><input type="checkbox" name="CMSC132-past"></td>
                                    <td><input type="checkbox" name="CMSC132-current"></td>
                                </tr>
                                <tr>
                                    <td>CMSC216</td>
                                    <td><input type="checkbox" name="CMSC216-past"></td>
                                    <td><input type="checkbox" name="CMSC216-current"></td>
                                </tr>
                                    <tr>
                                    <td>CMSC250</td>
                                    <td><input type="checkbox" name="CMSC250-past"></td>
                                    <td><input type="checkbox" name="CMSC250-current"></td>
                                </tr>
                                <tr>
                                    <td>CMSC330</td>
                                    <td><input type="checkbox" name="CMSC330-past"></td>
                                    <td><input type="checkbox" name="CMSC330-current"></td>
                                </tr>
                                <tr>
                                    <td>CMSC351</td>
                                    <td><input type="checkbox" name="CMSC351-past"></td>
                                    <td><input type="checkbox" name="CMSC351-current"></td>
                                </tr>
                                <tr>
                                    <td><button type="button" class="btn btn-default" aria-label="Left Align" onclick="addClass(this.parentNode.parentNode.parentNode.parentNode);">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <div class="form-group">
            <div class="radio">
                <fieldset>
                    <legend>Position Type</legend>
                    <label><input type="radio" name="pos-type">Full Time (20hrs/week)</label>
                    <label><input type="radio" name="pos-type">Part Time (10hrs/week)</label>
                </fieldset>
            </div>
                <label for="semester">Semester:</label>
                <select class="form-control" id="semester">
                    <option>Fall</option>
                    <option>Spring</option>
                    <option>Summer</option>
                </select>
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
    </div>
    </form>
CONTENT;

$content = generatePage($content, "New Application", "app-style.css");
echo $content;

?>

