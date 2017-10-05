<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

 <title>Login</title>
 <link href="<?php echo base_url("assests/css/bootstrap.min.css");?>" rel="stylesheet">
  <link href="<?php echo base_url("assests/css/style.css");?>" rel="stylesheet">
<link href="<?php echo base_url("assests/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="<?=admin_url('login');?>" rel="stylesheet" type="style/css">
  </head>
  <body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color: #fff;">E-Attendance</a>
            </div>
            </nav>
	<center>
            <div class="login">
              

			<h1 class="loginheading">Upload Subject CSV</h1>
		<?php echo form_open_multipart('admin/csvInsertSubject'); ?>
            <input type="file" name="file" >
            <input type="submit" class="btn btn-primary">
        </form>
            </div>
	</center>
  </body>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        