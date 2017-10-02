$(document).ready(function(){
 
    $("#login" ).submit(function(event) {

       var formData = {
            'username'       : $('#username').val(),
            'password'       : $('#password').val(),
            'call'           : 'login'
        };
        $.ajax({
                type        : 'POST',
                url         : '../classes/user.php',
                data        : formData,
                dataType    : 'json',
                encode      : true,
            })
        .done(function(data) {
            console.log(data);
            if (data == null){
                $('#status').css( "color", "red" );
                $('#status').text('Login Failed');
            }else{
                $(':input', '#login')
                    .not(':button, :submit, :reset, :hidden')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');
                $("#addUser").trigger('reset');
                document.getElementById("login").reset();
                $('#status').css( "color", "green" );
                $('#status').text('Login Successfull..');
                setInterval(function(){
                    window.location.href = "page.php";
                }, 5000);
                console.log(data);
            }
        });
        event.preventDefault();
    });
    
    $('#logout').click(function () {
        var jsObj = {};
        jsObj['call'] = 'logout';
        $.post( "../classes/user.php",jsObj, function( response ) {
            var data = JSON.parse(response);
            if (data === true){
                window.location.href = "index.php";
            }
        });
    });

    $('#first').hide();
    $('#second').hide();
    $('#subject').hide();
    $('#question').hide();
    $('#getSubject').hide();
    $('#ViewCourse').hide();
   /* $('#table').hide();*/


    $('#new_subject').click(function () {
        $('#ViewCourse').hide();
        $('#subject').show();
        $('#option').hide();
    });

    $("form#subject").submit(function(){

        var formData = new FormData(this);

        $.ajax({
            url: '../classes/helper.php',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                alert(data)
            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });

    $('#Course').click(function () {
        $('#ViewCourse').show();
        var jsonObj = {
            call : 'getAllSubject'
        };
        $.post( "../classes/helper.php",jsonObj, function( data ) {
            html = "";
            var jsObj = JSON.parse(data);
            for(var i=0;i<jsObj['result'].length;i++){
                html += "<option value='"+jsObj['result'][i]['id']+"'>"+jsObj['result'][i]['subject_name']+"</option>";
            }
            $('#courseid').html(html);
        });
    });

    $('#courseid').change(function () {
        /*alert($(this).val());*/
        var jsonObj = {
            'subjectid' : $(this).val(),
            'call' : 'getCourseById'
        };
        $.post( "../classes/helper.php",jsonObj, function( data ) {
            var html = '';
            var jsObj = JSON.parse(data);
            html += '<table class="table">';
            html += '<thead>';
            html += '<th>Course Icon</th>';
            html += '<th>Course Title</th>';
            html += '</thead>';
            html += '<tbody>';
            for (var i=0;i<jsObj['rowsAffected'];i++) {
                html += '<tr>';
                html += '<td class="data"><img src="'+jsObj['result'][i].picPath+'" style="width: 40px;height: 40px;"></td>';
                html += '<td class="data">'+jsObj['result'][i].subject_name+'</td>';
                /*                    html += '<td><a class="edit" id="'+jsObj['result'][i].id+'">Edit</a>&nbsp;/&nbsp;<a data-popup-open="popup-1" class="delete" id="'+jsObj['result'][i].id+'">Delete</a></td>';*/
                html += '</tr>';
            }
            html += '</tbody>';
            html += '</table>';
            $('#courseTable').html(html);
        });
    });

 /*   $("#subject").submit(function(event) {

        var formData = {
            'subject'       : $('#subjectname').val(),
            'call'           : 'AddSubject'
        };
        $.ajax({
                type        : 'POST',
                url         : '../classes/helper.php',
                data        : formData,
                dataType    : 'json',
                encode      : true,
            })
            .done(function(data) {
                console.log(data);
                if (data['rowsAffected'] == 1 && data['status'] ==  'success'){
                    $(':input', '#subject')
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .removeAttr('checked')
                        .removeAttr('selected');
                    $("#addUser").trigger('reset');
                    document.getElementById("subject").reset();
                    alert('Record Inserted successfully..');
                    console.log(data);
                }else{
                    alert('Un Authorized user');
                }
            });
        event.preventDefault();
    });
*/

    var data = {};

    $('#add_question').click(function () {
        $('#ViewCourse').hide();
        $('#option').hide();
        $('#first').hide();
        $('#second').hide();
        $('#subject').hide();
        $('#question').show();
        var jsonObj = {
            call : 'getAllSubject'
        };
        $.post( "../classes/helper.php",jsonObj, function( data ) {
            html = "";
            var jsObj = JSON.parse(data);
            for(var i=0;i<jsObj['result'].length;i++){
                html += "<option value='"+jsObj['result'][i]['id']+"'>"+jsObj['result'][i]['subject_name']+"</option>";
            }
            $('#subjectid').html(html);
        });

    });

    $("#question" ).submit(function(event) {
        var formData = {
            'subjectid'       : $('#subjectid').val(),
            'question'       : $('#questionName').val(),
            'call'           : 'AddQuestions'
        };
        $.ajax({
                type        : 'POST',
                url         : '../classes/helper.php',
                data        : formData,
                dataType    : 'json',
                encode      : true,
            })
            .done(function(data) {
                console.log(data);
                if (data['rowsAffected'] == 1 && data['status'] ==  'success'){
                    $(':input', '#question')
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .removeAttr('checked')
                        .removeAttr('selected');
                    $("#addUser").trigger('reset');
                    document.getElementById("question").reset();
                    alert('Record Update successfully..');
                    console.log(data);
                }else{
                    alert('Un Authorized user');
                }
            });
        event.preventDefault();
    });


    $('#add_answer').click(function () {
        $('#option').hide();
        $('#first').show();
        var jsonObj = {
            call : 'getAllQuestion'
        };
        $.post( "../classes/helper.php",jsonObj, function( data ) {
            html = "";
            var jsObj = JSON.parse(data);
            for(var i=0;i<jsObj['result'].length;i++){
                html += "<option value='"+jsObj['result'][i]['id']+"'>"+jsObj['result'][i]['question']+"</option>";
            }
            $('#questionid').html(html);
        });
    });

    $("#first" ).submit(function(event) {
        data['questionid'] = $('#questionid').val();
        data['a1'] = $('#answer').val();
        $('#ViewCourse').hide();
        $('#first').hide();
        $('#second').show();
        console.log(data);
        event.preventDefault();
    });



    var i = 2;
    $("#second" ).submit(function(event) {
        $('#ViewCourse').hide();
        $('#first').hide();
        $('#second').show();
        data['a'+i] = $('#ans').val();
        $('#ans').val(" ");
        i++;
        $(':input', '#second')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
        $("#addUser").trigger('reset');
        document.getElementById("second").reset();
        event.preventDefault();
    });
    
    $('.ques_cancel').click(function () {
        $('#ViewCourse').hide();
        $('#option').show();
        $('#first').hide();
        $('#subject').hide();
        $('#getSubject').hide();
        $('#question').hide();
        $('#table').hide();
    });

    $('#update').click(function () {
        $('#ViewCourse').hide();
        $('#first').hide();
        $('#second').hide();
        $('#option').show();
        data['call'] = 'AddAnswers';
        console.log(data);
        $.post("../classes/helper.php",data,function (data) {
            var obj = JSON.parse(data);
            if (obj['rowsAffected'] == 1 && obj['status'] ==  'success'){
                alert("Record has been Inserted..");
            }else{
                alert(data);
            }
/*                setInterval(function(){
                    window.location.href = "login.php";
                }, 5000);*/
        });
    });

    var sid = 0,qid = 0;
    search(0,0);

    $('#viewData').click(function () {
        $('#ViewCourse').hide();
        $('#first').hide();
        $('#second').hide();
        $('#option').hide();
        $('#subject').hide();
        $('#getSubject').show();

        var jsonObj = {
            call : 'getAllSubject'
        };
        $.post( "../classes/helper.php",jsonObj, function( data ) {
            html = "";
            var jsObj = JSON.parse(data);

            for(var i=0;i<jsObj['result'].length;i++){
                html += "<option value='"+jsObj['result'][i]['id']+"'>"+jsObj['result'][i]['subject_name']+"</option>";
            }
            $('#subid').html(html);
        });
    });

    $('#subid').change(function(){
        sid = $('#subid').val();

        var jsonObj = {
            subjectId : $('#subid').val(),
            call : 'getquestion'
        };
        $.post( "../classes/helper.php",jsonObj, function( data ) {
            html = "";
            var jsObj = JSON.parse(data);
            for(var i=0;i<jsObj['result'].length;i++){
                html += "<option value='"+jsObj['result'][i]['id']+"'>"+jsObj['result'][i]['question']+"</option>";
            }
            $('#quesid').html(html);
        });
        search(sid,qid);
    });

    $('#quesid').change(function () {
        qid = $('#quesid').val();
        search(sid,qid);
    });

    function search(SID,QID) {
       /* alert(SID+"  "+QID);*/
        if (SID != 0 && QID != 0){
            var jsonObj = {
                subject : SID,
                question : QID,
                call : 'filter'
            };
            $.post( "../classes/helper.php",jsonObj,function (data){
                var html = '';
                var jsObj = JSON.parse(data);
                /*alert(jsObj);*/
              /*  html += '<button class="add" id="add">Add New</button>';*/
                html += '<table class="table">';
                html += '<thead>';
                html += '<th>Subject Name</th>';
                html += '<th>Question</th>';
                html += '<th>Answer</th>';
                html += '</thead>';
                html += '<tbody>';
                for (var i=0;i<jsObj['rowsAffected'];i++) {
                    html += '<tr>';
                    html += '<td class="data">'+jsObj['result'][i].subject_name+'</td>';
                    html += '<td class="data">'+jsObj['result'][i].question+'</td>';
                    html += '<td class="data">'+jsObj['result'][i].ans+'</td>';
/*                    html += '<td><a class="edit" id="'+jsObj['result'][i].id+'">Edit</a>&nbsp;/&nbsp;<a data-popup-open="popup-1" class="delete" id="'+jsObj['result'][i].id+'">Delete</a></td>';*/
                    html += '</tr>';
                }
                html += '</tbody>';
                html += '</table>';
                $('#table').html(html);
                $('#table').show();
            });
        }
    }





});