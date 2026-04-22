<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_admin.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('alert.php'); ?>


<style>

.form-control-feedback {
   pointer-events: auto;
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
     min-width:180px;
}
.msk-fade {  
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.5s;
    animation-name: animatetop;
    animation-duration: 0.5s;
}

.modal-content1 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: 25%; 
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

.dashboard-header {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
    color: white;
    padding: 35px;
    border-radius: 16px;
    margin-bottom: 25px;
    box-shadow: 0 10px 30px rgba(30, 60, 114, 0.3);
    position: relative;
    overflow: hidden;
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}

.dashboard-header::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 200px;
    height: 200px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
}

.dashboard-header h1 {
    color: white;
    margin: 0;
    font-size: 32px;
    font-weight: 700;
    position: relative;
    z-index: 1;
}

.dashboard-header p {
    margin: 8px 0 0 0;
    opacity: 0.9;
    font-size: 16px;
    position: relative;
    z-index: 1;
}

.dashboard-header .header-meta {
    display: flex;
    gap: 20px;
    margin-top: 15px;
    font-size: 14px;
    opacity: 0.85;
    position: relative;
    z-index: 1;
}

.dashboard-header .header-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
}

.stat-card {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    background: white;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.stat-card .info-box {
    border-radius: 16px;
    overflow: hidden;
    background: white;
}

.stat-card .info-box-icon {
    width: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.stat-card .info-box-content {
    padding: 20px;
}

.stat-card .info-box-text {
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 600;
    color: #6c757d;
    letter-spacing: 0.5px;
}

.stat-card .info-box-number {
    font-size: 32px;
    font-weight: 800;
    color: #2c3e50;
    margin-top: 5px;
}

.stat-card .stat-trend {
    font-size: 12px;
    font-weight: 600;
    margin-top: 8px;
}

.stat-card .stat-trend.up {
    color: #10b981;
}

.stat-card .stat-trend.down {
    color: #ef4444;
}

.stat-card .stat-trend i {
    margin-right: 3px;
}

.quick-actions {
    background: white;
    border-radius: 16px;
    padding: 25px;
    margin-top: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.quick-actions h4 {
    margin-top: 0;
    margin-bottom: 20px;
    color: #2c3e50;
    font-weight: 700;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.quick-actions h4::before {
    content: '';
    width: 4px;
    height: 20px;
    background: linear-gradient(to bottom, #1e3c72, #2a5298);
    border-radius: 2px;
}

.quick-action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 15px;
}

.quick-action-btn {
    border-radius: 12px;
    padding: 18px 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: all 0.3s;
    background: linear-gradient(145deg, #f8f9fa, #fff);
    border: 1px solid #e9ecef;
    cursor: pointer;
    text-decoration: none;
    color: #495057;
}

.quick-action-btn:hover {
    background: linear-gradient(145deg, #1e3c72, #2a5298);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
    border-color: transparent;
}

.quick-action-btn i {
    font-size: 24px;
    margin-bottom: 10px;
    width: auto;
}

.quick-action-btn span {
    font-size: 13px;
    font-weight: 600;
    text-align: center;
}

.activity-feed {
    background: white;
    border-radius: 16px;
    padding: 25px;
    margin-top: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.activity-feed h4 {
    margin-top: 0;
    margin-bottom: 20px;
    color: #2c3e50;
    font-weight: 700;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.activity-feed h4::before {
    content: '';
    width: 4px;
    height: 20px;
    background: linear-gradient(to bottom, #10b981, #059669);
    border-radius: 2px;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.activity-icon.payment {
    background: #d1fae5;
    color: #059669;
}

.activity-icon.student {
    background: #dbeafe;
    color: #2563eb;
}

.activity-icon.event {
    background: #fef3c7;
    color: #d97706;
}

.activity-content {
    flex: 1;
}

.activity-content p {
    margin: 0;
    font-size: 14px;
    color: #374151;
}

.activity-content .activity-time {
    font-size: 12px;
    color: #9ca3af;
    margin-top: 4px;
}

.chart-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    margin-top: 25px;
}

.chart-card h4 {
    margin: 0 0 20px 0;
    color: #2c3e50;
    font-weight: 700;
    font-size: 18px;
}

.chart-container {
    position: relative;
    height: 300px;
}

.calendar-modern {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.calendar-modern h4 {
    margin: 0 0 20px 0;
    color: #2c3e50;
    font-weight: 700;
    font-size: 18px;
    text-align: center;
}

#calendar-container {
    background: linear-gradient(145deg, #f8f9fa, #fff);
    border-radius: 12px;
    padding: 15px;
}

#calendar-header {
    text-align: center;
    margin-bottom: 15px;
}

#calendar-header h4 {
    color: #1e3c72;
    font-weight: 700;
    margin: 0;
}

.cal-table {
    width: 100%;
    padding: 0;
    margin: 0;	
}

#calendar_dates {
    padding: 10px;
    margin-left: 10px;
    width: 95%;	
}

.tHead {
    height: 40px;
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    color: #FFF;
    text-align: center;
    border: 1px solid #FFF;
    width: 70px;
    font-weight: 600;
    font-size: 12px;
}

.cal-tr {
    height: 50px;
}

.td_no_number {
    border: 1px solid white;
    width: 70px;
    background-color: #f1f3f5;
    padding: 0;
}

.cal-number-td {
    border: 1px solid white;
    width: 70px;
    background: linear-gradient(145deg, #667eea, #764ba2);
    color: white;
    cursor: pointer;
    transition: all 0.2s;
}

.cal-number-td:hover {
    background: linear-gradient(145deg, #1e3c72, #2a5298);
    transform: scale(1.05);
}

.cal-number-td.today {
    background: linear-gradient(145deg, #10b981, #059669) !important;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.h5 {
    color: #FFF;
    display: inline-block;
    background: rgba(0,0,0,0.3);
    width: 18px;
    height: 18px;	
    font-size: 11px;
    font-weight: bold;
    text-align: center;
    float: right;
    padding-top: 2px;
    margin-bottom: 50%;
    border-radius: 50%;
}

.div-event-c {
    margin-top: 65%;
    height: 17px;
}

#cal_month, #cal_year {
    border-radius: 8px;
    padding: 8px 12px;
    border: 1px solid #dee2e6;
    font-size: 14px;
}

#btnShow {
    margin-left: 5px;
}

.section-title {
    font-size: 20px;
    font-weight: 700;
    color: #2c3e50;
    margin: 30px 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
}

.section-title:first-child {
    margin-top: 0;
}

@media (max-width: 768px) {
    .dashboard-header {
        padding: 25px;
    }
    
    .dashboard-header h1 {
        font-size: 24px;
    }
    
    .stat-card .info-box-number {
        font-size: 24px;
    }
    
    .quick-action-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Dashboard
        	<small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
    	</ol>
	</section>
    
<?php
include_once('../controller/config.php');

$my_index = isset($_SESSION["index_number"]) ? $_SESSION["index_number"] : '';

$sql = "SELECT * FROM admin WHERE index_number='" . mysqli_real_escape_string($conn, $my_index) . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = isset($row['i_name']) ? $row['i_name'] : 'User';

?>  
    
    <!-- Main content -->
    <section class="content">
    
    <div class="dashboard-header">
        <h1><i class="fa fa-graduation-cap"></i> Welcome back, <?php echo htmlspecialchars($name); ?>!</h1>
        <p>Here's what's happening with your school today</p>
        <div class="header-meta">
            <span><i class="fa fa-calendar"></i> <?php echo date('l, F j, Y'); ?></span>
            <span><i class="fa fa-clock-o"></i> <?php echo date('h:i A'); ?></span>
        </div>
    </div>
    
      <!-- Stat cards -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="stat-card">
            <div class="info-box">
              <span class="info-box-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Students</span>
<?php
include_once('../controller/config.php');

$sql1="SELECT count(id) FROM student WHERE _status=''";
$total_count1=0;

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$total_count1=$row1['count(id)'];

?>               
                <span class="info-box-number"><?php echo $total_count1; ?></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="stat-card">
            <div class="info-box">
              <span class="info-box-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);"><i class="fa fa-black-tie"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Teachers</span>
<?php
include_once('../controller/config.php');

$sql2="SELECT count(id) FROM teacher";
$total_count2=0;

$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
$total_count2=$row2['count(id)'];

?> 
                <span class="info-box-number"><?php echo $total_count2; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="stat-card">
            <div class="info-box">
              <span class="info-box-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);"><i class="fa fa-calendar-check-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Monthly Income</span>
<?php
include_once('../controller/config.php');
$current_year=date("Y");
$current_month=date("F");

$sql3="SELECT SUM(paid) FROM student_payment WHERE year='$current_year' AND month='$current_month'";
$monthly_income=0;

$result3=mysqli_query($conn,$sql3);
$row3=mysqli_fetch_assoc($result3);
$monthly_income=$row3['SUM(paid)'];

?>             
                <span class="info-box-number">$<?php echo number_format($monthly_income, 2); ?></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="stat-card">
            <div class="info-box">
              <span class="info-box-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);"><i class="fa fa-line-chart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Income</span>
<?php
include_once('../controller/config.php');

$sql4="SELECT SUM(paid) FROM student_payment";
$total_income=0;

$result4=mysqli_query($conn,$sql4);
$row4=mysqli_fetch_assoc($result4);
$total_income=$row4['SUM(paid)'];

?>             
                <span class="info-box-number">$<?php echo number_format($total_income, 2); ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Quick Actions -->
      <div class="quick-actions">
        <h4><i class="fa fa-bolt"></i> Quick Actions</h4>
        <div class="quick-action-grid">
            <a href="student.php" class="quick-action-btn">
                <i class="fa fa-user-plus"></i>
                <span>Add Student</span>
            </a>
            <a href="teacher.php" class="quick-action-btn">
                <i class="fa fa-user-tie"></i>
                <span>Add Teacher</span>
            </a>
            <a href="grade.php" class="quick-action-btn">
                <i class="fa fa-layer-group"></i>
                <span>Add Grade</span>
            </a>
            <a href="subject.php" class="quick-action-btn">
                <i class="fa fa-book"></i>
                <span>Add Subject</span>
            </a>
            <a href="all_events.php" class="quick-action-btn">
                <i class="fa fa-calendar-plus"></i>
                <span>Create Event</span>
            </a>
            <a href="student_payment.php" class="quick-action-btn">
                <i class="fa fa-money"></i>
                <span>Record Payment</span>
            </a>
        </div>
      </div>
      
      <!-- Charts and Calendar Row -->
      <div class="row">
        <div class="col-md-8">
            <div class="chart-card">
                <h4><i class="fa fa-chart-bar"></i> Monthly Income Overview</h4>
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

<script>

function showBarChart(monthly_income){	
 
	var monthly_income1 = JSON.parse("[" + monthly_income + "]");

	new Chart(document.getElementById("barChart"), {
		type: 'bar',
		data: {
			
		   labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		  datasets: [
			{
			  label: "Monthly Income($)",
			  backgroundColor: [
                "#667eea", "#764ba2", "#6B8DD6", "#8E37D7",
                "#667eea", "#764ba2", "#6B8DD6", "#8E37D7",
                "#667eea", "#764ba2", "#6B8DD6", "#8E37D7"
              ],
			  borderRadius: 8,
			  data: monthly_income1
			}
		  ]
		},
		options: {
		  responsive: true,
          maintainAspectRatio: false,
		  legend: { display: false },
		  title: {
			display: true,
			text: ''
		  },
		  scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true,
                        font: { size: 12 }
					},
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
				}],
				xAxes: [{
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: { size: 12 }
                    }
                }]
			}
		}
	});

};
</script>

<?php
include_once('../controller/config.php');
$current_year=date("Y");
$prefix="";
$monthly_income1="";
$monthly_income2=0;

$month=array("January","February","March","April","May","June","July","August","September","October","November","December");

for($i=0; $i<count($month); $i++){
	
	$sql="SELECT SUM(paid) FROM student_payment WHERE year='$current_year' AND month='$month[$i]'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	$monthly_income1.=$prefix.'"'.$row['SUM(paid)'].'"';
	$prefix=',';
	
}

echo "<script>showBarChart('$monthly_income1');</script>";

?>            
        
        <div class="col-md-4">
            <div class="calendar-modern">
                <h4><i class="fa fa-calendar"></i> <span id="calendar_month_year"></span> <?php echo $current_year; ?></h4>
                <div id="calendar-container">
                    <div id="calendar-header"></div>
                    <input type="hidden" id="my_index" value="<?php echo $my_index; ?>">  
                    <input type="hidden" id="my_type" value="<?php echo $my_type; ?>">                         
                </div>
                <div class="row1" id="row"></div>
            </div>
        </div>
      </div>  
      
<div id="cEvent"></div>
      
<script>

var m2 = 0;

function ShowEvents(status,my_index,my_type){
	
	var d = new Date();    //new Date('2017','08','25');
	var month_name = ['January','February','March','April','May','June','July','August','September','Octomber','November','December'];	
		
	var m1 = d.getMonth(); //0-11
	var y1 = d.getFullYear(); //2017
		
	if(status == 'K'){
		var m3 = m1;
	}
		
	if(status == 'N'){
		m2++;
		var m3 = m1 + m2;
	}
				
	if(status == 'P'){
		m2--;
		var m3 = m1 + m2;
	}
				
	if(m3 == 0){
		$('#btn1').css('pointer-events', 'none');
	}
				
	if(m3 == 11){
		$('#btn2').css('pointer-events', 'none');
	}
	
	var current_date = d.getDate();
		
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200){
					//MSK-00107 
				document.getElementById('row').innerHTML = this.responseText;//MSK-000132
				
				var start_date = $('#start_date').val().split(',');
				var end_date = $('#end_date').val().split(',');
				var color = $('#color').val().split(',');
				var event_id = $('#event_id').val().split(',');
			
				var month = m3; //0-11
				var year = y1; //2017 
				var first_date = month_name[month] + " " + 1 + " " + year;
				
				var tmp = new Date(first_date).toDateString();
				// Tue Aug 01 2017...
				
				var first_day = tmp.substring(0,3); //Thu
				var day_name = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
				var day_no = day_name.indexOf(first_day);  //4
				var days = new Date(year, month+1, 0).getDate(); //31
				// Thu Aug 31 2017...
				
				var calendar = get_calendar(day_no,days);
				
				document.getElementById("calendar_month_year").innerHTML = month_name[month];
				document.getElementById("calendar_dates").appendChild(calendar);
				$("#td_"+current_date).addClass("today");
				 
				var count1 = start_date.length;
				var k=0;
				for(var i=0; i<count1; i++){
					var s_date = parseInt(start_date[i], 10);
					var e_date = parseInt(end_date[i], 10);
					
					var count = e_date - s_date;
				
					for(var j=0; j<=count; j++){
					
						k = s_date+j;
						
						$("#td_"+k).append('<div class="div-event-c" style="background-color:'+color[i]+'"><a id="event_"+'+[i]+' style="color:white;" href="#" onclick="showEvent('+event_id[i]+')"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>');
													
					}
					
					
				}

			}
				
		};	
		
		xhttp.open("GET", "all_events1.php?year=" + y1 + "&month="+m3 + "&my_type="+my_type + "&my_index="+my_index , true);	
		xhttp.send();//MSK-00105-Ajax End
						
};

</script>

	<div id="showEvent">
    
    </div>
    
<script>

function showEvent(event_id){
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('showEvent').innerHTML = this.responseText;//MSK-000132
				$('#modalviewEvent').modal('show');
			}
				
		};	
		
		xhttp.open("GET", "show_events1.php?event_id="+event_id , true);												
		xhttp.send();//MSK-00105-Ajax End
};

