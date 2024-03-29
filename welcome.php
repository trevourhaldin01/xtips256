<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{
    
   
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Management System in PHP Using Stored Procedure</title>
    <!-- custom css -->
    <link href="css/custom-css.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
         <?php include_once('includes/client-sidebar.php');?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               <?php include_once('includes/topbar.php');?>
                <!-- End of Topbar -->

                
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Welcome Back--- <?php echo $_SESSION['fname'];?></h1>
                    <div class="container ">
                    <div class="row bg-body-tertiary ">
                        <div class="col-lg-8 mx-auto ">
                        <h2 class="text-center pb-5 fw-bolder">Services offered to our subscribers</h2>
                        <div class="row column-gap-3">
                            <div class="col-md-4  text-center  p-3 ">
                            <i class="bi bi-star-fill h3"></i>
                            <i class="bi bi-star-fill h3"></i>
                            
                            <a href=""><h4>Sure odd 2</h4></a><br>
                            
                            <p>Subscribe to daily betting tips that accumulate upto 2 odds </p>
                            <form action="rave/subscribe.php" method="POST">
                                <select id="subscriptionOption" class="form-select border border-primary text-center p-2 mb-3" aria-label="odd 2 subscribe options" onchange="updateAmount()">
                                    <option selected>OPEN FOR OPTIONS</option>
                                    <option value="odd2weekly">ODD 2 FOR A WEEK</option>
                                    <option value="odd2monthly">ODD 2 FOR A MONTH</option>
                                    
                                </select>
                                <!-- Hidden input field to store the selected option -->
                                <input type="hidden" id="selectedOption" name="selectedOption">
                                
                                
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Amount</label>
                                    <input type="number" id="disabledTextInput"  name="amount" class="form-control" placeholder="Amount" readonly>
                                </div>
                                <button type="submit" name="subscribe" onclick="submitForm()" class="bg-primary text-light border-0 rounded p-3">SUBSCRIBE</button>

                            </form>
                            


                            </div>
                            <div class="col-md-4 text-center custom-hover p-3">
                            <i class="bi bi-star-fill h3 "></i>
                            <i class="bi bi-star-fill h3"></i>
                            <i class="bi bi-star-fill h3"></i>
                            <a href=""><h4>Sure odd 3</h4></a>
                            <br>
                            <p>Subscribe to daily betting tips that accumulate upto 3 odds </p>
                            </div>
                            <div class="col-md-4 text-center custom-hover p-3">
                            <i class="bi bi-star-fill h3"></i>
                            <i class="bi bi-star-fill h3"></i>
                            <i class="bi bi-star-fill h3"></i>
                            <i class="bi bi-star-fill h3"></i>
                            <i class="bi bi-star-fill h3"></i>
                            <a href="" class=""><h4 class="">Sure odd 5</h4></a>
                            <br>
                            <p>Subscribe to daily betting tips that accumulate upto 5 odds </p>
                            </div>

                        </div>
                        </div>
                    </div>
                    </div>
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
         <?php include_once('includes/footer.php');?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

      <?php include_once('includes/logout-modal.php');?>
    
    <script>
        var selectedAmount = ""; // Variable to store the selected amount

        function updateAmount() {
            var selectBox = document.getElementById("subscriptionOption");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;

            // Set the selected amount based on the selected option
            if (selectedValue === "odd2weekly") {
                selectedAmount = "49000"; // Set your desired amount for this option
            } else if (selectedValue === "odd2monthly") {
                selectedAmount = "120000"; // Set your desired amount for this option
            } else {
                selectedAmount = ""; // Set default value or leave it empty if no option is selected
            }

            // Update the amount field with the selected amount
            document.getElementById("disabledTextInput").value = selectedAmount;

            // Update the hidden input field with the selected option value
            document.getElementById("selectedOption").value = selectedValue;
        }

        // Submit form function
        function submitForm() {
            var selectedOption = document.getElementById("selectedOption").value;
            // Update the hidden input field with the selected option value
             selectedOption = document.getElementById("subscriptionOption").value;
            if (!selectedOption) {
            alert("Please select an option before submitting.");
            return; // Prevent form submission if selectedOption is not set
            }

            // Submit the form
            document.getElementById("subscriptionForm").submit();
        }
    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
<?php } ?>