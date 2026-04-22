<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_admin.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('alert.php'); ?>

<style>
body.modal-open-noscroll { overflow:hidden; }
.msk-fade {  
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s;
}
@keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}
.ai-tool-card {
    border: 2px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    margin: 15px 0;
    background: #f9f9f9;
}
.ai-tool-card:hover {
    border-color: #3c8dbc;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.ai-tool-card h3 { color: #3c8dbc; margin-top: 0; }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-magic"></i> AI Tools
            <small>Magic Wand Features</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">AI Tools</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="ai-tool-card">
                    <h3><i class="fa fa-magic"></i> Notice & Email Writer</h3>
                    <p>Transform rough notes into professional school circulars</p>
                    
                    <div class="form-group">
                        <label>Enter your rough note or idea:</label>
                        <textarea class="form-control" id="aiDraftNotice" rows="4" 
                            placeholder="e.g., School closed tomorrow because of heavy rain. Online classes instead."></textarea>
                    </div>
                    
                    <button type="button" class="btn btn-success" onclick="generateNotice()">
                        <i class="fa fa-magic"></i> Generate Notice
                    </button>
                    <span id="noticeLoading" style="display:none; margin-left:10px;">
                        <i class="fa fa-spinner fa-spin"></i> Generating...
                    </span>
                    
                    <div class="form-group" style="margin-top:15px;">
                        <label>Generated Notice:</label>
                        <textarea class="form-control" id="aiGeneratedNotice" rows="8" 
                            placeholder="AI generated notice will appear here..."></textarea>
                    </div>
                    
                    <button type="button" class="btn btn-default btn-sm" onclick="copyNotice()">
                        <i class="fa fa-copy"></i> Copy to Clipboard
                    </button>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="ai-tool-card">
                    <h3><i class="fa fa-comment"></i> Report Card Comments</h3>
                    <p>Generate constructive comments for students</p>
                    
                    <div class="form-group">
                        <label>Student Name:</label>
                        <input type="text" class="form-control" id="studentName" placeholder="Enter student name">
                    </div>
                    
                    <div class="form-group">
                        <label>Select Traits:</label>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Shows dedication and works hard"> Shows dedication and works hard</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Good behavior and positive conduct"> Good behavior and positive conduct</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Takes initiative and shows leadership"> Takes initiative and shows leadership</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Excellent in Mathematics"> Excellent in Mathematics</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Strong in Languages"> Strong in Languages</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Creative and artistic"> Creative and artistic</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Needs improvement in focus"> Needs improvement in focus</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Needs improvement in Mathematics"> Needs improvement in Mathematics</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="trait" value="Needs improvement in Reading"> Needs improvement in Reading</label>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-success" onclick="generateComment()">
                        <i class="fa fa-magic"></i> Generate Comment
                    </button>
                    <span id="commentLoading" style="display:none; margin-left:10px;">
                        <i class="fa fa-spinner fa-spin"></i> Generating...
                    </span>
                    
                    <div class="form-group" style="margin-top:15px;">
                        <label>Generated Comment:</label>
                        <textarea class="form-control" id="aiGeneratedComment" rows="4" 
                            placeholder="AI generated comment will appear here..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <h4><i class="fa fa-info-circle"></i> AI Powered by Groq</h4>
                    <p>These tools use free AI from Groq (llama-3.3-70b). No API costs!</p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function generateNotice() {
    var draft = document.getElementById('aiDraftNotice').value;
    if (!draft || draft.trim().length < 10) {
        showToast('Please enter at least 10 characters for the AI to work with.', 'warning');
        return;
    }
    
    document.getElementById('noticeLoading').style.display = 'inline';
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../index.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            document.getElementById('noticeLoading').style.display = 'none';
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('aiGeneratedNotice').value = response.notice;
                        showToast('Notice generated successfully!', 'success');
                    } else {
                        showToast('Error: ' + response.error, 'error');
                    }
                } catch (e) {
                    showToast('Error parsing response', 'error');
                }
            } else {
                showToast('Server error: ' + xhr.status, 'error');
            }
        }
    };
    
    xhr.send('do=generate_notice&draft=' + encodeURIComponent(draft));
}

function generateComment() {
    var studentName = document.getElementById('studentName').value;
    var traits = [];
    document.querySelectorAll('input[name="trait"]:checked').forEach(function(cb) {
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

function copyNotice() {
    var notice = document.getElementById('aiGeneratedNotice').value;
    if (notice) {
        navigator.clipboard.writeText(notice).then(function() {
            showToast('Copied to clipboard!', 'success');
        });
    }
}
</script>

<?php include_once('footer.php'); ?>