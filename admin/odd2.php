<?php
session_start();
//error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['adid']==0)) {
  header('location:logout.php');
  } else{
//submit odds
if(isset($_POST['submit']))
{
$league=($_POST['league']);
$game=($_POST['game']);  
$prediction=($_POST['prediction']);  

$uid=$_SESSION['adid'];

$query=mysqli_query($con,"call sp_addoddtwo('$league','$game','$prediction')"); 
echo "<script>alert('Added odds successfully successfully');</script>";  
echo "<script>window.location.href='odd2.php'</script>";
}
}
if(isset($_GET['delete'])) 
{
$game_id=$_GET['delete'];
$query=mysqli_query($con,"call sp_oddtwogamedeletion('$game_id')"); 
echo "<script>alert('Game deleted');</script>";  
echo "<script>window.location.href='odd2.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Odd 2 Tips</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!--bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       <?php include_once('includes/sidebar.php');?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                    <!-- Topbar Navbar -->
  <?php include_once('includes/topbar.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> Odd 2 Tips today</h1>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">



                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header">
                                Odd 2
                                </div>
                                <div class="card-body">
                                    <form method="post" name="changepwd" onsubmit="return checkpass();">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                 
                 
                                        
                                    <tr>
                                            <th>League</th>
                                            <td>
                                            <input type="text" class="form-control form-control-user" id="league"  name="league" required="true">

                                            </td>
                                    </tr>
                                    <tr>
                                            <th>Game</th>
                                            <td><input type="text" class="form-control form-control-user" id="game" name="game" required="true">
                                            </td>
                                    </tr>
                                    <tr>
                                            <th>Prediction</th>
                                            <td>
                                                
                                            <input type="text" class="form-control form-control-user" id="prediction"  name="prediction" required="true">
                                            </td>
                                    </tr>
                                     
                                </table>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            Submit
                                        </button>
                            </form>
                                </div>
                                <div class="table responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>League</th>
                                                <th>Game</th>
                                                <th>Prediction</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query=mysqli_query($con,"call sp_alloddtwo()");
                                            $cnt=1;
                                            while ($result=mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $result['League'];?></td>
                                                <td><?php echo $result['Game'];?></td>
                                                <td><?php echo $result['Prediction'];?></td>
                                                <td>
                                                <a href="odd2.php?delete=<?php echo $result['id'];?>" onClick="return confirm('Do you really want to delete?');" class="btn btn-danger btn-circle btn-sm" >
                                                <i class="bi bi-trash"></i></a>
                                                </td>
                                                
                                            </tr>
                                            <?php $cnt++;
                                            }  ?>

                                        </tbody>
                                        
                                    </table>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
     <?php include_once('includes/logout-modal.php');?>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
</body>
</html>
<?php  ?>