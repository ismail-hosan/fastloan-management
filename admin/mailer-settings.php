<?php
    include_once "inc/header.php";
    include_once "inc/sidebar.php";
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_smtp'])) {
        $inserted = $mail->addSmtpMailer($_POST);
    }
?>
<h3 class="page-heading mb-4">SMTP Mailer Settings</h3>
<h5 class="card-title p-3 bg-info text-white rounded">Fill up loan details</h5>
<div class="container">
    <?php if (isset($inserted)) { ?>
    <div id="successMessage" class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php  echo $inserted; ?>
    </div>
    <?php } ?>

    <?php 
        $result = $mail->showSmtpMailer();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $host = $row['host'];
            $auth = $row['authentication'];
            $username = $row['username'];
            $pass = $row['password'];
            $pass = base64_decode($pass);
            $port = $row['port'];
            $encrypt = $row['encryption'];
            $from_email = $row['from_email'];
            $from_name = $row['from_name'];
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="myform" id="myform" >
        
        <div class="form-group row">
            <label for="host" class="text-right col-2 font-weight-bold col-form-label">SMTP Host</label>
            <div class="col-sm-9">
                <input type="text" name="host" class="form-control" id="host" value="<?php if ( isset( $host ) ) { echo $host; } ?>">
          </div>
        </div>

        <div class="form-group row">
            <label for="authentication" class="text-right col-2 font-weight-bold col-form-label">SMTP Authentication</label>
            <div class="col-sm-9">
                <select name="authentication" class="form-control" id="authentication">
                    <option value="true" <?php if ($auth == "true") { echo "selected"; } ?>>True</option>
                    <option value="false" <?php if ($auth == "false") { echo "selected"; } ?>>False</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="username" class="text-right col-2 font-weight-bold col-form-label">SMTP Username</label>
            <div class="col-sm-9">
                <input type="text" name="username" class="form-control" id="username" value="<?php if ( isset( $username ) ) { echo $username; } ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="text-right col-2 font-weight-bold col-form-label">SMTP Password</label>
            <div class="col-sm-9">
                <input type="text" name="password" class="form-control" id="password" value="<?php if ( isset( $pass ) ) { echo $pass; } ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="encryption" class="text-right col-2 font-weight-bold col-form-label">Type of Encryption</label>
            <div class="col-sm-9">
                <select name="encryption" class="form-control" id="encryption">
                    <option value="tls" <?php if ($encrypt == "tls") { echo "selected"; } ?>>TLS</option>
                    <option value="ssl" <?php if ($encrypt == "ssl") { echo "selected"; } ?>>SSL</option>
                    <option value="" <?php if ($encrypt == "") { echo "selected"; } ?>>No Encryption</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="port" class="text-right col-2 font-weight-bold col-form-label">SMTP Port</label>
            <div class="col-sm-9">
                <input type="text" name="port" class="form-control" id="port" value="<?php if ( isset( $port ) ) { echo $port; } ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="from-email" class="text-right col-2 font-weight-bold col-form-label">From Email Address</label>
            <div class="col-sm-9">
                <input type="email" name="from-email" class="form-control " id="from-email" value="<?php if ( isset( $from_email ) ) { echo $from_email; } ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="from-name" class="text-right col-2 font-weight-bold col-form-label">From Name</label>
            <div class="col-sm-9">
                <input type="text" name="from-name" class="form-control" id="from-name" value="<?php if(isset($from_name)){echo $from_name;}?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-11 text-center">
            <input type="submit" name="submit_smtp" class="btn btn-info pull-right" value="Save Changes">
            </div>
        </div>

    </form>
</div>
<?php include_once "inc/footer.php"; ?>
