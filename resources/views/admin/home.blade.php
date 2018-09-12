@extends('admin.layout.app')
@section('content')
<div class="panel panel-container">

 
				<div class="row">
					<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
						<div class="panel panel-teal panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
								<h5>Total amount pending for approval in deposit</h5>
								<div class="text-muted">
									<?php 
									$AmtPndgAppDepoSum = 0; ?>
									@foreach($AmmountPendingApprovelDeposits as $apad)
								<?php  

									$AmtPndgAppDepoSum = $AmtPndgAppDepoSum+$apad->amount; 
								?>
									@endforeach
								<?php print_r($AmtPndgAppDepoSum);?>
								</div>
							</div>
							<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
								<h5>Total amount pending for approval in wthdrwal</h5>
								<div class="text-muted">
								<?php 
									$AmtPendAppWitdSum = 0; ?>
									@foreach( $AmmountPendingApprovelWithdrawl as $apaw )
								<?php  
										$AmtPendAppWitdSum = $AmtPendAppWitdSum+$apaw['amount']; 
								?>
									@endforeach
								 <?php print_r($AmtPendAppWitdSum);?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
						<div class="panel panel-blue panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
								<h5>Total amount approved by depositers  </h5>
								<div class="text-muted">
									<?php $TotAmtAppr_sum = 0; ?>
									@foreach( $TotAmtAppr as $TotAmtAppr )
									<?php 
										
										$TotAmtAppr_sum = $TotAmtAppr_sum+$TotAmtAppr['amount'];
									?>
									@endforeach
									<?php print_r($TotAmtAppr_sum); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
						<div class="panel panel-orange panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
								<h5>Total amount withdrwan</h5>
								<div class="text-muted">
									<?php $totwithdrawsum = 0; ?>
									@foreach( $TotAmtWdraw as $totamWith )
									<?php $totwithdrawsum = $totwithdrawsum+$totamWith['amount'];?>
									@endforeach
									<?php print_r($totwithdrawsum);?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
						<div class="panel panel-red panel-widget ">
							<div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
								<div class="large">25.2k</div>
								<div class="text-muted">Page Views</div>
							</div>
						</div>
					</div>
				</div><!--/.row-->
			</div>
<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Tables</h1>
				</div>
</div>
<div class="col-lg-5">
					<div class="panel panel-default">
						<div class="panel-heading">Account Table</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table">
									<thead>
										<tr>
											<th></th>
											<th>Account</th>
											<th>User</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach( $deposit_data as $approved_detail ){
											// echo "<pre>";
											// print_r($approved_detail);
											// echo "</pre>";
										?>
										<?php
										
										?>
										<tr>
											<td></td>
											<td><?php echo $approved_detail['method'];?></td>
											<!--<td><?php //echo $approved_detail[''];?></td>
											<td><?php //echo $approved_detail[''];?></td>-->
											<td><?php echo $approved_detail['user']['name'];?></td>
											<td><?php echo $approved_detail['created_at'];?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
					<div class="panel panel-default">
						<div class="panel-heading">Striped Table</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Row</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>John</td>
											<td>Carter</td>
											<td>johncarter@mail.com</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Peter</td>
											<td>Parker</td>
											<td>peterparker@mail.com</td>
										</tr>
										<tr>
											<td>3</td>
											<td>John</td>
											<td>Rambo</td>
											<td>johnrambo@mail.com</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
				<div class="col-lg-7">
					<div class="panel panel-default">
						<div class="panel-heading">Bordered Table</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<div class="row">
									<div class"Formleft">
										From:<input type="text" id="datepicker">
									</div>
									<div class="Toright">
										To:<input type="date" name="to" id="to">
									</div>
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Total Pending For Approvel</th>
											<th>Total Ammount Provided</th>
											<th>Total Ammount Withdrawl</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Col 1</td>
											<td>Col 2</td>
											<td>Col 3</td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
					<div class="panel panel-default">
						<div class="panel-heading">Table with Hover</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Row</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>John</td>
											<td>Carter</td>
											<td>johncarter@mail.com</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Peter</td>
											<td>Parker</td>
											<td>peterparker@mail.com</td>
										</tr>
										<tr>
											<td>3</td>
											<td>John</td>
											<td>Rambo</td>
											<td>johnrambo@mail.com</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
@endsection  