function get_calendar(day_no,days){
	
	var table = document.createElement('table');
	var tr = document.createElement('tr');
	
	table.className = 'cal-table';
	
	// row for the day letters
	for(var c=0; c<=6; c++){
		var th = document.createElement('th');
		th.innerHTML =  ['S','M','T','W','T','F','S'][c];
		tr.appendChild(th);
		th.className = "tHead";
		
		
	}
	
	table.appendChild(tr);
	
	//create 2nd row
	
	tr = document.createElement('tr');
	
	var c;
	for(c=0; c<=6; c++){
		
		if(c== day_no){
			break;
		}
		var td = document.createElement('td');
		td.innerHTML = "";
		tr.appendChild(td);
		td.className = "td_no_number";
		tr.className = 'cal-tr';
	}
	
	var count = 1;
	for(; c<=6; c++){
		var td = document.createElement('td');
		td.id = "td_"+count;
		td.className = 'cal-number-td';
		tr.appendChild(td);
		tr.className = 'cal-tr';
		
		var h5 = document.createElement('h5');
		h5.className = 'h5';
		td.appendChild(h5);
		h5.innerHTML = count;
		count++;
		
		
	}
	table.appendChild(tr);
	
	//rest of the date rows
	
	for(var r=3; r<=7; r++){
		tr = document.createElement('tr');
		for(var c=0; c<=6; c++){
			
			if(count > days){
				for(; c<=6; c++){
		
					var td = document.createElement('td');
					td.innerHTML = "";
					tr.appendChild(td);
					td.className = "td_no_number";
					tr.className = 'cal-tr';
				}
				
				table.appendChild(tr);
				return table;
			}
			
			var td = document.createElement('td');
			td.id = "td_"+count;
			td.className = 'cal-number-td';
			tr.appendChild(td);
			
			var h5 = document.createElement('h5');
			h5.className = 'h5';
			td.appendChild(h5);
			h5.innerHTML = count;
			count++;
			tr.className = 'cal-tr';
			
		}
		table.appendChild(tr);
		
		
	}
		
};	

