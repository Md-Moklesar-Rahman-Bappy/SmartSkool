<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<table id="table_exam_mark" class="table">
	<thead>
    	<th class="col-md-2">Subject</th>
        <th class="col-md-3">Marks</th>
    </thead>
	<tbody class="tBody">
<?php
include_once('../controller/config.php');
$index_number=$_GET['index'];
$exam=$_GET['exam'];
$current_year=date('Y');

$sql="SELECT * FROM student_grade WHERE index_number='$index_number' and year='$current_year'";	  
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$grade_id=$row['grade_id'];

	$sql1="select subject.name as s_name,subject.id as s_id
	       from exam_timetable
		   inner join subject_routing
		   on exam_timetable.grade_id=subject_routing.grade_id and exam_timetable.subject_id=subject_routing.subject_id
		   inner join student_subject
		   on student_subject.sr_id=subject_routing.id
		   inner join subject
		   on subject_routing.subject_id=subject.id
		   where exam_timetable.grade_id='$grade_id' and subject_routing.grade_id='$grade_id' and student_subject.year='$current_year' and  	student_subject.index_number='$index_number'";	  
	
	$result1=mysqli_query($conn,$sql1);
	$count=0;
	while($row1=mysqli_fetch_assoc($result1)){
	
		$count++;
?>			
		<tr id="tr_<?php echo $count; ?>">
        	<input type="hidden" name="subject_id[]" id="eSubject_id_<?php echo $count; ?>" value="<?php echo $row1['s_id']; ?>">
            <input type="hidden" name="grade" value="<?php echo $grade_id; ?>"/>
        	<td id="eSubject_td_<?php echo $count; ?>"><?php echo $row1['s_name']; ?></td>
            <td id="eMark_td_<?php echo $count; ?>"><input type="text" class="mark-grade form-control" id="eMark_text_<?php echo $count; ?>" name="eMark[]"  placeholder="85" autocomplete="off"/></td>
        </tr>

<?php	} ?>
	</tbody>
</table>

<div class="panel panel-info" style="margin-top:15px;">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" href="#commentGenerator"><i class="fa fa-comment"></i> AI Report Card Comment Generator</a>
		</h4>
	</div>
	<div id="commentGenerator" class="panel-collapse collapse">
		<div class="panel-body">
			<div class="form-group">
				<label>Select Student Traits (check all that apply):</label>
				<div class="row" style="margin-left:5px;">
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Shows dedication and works hard"> Shows dedication and works hard</label>
					</div>
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Good behavior and positive conduct"> Good behavior and positive conduct</label>
					</div>
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Takes initiative and shows leadership"> Takes initiative and shows leadership</label>
					</div>
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Excellent in Mathematics"> Excellent in Mathematics</label>
					</div>
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Strong in Languages"> Strong in Languages</label>
					</div>
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Creative and artistic"> Creative and artistic</label>
					</div>
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Needs improvement in focus"> Needs improvement in focus</label>
					</div>
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Needs improvement in Mathematics"> Needs improvement in Mathematics</label>
					</div>
					<div class="col-md-4">
						<label><input type="checkbox" name="trait[]" value="Needs improvement in Reading"> Needs improvement in Reading</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="aiStudentName">Student Name:</label>
				<input type="text" class="form-control" id="aiStudentName" placeholder="Enter student name" style="width:250px;">
			</div>
			<button type="button" class="btn btn-success" onclick="generateReportComment()">
				<i class="fa fa-magic"></i> Generate Comment
			</button>
			<span id="commentLoading" style="display:none; margin-left:10px;">
				<i class="fa fa-spinner fa-spin"></i> Generating...
			</span>
			<div class="form-group" style="margin-top:10px;">
				<label for="aiGeneratedComment">Generated Comment:</label>
				<textarea class="form-control" id="aiGeneratedComment" rows="3" readonly placeholder="Comment will appear here..."></textarea>
			</div>
		</div>
	</div>
</div>

<script>
function generateReportComment() {
    var studentName = document.getElementById('aiStudentName').value;
    var traits = [];
    document.querySelectorAll('input[name="trait[]"]:checked').forEach(function(cb) {
        traits.push(cb.value);
    });
    
    if (!studentName) {
        showToast('Please enter the student name.', 'warning');
        return;
    }
    
    if (traits.length === 0) {
        showToast('Please select at least one trait.', 'warning');
        return;
    }
    
    document.getElementById('commentLoading').style.display = 'inline';
    document.getElementById('aiGeneratedComment').value = '';
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../index.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('commentLoading').style.display = 'none';
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById('aiGeneratedComment').value = response.comment;
                    showToast('Comment generated successfully!', 'success');
                } else {
                    showToast('Error: ' + response.error, 'error');
                }
            } catch (e) {
                showToast('Error parsing response', 'error');
            }
        }
    };
    
    var postData = 'do=generate_comment&student_name=' + encodeURIComponent(studentName);
    traits.forEach(function(trait) {
        postData += '&traits[]=' + encodeURIComponent(trait);
    });
    
    xhr.send(postData);
}
</script>