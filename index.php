<?php
require 'script.php';

?>
<!DOCTYPE html>
<html>

<head>
	<title>Lipe To-do </title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card px-3">
                    <div class="card-body">
                        <h3 class="card-title text-center">LIPE To-do list</h3>

                        <form>
	                        <div class="add-items d-flex">
	                        	<input type="hidden" id="todo-id"> 
	                        	<input type="text" class="form-control todo-list-input" placeholder="What to do"> 
	                        	<button class="add btn btn-success font-weight-bold todo-list-add-btn add-todo">Add</button> 
	                        </div>
                    	</form>

                        <div class="list-wrapper">
                            <ul class="d-flex flex-column todo-list">
                           
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./app.js"></script>
</body>
</html>