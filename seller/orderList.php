<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order List</title>
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/sellerstyle.css" charset="utf-8">
    <!-- <link rel="stylesheet" type="text/css" href="css/profilestyle.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/tablestyle.css"> -->
    <link rel="stylesheet" href="../css/orderList.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
     <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script><!--font awesome -->

    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
		<?php require 'asideLeft.php' ?>
		
        <aside class="contentbar"> 

			<div class="container-box">

				<div class="row clearfix">

					<div class="col-md-12 table-responsive">
						<table class="table table-bordered table-hover table-sortable" id="tab_logic">
							<thead>
								<tr >
									<th class="text-center">
										OrderID
									</th>
									<th class="text-center">
										ProductList
									</th>
									<th class="text-center">
										Quantity
									</th>
									<th class="text-center">
										Size
									</th>
									<th class="text-center">
										Require
									</th>
									<th class="text-center"><!--style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;"-->
										Option
									</th>
									<th class="text-center">
										Submit
									</th>
								</tr>
							</thead>

							<tbody>
								<tr id='addr0' data-id="0" class="hidden">
									<td data-name="name">
										<input type="text" name='name0'  placeholder='order Id' class="form-control" readonly/>
									</td>
									<td data-name="mail">
										<input type="text" name='mail0' placeholder='product' class="form-control" readonly/>
									</td>
									<td data-name="mail">
										<input type="text" name='mail0' placeholder='quantity' class="form-control" readonly/>
									</td>
									<td data-name="mail">
										<input type="text" name='mail0' placeholder='size' class="form-control" readonly/>
									</td>
									<td data-name="desc">
										<textarea name="desc0" placeholder="Description" class="form-control" readonly></textarea>
									</td>
									<td data-name="sel">
										<select name="sel0">
											<option value="">Select Option</option>
											<option value="1">Submitted</option>
											<option value="2">Packging</option>
											<option value="3">Shipping</option>
										</select>
									</td>
									<td data-name="del">
										<button name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove submitBtn'><span aria-hidden="true">Update</span></button>
										<!-- <button name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove' style="width:60px"><span aria-hidden="true">×</span></button> -->
									</td>
								</tr>
							</tbody>

						</table>

					</div>

				</div>
				<!-- <tab_logica id="add_row" class="btn btn-primary float-right">Add Row</a> -->
				<button type="submit" id="add_row"  class="btn btn-primary float-right">Upadate</button>
			</div>
        </aside>
    </div>
    <?php require 'footer.php' ?>
</body>
<script src="../js/sellerscript.js"></script>
<script src="../js/orderListscript.js"></script>
</html>