</script>
    

<?php 

$my_index=$_SESSION['index_number'];
$my_type=$_SESSION['type'];

echo '<script>','ShowEvents("K",'.$my_index.',"'.$my_type.'");','</script>';

?>

<!-- Student Registration Chart -->
    <div class="chart-card">
        <h4><i class="fa fa-user-plus"></i> Monthly Student Registration</h4>
        <div class="chart-container">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
		
<script>
                    
function showLineChart(monthly_std_reg){	
 
	var monthly_std_reg1 = JSON.parse("[" + monthly_std_reg + "]");
 
	new Chart(document.getElementById("lineChart"), {
		type: 'line',
		data: {
		  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		  datasets: [
			{
			  label: "New Student Registration",
			  borderColor: "#10b981",
			  backgroundColor: "rgba(16, 185, 129, 0.1)",
			  fill: true,
			  tension: 0.4,
			  pointBackgroundColor: "#10b981",
			  pointBorderColor: "#fff",
			  pointBorderWidth: 2,
			  pointRadius: 5,
			  pointHoverRadius: 7,
			  data: monthly_std_reg1
			}
		  ]
		},
		options: {
		  responsive: true,
          maintainAspectRatio: false,
		  legend: { display: false },
		  title: {
			display: true,
			text: ''
		  },
		  scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true,
                        font: { size: 12 }
					},
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
				}],
				xAxes: [{
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: { size: 12 }
                    }
                }]
			}
		}
	});

};
</script>

<?php
include_once('../controller/config.php');
$current_year=date("Y");
$prefix="";
$monthly_std_reg="";

$month=array("January","February","March","April","May","June","July","August","September","October","November","December");

for($i=0; $i<count($month); $i++){
	$sql="SELECT COUNT(id) FROM student WHERE reg_year='$current_year' AND reg_month='$month[$i]' AND _status=''";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	$monthly_std_reg.=$prefix.'"'.$row['COUNT(id)'].'"';
	$prefix=',';
	
}

echo "<script>showLineChart('$monthly_std_reg');</script>";

?>
<!--redirect your own url when clicking browser back button -->
<script>
(function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("../index.php");//path to when click back button
    },0);
  }
}, false);
}(window, location));
</script>
                 
</div><!-- /.content-wrapper --> 
    
<?php include_once('footer.php'); ?>