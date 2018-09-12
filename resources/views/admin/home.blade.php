@extends('admin.layout.app')
@section('content')

<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Dashboard</h1>
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
					
				</div>
				<div class="col-lg-7">
					<div class="panel panel-default">
						<div class="panel-heading">Deposits/Withdrawal</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="input-daterange input-group" id="datepicker">
										<span class="input-group-addon">From</span>
										    <input type="text" class="input-sm form-control" id="from" name="start" />
										    <span class="input-group-addon">to</span>
										    <input type="text" class="input-sm form-control" id="to" name="end" />
										    <input type="hidden" id="url" value="http://<?php echo $_SERVER['HTTP_HOST'].'/admin/';?>">
                                            <input type="hidden" id="token" value="{{ csrf_token() }}">
										</div>
								</div>
								<div class="panel panel-container">
								<div class="row">
									<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
										<div class="panel panel-teal panel-widget border-right">
											<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
												<div class="large"> 
												<?php 
				                                    $AmtPndgAppDepoSum = 0; ?>
				                                    @foreach($AmmountPendingApprovelDeposits as $apad)
				                                <?php  

				                                    $AmtPndgAppDepoSum = $AmtPndgAppDepoSum+$apad->amount; 
				                                ?>
				                                    @endforeach
				                                <?php print_r($AmtPndgAppDepoSum);?></div>
												<div class="text-muted">Total Deposit</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
										<div class="panel panel-blue panel-widget border-right">
											<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
												<div class="large">
													<?php 
														$AmtPendAppWitdSum = 0; ?>
														@foreach( $AmmountPendingApprovelWithdrawl as $apaw )
													<?php  
															$AmtPendAppWitdSum = $AmtPendAppWitdSum+$apaw['amount']; 
													?>
														@endforeach
													 <?php print_r($AmtPendAppWitdSum);?>
												</div>
												<div class="text-muted">Total Withdrwal</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
										<div class="panel panel-orange panel-widget border-right">
											<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
												<div class="large">
												<?php $TotAmtAppr_sum = 0; ?>
												@foreach( $TotAmtAppr as $TotAmtAppr )
												<?php 
													
													$TotAmtAppr_sum = $TotAmtAppr_sum+@$TotAmtAppr['amount'];
												?>
												@endforeach
												<?php print_r($TotAmtAppr_sum); ?>
												</div>
												<div class="text-muted">Depostiers</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
										<div class="panel panel-red panel-widget ">
											<div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
												<div class="large"><?php $totwithdrawsum = 0; ?>
												@foreach( $TotAmtWdraw as $totamWith )
												<?php $totwithdrawsum = $totwithdrawsum+@$totamWith['amount'];?>
												@endforeach
												<?php print_r($totwithdrawsum);?></div>
												<div class="text-muted">Total Withdraw</div>
											</div>
										</div>
									</div>
								</div><!--/.row-->
							</div>
						</div>
					</div><!-- /.panel-->
				
				</div>
@endsection  
<?php 
// echo "<pre>";
// print_r($AmtPngApplDepost);
// echo "</pre>";

 ?>