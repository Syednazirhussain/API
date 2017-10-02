<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
?>
<script src="../controller/jquery-2.1.4.min.js"></script>
<script src="../controller/script.js"></script>

<?php include('../View/Layout/header.php'); ?>
        <div class="page">
            <div class="content">
                <!--<div class="popup" data-popup="popup-1">
                    <div class="popup-inner" id="DeleteUser">

                    </div>
                </div>-->
                <table class="table" id="option">
                    <tr>
                        <td style="cursor: pointer;text-decoration: underline"><a>Add new admin</a></td>
                    </tr>
                    <tr>
                        <td style="cursor: pointer;text-decoration: underline" id="new_subject">Add new Course</td>
                    </tr>
                    <tr>
                        <td style="cursor: pointer;text-decoration: underline" id="add_question">Add new question</td>
                    </tr>
                    <tr>
                        <td style="cursor: pointer;text-decoration: underline" id="add_answer">Add answer for question</td>
                    </tr>
                    <tr>
                        <td style="cursor: pointer;text-decoration: underline" id="viewData">Show Data</td>
                    </tr>
                    <tr>
                        <td style="cursor: pointer;text-decoration: underline" id="Course">Show Courses</td>
                    </tr>
                    <tr>
                        <td style="cursor: pointer;text-decoration: underline" id="logout">Log out</td>
                    </tr>
                </table>
                <div id="table"></div>
                <!--<div id="edit">-->

                <form id="ViewCourse">
                    <div class="container">
                        <label><b>Subject Name</b></label>
                        <select  name="subject" id="courseid">
                            <option value="">Choose question</option>
                        </select>
                    </div>
                </form>

                <div id="courseTable"></div>



                <form id="subject">
                    <div class="container">
                        <label><b>Subject Name</b></label>
                        <input type="text" name="subjectname" placeholder="Enter Subject here" id="subjectname" required>
                        <input type="hidden" name="call" value="upload"  required>
                        <label><b>Select Icon</b></label>
                        <input name="image" type="file" />
                        <div class="clearfix">
                            <button type="submit" name="submit"  class="ques_add">Add</button>
                            <button type="button"  class="ques_cancel">Cancel</button>
                        </div>
                    </div>
                </form>

                <form id="question">
                    <div class="container">
                        <label><b>Subject Name</b></label>
                        <select  name="subject" id="subjectid">
                            <option value="">Choose question</option>
                        </select>
                        <label><b>Create Question</b></label>
                        <input type="text" placeholder="Enter Question here" id="questionName" required>
                        <div class="clearfix">
                            <button type="submit" name="submit"  class="ques_add">Add</button>
                            <button type="button"  class="ques_cancel">Cancel</button>
                        </div>
                    </div>
                </form>
                <form id="first">
                        <div class="container">
                            <label><b>Subject Name</b></label>
                            <select  name="question" id="questionid">
                                <option value="">Choose option</option>
                            </select>
                            <label><b>Answer</b></label>
                            <input type="text" placeholder="Enter answer  here" id="answer" required>
                            <div class="clearfix">
                                <button type="submit"  class="ques_add">Add</button>
                                <button type="button" class="ques_cancel">Cancel</button>
                            </div>
                        </div>
                    </form>
                <form id="second">
                    <div class="container">
                        <label><b>Answer</b></label>
                        <input type="text" id="ans" placeholder="Enter answer  here" name="ans" required>
                        <div class="clearfix">
                            <button type="submit" class="ques_add">Add</button>
                            <button type="button" id="update" class="ques_add">Submit</button>
                        </div>
                    </div>
                </form>
                <form id="getSubject">
                        <div class="container">
                            <select  name="subject" id="subid">
                                <option value="-1">Choose subject</option>
                            </select>
                            <select  name="subject" id="quesid">
                                <option value="-1">Choose question</option>
                            </select>
                            <button type="button" class="ques_cancel">Back</button>
                        </div>
                </form>


            </div>
        </div>
<?php include('../View/Layout/footer.php'); ?>

