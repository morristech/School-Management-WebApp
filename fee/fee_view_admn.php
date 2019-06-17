<?php
error_reporting(E_ALL & ~E_NOTICE);
include_once('../service/dbcon.php');
session_start();
if (!isset($_SESSION['userid'])) {
	header("Location: ../login/");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Fee Details - SAS</title>
</head>
<body style="padding-top: 3.3%;">
	<link rel="stylesheet" type="text/css" href="../semantic/dist/semantic.min.css">
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../semantic/dist/semantic.min.js"></script>
	<script type="text/javascript">
		function showDiv() {
			document.getElementById('formDiv').style.display="";
		}
		function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    document.getElementById('fig').innerHTML = words_string+" rupees only";
}
	</script>
	<script src="../node_modules/nanobar/nanobar.js"></script>
    <script type="text/javascript">
		  var options = {
		  classname: 'nanobar_class',
		  id: 'my-id',
		  target: document.getElementById('top-menu')
		};

		var nanobar = new Nanobar( options );

		// move bar
		nanobar.go( 30 ); // size bar 30%
		nanobar.go( 76 ); // size bar 76%

		// size bar 100% and and finish
		nanobar.go(100);
    </script>
   <!-- SITE STRATS FROM HERE -->
   <!-- TOP MENU -->
   <div class="ui blue top fixed inverted menu" id="top-menu" style="height: 55px; z-index: 1000" >
   		<div class="item">
   			<img src="../media/logo2.png" style="height:130%; width: 180px;">
   		</div>
		<div class="item"><i class="calendar alternate icon"></i> Academic Year 2018-2019</div>

		
		<!-- <a class="item">Testimonials</a> -->
		
		<div class="right item" >
			<form class="ui form" method="post" action="../search/search_stu.php">
					<div class="field" style="position: relative;">	
						<div class="ui action input">
							<input name="input" placeholder="Search..." type="text">
							<div class="ui compact selection dropdown">
							  <input name="column" type="hidden">
							  <i class="dropdown icon"></i>
							  <div class="default text">Search By</div>
							  <div class="menu">
							    	<div class="item" data-value="admn">Admn</div>
									<div class="item" data-value="doa">D.O.Admn</div>
									<div class="item" data-value="class">Class</div>
									<div class="item" data-value="section">Sec</div>
									<div class="item" data-value="name">Name</div> 
									<div class="item" data-value="surname">Surname</div>
									<div class="item" data-value="dob">D.O.Birth</div>
									<div class="item" data-value="uid">Aadhar UID</div>
									<div class="item" data-value="religion">Religion</div>
									<div class="item" data-value="gender">Gender</div>
									<div class="item" data-value="caste">Caste</div>
									<div class="item" data-value="subcaste">Subcaste</div>
									<div class="item" data-value="childid">ChildID</div>
									<div class="item" data-value="f_name">Fr.Name</div>
									<div class="item" data-value="f_occup">Fr.Occup</div>
									<div class="item" data-value="f_qual">Fr.Qual</div>
									<div class="item" data-value="f_uid">Fr.UID</div>
									<div class="item" data-value="f_phno">Fr.Phno</div>
									<div class="item" data-value="address">Address</div>
									<div class="item" data-value="m_name">Mr.Name</div>
									<div class="item" data-value="m_occup">Mr.Occup</div>
									<div class="item" data-value="m_qual">Mr.Qual</div>
									<div class="item" data-value="m_uid">Mr.UID</div>
									<div class="item" data-value="m_tongue">Mr.Tongue</div>
									<div class="item" data-value="prev_school">Prev_School</div>
									<div class="item" data-value="idmark1">Idmark1</div>
									<div class="item" data-value="idmark2">Idmark2</div>
									<div class="item" data-value="hostel">Admn Type</div>
							  </div>
							</div>
							<button name="menu" type="submit" class="ui teal icon button"><i class="search icon"></i></button>
						</div>
					</div>
				</form>
		</div>

		<a class="item" href="<?php echo '../login/index.php?logout=true'; ?>"><i class="sign out alternate icon"></i>Log-out</a>
		<a class="item">
			<img class="ui avatar image" src="../media/user.png">
			<span><?php echo (isset($_SESSION['userid']))?$_SESSION['userid']:'GUEST'; ?></span>
		</a>
	</div>
	<!-- SIDE MENU -->
	<div class="ui bottom attached segment" >
	  	<div class="ui visible fixed inverted left vertical sidebar menu" id="sidebar" style="padding-top: 4%">
	  		<div class="ui styled inverted fluid accordion item">
			    
				<div>
					<a href="../dashboard/" class="item"><i class=" icon"></i><i class="dashboard icon"></i><b>Dashboard</b></a>
				</div>
				<div class="divider ui"></div>

			    <div>
				    <a class="title item">
				      Student
				      <i class="dropdown icon"></i>
				      <i class="users icon"></i>
				    </a>
				    <div class="content">
					    <a class="item" href="../student/stu_view.php">
					      <i class="user icon"></i>
					      View Admission
					    </a>
					    <a class="item" href="../student/stu_add.php">
					      <i class="user plus icon"></i>
					      New Admission
					    </a>
					    <a class="item" href="../student/stu_rem.php">
					      <i class="user times icon" ></i>
					      Remove Admission
					    </a>
				    </div>
				</div>

				<div>
				    <a class="active title item">
				      Fee
				      <i class="dropdown icon"></i>
				      <i class="money icon"></i>
				    </a>
				    <div class="active content">
				    	<a class="item" href="../fee/fee_pay.php">
					      <i class="rupee icon"></i>
					      Pay Fee
					    </a>
					    <a class="active item" href="../fee/fee_view_admn.php">
					      <i class="info circle icon"></i>
					      View Fee Details
					    </a>
					    <a class="item"  href="../fee/fee_view_rcpt.php">
					      <i class="print icon"></i>
					      View/Print Reciept
					    </a>
				    </div>
				</div>


				<div>
				    <a class="title item">
				      Vehicle
				      <i class="dropdown icon"></i>
				      <i class="car icon"></i>
				    </a>
				    <div class="content">
				    	<a class="item" href="../vehicle/vehicle_add.php">
					      <i class="add icon"></i>
					      Add Vehicle
					    </a>
					    <a class="item" href="../vehicle/vehicle_stu_entry.php">
					      <i class="child icon"></i>
					      Student Entry
					    </a>
					    <a class="item"  href="../vehicle/vehicle_list.php">
					      <i class="print icon"></i>
					      Vehicles List
					    </a>
				    </div>
				</div>
				<div class="ui divider"></div>
				<div>
				    <a class="title item">
				      View/Print List
				      <i class="dropdown icon"></i>
				      <i class="file alternate icon"></i>
				    </a>
				    <div class="content">
				    	<a class="item" href="../list/class_list.php">
					      <i class="users icon"></i>
					      Class List
					    </a>
					    <a class="item" href="../list/caste_list.php">
					      <i class="users icon"></i>
					      Caste List
					    </a>
					    <a class="item"  href="../list/religion_list.php">
					      <i class="users icon"></i>
					       Religion List
					    </a>
					    <a class="item"  href="../list/vehi_bal_list.php">
					      <i class="car icon"></i>
					       Vehicle-Student List
					    </a>
				    </div>
				</div>
				<div>
				    <a class="title item" href="../search/search_stu.php">
				      Search
					  <i class="searh icon"></i>
				      <i class="search icon"></i>

				    </a>
				</div>
				

				<div>
				    <a class="title item">
				      Certificate
				      <i class="dropdown icon"></i>
				      <i class="certificate icon"></i>
				    </a>
				    <div class="content">
				    	<a class="item" href="../certificate/study_certificate.php">
					      <i class="certificate icon"></i>
					      Study Certificate
					    </a>
				    </div>
				</div>

				<div>
				    <a class="title item">
				     Finance & Statistics
					  <i class="dropdown icon"></i>
				      <i class="calculator icon"></i>
				    </a>
				    <div class="content">
				    	<a href="../finance/daily.php" class="item"><i class="calendar icon"></i>Daily A/c</a>
				    	<a href="../finance/monthly.php" class="item"><i class="calendar outline icon"></i>Monthly A/c</a>
				    	<a href="../finance/yearly.php" class="item"><i class="calendar alternate icon"></i>Annual A/c</a>
				    </div>
				</div>
				<div class="ui divider"></div>
			
				<div>
				    <a class="item" href="../service/coming_soon.php">
				      <b>SMS</b>
					  <i class="searh icon"></i>
				      <i class="mail icon"></i>

				    </a>
				</div>
				<div>
				    <a class="item" href="../service/coming_soon.php">
				    <b>Attendance & Exams</b>
					  <i class="searh icon"></i>
				      <i class="pie chart icon"></i>
				    </a>

				</div>
				<div>
				    <a class="title item" >
				      Settings
					  <i class="dropdown icon"></i>
				      <i class="configure icon"></i>
				    </a>
				     <div class="content">
				    	<a href="../setting/class_wise_fee.php" class="item"><i class="edit icon"></i>Modify Class Fees</a>
				    	<a href="../setting/view_user.php" class="item"><i class="browser icon"></i>View Users</a>
				    	<a href="../setting/add_user.php" class="item"><i class="add user icon"></i>Add User</a>
				    	<a href="../setting/export_db.php" class="item"><i class="database icon"></i>Export Database</a>
				    	<a href="../setting/dev_info.php" class="item"><i class="spy icon"></i>Ask for Help</a>
				    </div>
				</div>

				

	  		</div>
	  	</div>
	  	<div class="pusher" style="position: relative;left:-20%; top: 5%; width:150%;" >
	  		<div class="ui raised very padded text container segment" style="position: relative; left: -10%; bottom:40%;">
	  			<!-- BOX CREATED HERE -->
	  			<div class="ui form error" id="notfound" style="display: none;">
					 <div class="ui error message">
					    <div class="header">Admission Not Found</div>
					    <p>The following student is not found in the Admission records</p>
					 </div>
				</div>

	  			<h2 class="ui center aligned icon header">
				  <i class="info circle icon"></i>
				 	View Fee Details
				</h2>

				<form class="ui form" method="post" action="#">
					<div class="eight wide field">
					 	<div class="ui action input" style="position: relative; left: 50%;">
						  <input placeholder="Admission No..." name="admn" type="number">
						  <button type="submit" name="search" class="ui button">Search</button>
					  	</div>
				  	</div>
				</form>

				<?php
					if(isset($_POST['search'])){
						error_reporting(E_ALL & ~E_NOTICE);
						$admn = $_POST['admn'];

						$search_pay_fee = "SELECT surname, name, f_name, d.class class, section, address,f.*,c.fee fee,(term1+term2+term3+term4) total, (c.fee-(term1+term2+term3+term4)) bal FROM stu_data d,stu_fee f,class_fee c WHERE d.admn = $admn AND f.admn = $admn AND c.class = d.class ";

						$result = mysqli_query($con,$search_pay_fee);
						if (!$result) {
							echo "ERROR";
						}
						elseif (!$row = mysqli_fetch_array($result)) {
							echo '<script type="text/javascript">document.getElementById("notfound").style.display="";</script>';
						}
					}
				?>
				

				<div class="ui grid" id="cardgrid" style="display: none;">
					<div class="column" style="padding-top: 40px; left: 24.5%">
						<div class="ui cards">
		                    <div class="card">
		                        <div class="content">
		                            <img class="right floated mini ui image" src="img/avatar/animals/dinosaur_128px.png">
		                            <div class="header">
		                                <?php echo $row['name']." ".$row['surname'];?>
		                            </div>
		                            <div class="meta">
		                               <?php echo "S/D/o :".$row['f_name'];?>
		                            </div>
		                            <div class="description">
		                               	<?php echo "Class : ".$row['class']." ".$row['section'] ; ?>
		                            </div>
		                             <div class="description">
		                               	<?php echo "Admission No : ".$admn ; ?>
		                            </div>
		                        </div>
		                        <div class="extra content">
		                            <a>
		                                <i class="home icon"></i>
		                                <?php echo $row['address'] ; ?>
		                            </a>
			                     </div>
		                    </div>
		                </div>
		            </div>
	            </div>
            	<div class="ui segments" id="table" style="display: none; padding-bottom: 2.5%">
                    <div class="ui segment">
                        <h3 class="ui header" style="padding-left:42%">
                            Fee Details*
                        </h3>
                    </div>
                    <div class="ui segment">
                        <table class="ui definition table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Amount (in Rs)</th>
                                    <th>Reciept No.</th>
                                </tr>
                            </thead>
                            <tbody  style="text-align: center;">
                                <tr class="<?php echo(($row['term1'])?"positive":"negative"); ?>">
                                    <td style="width: 33%;">Term 1</td>
                                    <td><?php echo $row['term1'];?></td>
                                    <td><?php echo $row['rcpt_term1'];?></td>
                                </tr>
                                <tr class="<?php echo(($row['term2'])?"positive":"negative"); ?>">
                                    <td style="width: 33%;">Term 2</td>
                                    <td><?php echo $row['term2'];?></td>
                                    <td><?php echo $row['rcpt_term2'];?></td>
                                </tr>
                                <tr class="<?php echo(($row['term3'])?"positive":"negative"); ?>">
                                    <td style="width: 33%;">Term 3</td>
                                    <td><?php echo $row['term3'];?></td>
                                    <td><?php echo $row['rcpt_term3'];?></td>
                                </tr>
                                <tr class="<?php echo(($row['term4'])?"positive":"negative"); ?>">
                                    <td style="width: 33%;">Term 4</td>
                                    <td><?php echo $row['term4'];?></td>
                                    <td><?php echo $row['rcpt_term4'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 33%;"><b>Total Paid</b></td>
                                    <td><b><?php echo $row['total'];?></b></td>
                                    <td id="fig"></td>
                                    <script type="text/javascript">
                                    	convertNumberToWords('<?php echo $row['total'];?>');
                                    </script>
                                    
                                </tr>
                            </tbody>
                        </table>
                        <h4 style="padding-left: 32%; ">Class Fee <span style="padding-left: 10%">:</span>  <span style="padding-left: 7%"><?php echo "    ".$row['fee']."/- Rs"; ?></span></h4>
                        <h4 style="padding-left: 27%;  position: relative; bottom: 15px ">( - ) Total Paid <span style="padding-left: 9%;">:</span>  <span style="padding-left: 7%"><?php echo "    ".$row['total']."/- Rs"; ?></span></h4>
                        <div class="ui divider" style="position: relative; bottom: 23px; width: 50%; left: 25%"></div>
                        <h3 style="padding-left: 32% ; position: relative; bottom: 40px">Balance <span style="padding-left: 9%">:</span> <span style="padding-left: 7%"><?php echo "    ".$row['bal']."/- Rs"; ?></span></h3>
                    </div>
                </div>

	            <?php
                error_reporting(E_ALL & ~E_NOTICE);
                if ($row) {
							echo '<script type="text/javascript">document.getElementById("cardgrid").style.display="";</script>';
							echo '<script type="text/javascript">document.getElementById("table").style.display="";</script>';

						}
                ?>
	            
			</div>
			<div class="ui vertical footer segment form-page" style="height: 15px;">
			  <div class="ui container" style="text-align: center; position: relative; bottom:10px; right: 10%">
			    <span style="font-size: 11px;">Suman Michael 2018. All rights reserved</span>
			  </div>
			</div>
		</div>





<script type="text/javascript">
	$('.ui.accordion').accordion();
	$('.visible.example .ui.sidebar')
  .sidebar({
    context: '.visible.example .bottom.segment'
  })
  .sidebar('hide');

   $('.ui.dropdown')
  .dropdown()


$('.ui.sticky')
  .sticky({
    context: '#context'
  })
;

 $('.special.cards .image').dimmer({on: 'hover'});



</script>


</body>
</html>