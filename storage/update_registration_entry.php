<?php 
include 'config/connection.php';
if(!(isset($_SESSION['user_id']))) {
    header("location:index");
    exit;
}

if(isset($_POST['submit'])) {
    $userId = $_POST['hidden_id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $serialNumber = trim($_POST['serial_number']);
    $lintOut = $_POST['lint_out'];
    $toWho = trim($_POST['to_who']);
    $date_time = $_POST['date_time'];
    $tested = $_POST['tested'];
    $byWho = trim($_POST['by_who']);
    $dateTimeTested = $_POST['date_time_tested'];
    $problem = trim($_POST['problem']);
    $message = '';


   
    try {
        $con->beginTransaction();

        $query = "update `form` set 
            `name` = '$name', 
            `description` = '$description', 
            `serial_number` = '$serialNumber' ,
            `lint_out` = '$lintOut',
            `to_who` = '$toWho', 
            `date_time` = '$date_time', 
            `tested` = '$tested',
            `by_who` = '$byWho', 
            `date_time_tested` = '$dateTimeTested', 
            `problem` = '$problem'  
            where `id` = '$userId';";
        $stmt = $con->prepare($query);
        $stmt->execute();

        $con->commit();
        $message = "entry has been updated.";
        
    } catch(PDOException $ex) {
        $con->rollback();
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
        exit;
    }

    $goto = "registration";
    header("location:congratulation?go_to=".$goto."&success_message=".$message); 
    exit;
}

$userId = 0;
$name = '';
$description = '';
$serialNumber = '';
$lintOut = '';
$toWho = '';
$dateTime = '';
$tested = '';
$byWho = '';
$dateTimeTested = '';
$problem = '';
if(isset($_GET['id'])) {
    $userId = $_GET['id'];
    $name = trim($_GET['name']);
    $description = trim($_GET['description']);
    $serialNumber = trim($_GET['serial_number']);
    $lintOut = $_GET['lint_out'];
    $toWho = trim($_GET['to_who']);
    $dateTime = $_GET['date_time'];
    $tested = $_GET['tested'];
    $byWho = trim($_GET['by_who']);
    $dateTimeTested = $_GET['date_time_tested'];
    $problem = trim($_GET['problem']);
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'config/site-css.php';?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'config/top-bar.php';?>

            <?php include 'config/sidebar.php';?>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    Product
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="box">
                        <div class="box-header with-border bg-primary">
                            <h3 class="box-title text-white">Bijwerken Product</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form method="post">
                                <input type="hidden" name="hidden_id" value="<?php echo $userId;?>" />
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Naam</label>
                                        <input type="text" id="name" 
                                               name="name" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $name;?>" />
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Beschrijving</label>
                                        <input type="text" id="description" 
                                               name="description" 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $description;?>" />
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Serie_Nummer</label>
                                        <input type="text" id="serial_number" 
                                               name="serial_number" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $serialNumber;?>" />
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Uitgeleend</label>
                                        <input type="text" id="lint_out" 
                                               name="lint_out" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $lintOut;?>" />
                                        
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Aan_Wie</label>
                                        <input type="text" id="to_who" 
                                               name="to_who" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $toWho;?>" />
                                    </div><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <label>Datum_Tijd</label>
                                        <input type="datetime-local" id="date_time" 
                                               name="date_time" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $dateTime;?>" />
                                    </div><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Getest</label>
                                        <input type="text" id="tested" 
                                               name="tested" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $tested;?>" />
                                    </div><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Door_Wie</label>
                                        <input type="text" id="by_who" 
                                               name="by_who" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $byWho;?>" />
                                    </div><div  class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <label>Datum_Tijd_Getest</label>
                                        <input type="datetime-local" id="date_time_tested" 
                                               name="date_time_tested" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $dateTimeTested;?>" />
                                    </div><div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Probleem</label>
                                        <input type="text" id="problem" 
                                               name="problem" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $problem;?>" />
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                        <label>&nbsp;</label>
                                        <button type="submit" id="submit" name="submit" 
                                                class="btn btn-primary btn-block" 
                                                data-toggle="confirmation" data-placement="top" title="" data-original-title="Are you sure?">Bijwerken</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>


                </section>
            </div>
            <?php include 'config/site-js.php';?>
            <?php include 'config/footer.php';?>

            <div class="control-sidebar-bg"></div>
        </div>


        <!-- Page script -->
        <script>
 $(document).ready(function() {
                showMenuSelected("#mnu_entry", "#mi_registration");
            });
        </script>
    </body>
</html>
