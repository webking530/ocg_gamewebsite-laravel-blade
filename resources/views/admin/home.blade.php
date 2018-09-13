@extends('admin.layout.app')
@section('content')

<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">Payments</h2>
				</div>
</div>
<div class="row">
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
			</div>

</div>
<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">Game Stats</h2>
				</div>
</div>
<div class="row">
	<div class="col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading">Most Played Game</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table">
									<thead>
										<tr>
											<th>Game</th>
											<th>Play</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>3d-roulette</td>
											<td>30</td>
										</tr>
										<tr>
										
											<td>slot-machine-space-adventure</td>
											<td>26</td>
										</tr>
										<tr>
											<td>bingo</td>
											<td>22</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
				<div class="col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading">Money Deposited Per Game</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Game</th>
											<th>Money Deposited</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>3d-roulette</td>
											<td>32,000</td>
										</tr>
										<tr>
											<td>slot-machine-space-adventure</td>
											<td>20,000</td>
										</tr>
										<tr>
											<td>craps</td>
											<td>18,000</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
	</div>
	<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">User Stats</h2>
				</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading" style="font-size:15px">Top 10user Earned</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table">
									<thead>
										<tr>
											<th>Player Name</th>
											<th>Earned</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Aack</td>
											<td>55,000</td>
										</tr>
										<tr>
										
											<td>Aliena</td>
											<td>26,000</td>
										</tr>
										<tr>
											<td>Mark</td>
											<td>1,600</td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading" style="font-size:15px">Top 10 Players By Money Deposited</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table">
									<thead>
										<tr>
											<th>Player Name</th>
											<th>Deposited</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Julia</td>
											<td>37,000</td>
										</tr>
										<tr>
										
											<td>Maxy</td>
											<td>5,000</td>
										</tr>
										<tr>
											<td>Taylor</td>
											<td>7,000</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading" style="font-size:15px">Top 10 Players By Money Withdrawn</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table">
									<thead>
										<tr>
											<th>Player</th>
											<th>Withdraw</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Steave</td>
											<td>5000</td>
										</tr>
										<tr>
										
											<td>Yogesh</td>
											<td>2600</td>
										</tr>
										<tr>
											<td>Strauss</td>
											<td>70,000</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading" style="font-size:15px">Unverified user</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table">
									<thead>
										<tr>
											<th>Name</th>
											<th>Country</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Aack</td>
											<td>USA</td>
										</tr>
										<tr>
										
											<td>Aliena</td>
											<td>Germany</td>
										</tr>
										<tr>
											<td>Mark</td>
											<td>Australia</td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
				<div class="col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading" style="font-size:15px">Users By Country</div>
						<div class="panel-body btn-margins">
							<div class="col-md-12">
								<table class="table">
									<thead>
										<tr>
											<th>Name</th>
											<th>Country</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Julia</td>
											<td>Japan</td>
										</tr>
										<tr>
										
											<td>Maxy</td>
											<td>India</td>
										</tr>
										<tr>
											<td>Taylor</td>
											<td>China</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- /.panel-->
				</div>
	</div>
	<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">Upcoming Lottery</h2>
				</div>
	</div>
	<div class="row">
		<div class="col-md-6">
					<div class="panel panel-default ">
						<div class="panel-heading">
							Timeline
							<ul class="pull-right panel-settings panel-button-tab-right">
								<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
									<em class="fa fa-cogs"></em>
								</a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li>
											<ul class="dropdown-settings">
												<li><a href="#">
													<em class="fa fa-cog"></em>
												</a></li>
												<li class="divider"></li>
												<li><a href="#">
													<em class="fa fa-cog"></em>
												</a></li>
												<li class="divider"></li>
												<li><a href="#">
													<em class="fa fa-cog"></em> 
												</a></li>
												<li><a href="#">
													<em class="fa fa-cog"></em>
												</a></li>
												<li><a href="#">
													<em class="fa fa-cog"></em>
												</a></li>
												<li><a href="#">
													<em class="fa fa-cog"></em>
												</a></li>
												<li><a href="#">
													<em class="fa fa-cog"></em>
												</a></li>
												<li><a href="#">
													<em class="fa fa-cog"></em>
												</a></li>

											</ul>
										</li>
									</ul>
								</li>
							</ul>
							<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body timeline-container" style="display: block;">
							<ul class="timeline">
								<li>
									<div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Next lottery date / time (Go to link)</h4>
										</div>
										<div class="timeline-body">
											<p></p>
										</div>
									</div>
								</li>
								<li>
									<div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Minimum pot</h4>
										</div>
										<div class="timeline-body">
											<p></p>
										</div>
									</div>
								</li>
								<li>
									<div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Pot in lottery (amount / currency) (50% of real pot: tickets sold)</h4>
										</div>
										<div class="timeline-body">
											<p></p>
										</div>
									</div>
								</li>
								<li>
									<div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Users participating</h4>
										</div>
										<div class="timeline-body">
											<p></p>
										</div>
									</div>
								</li>
								<li>
									<div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Tickets sold</h4>
										</div>
										<div class="timeline-body">
											<p></p>
										</div>
									</div>
								</li>

								<li>
									<div class="timeline-badge primary"><em class="glyphicon glyphicon-link"></em></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Tickets available</h4>
										</div>
										<div class="timeline-body">
											<p></p>
										</div>
									</div>
								</li>
								<li>
									<div class="timeline-badge"><em class="glyphicon glyphicon-camera"></em></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Estimated earnings: user and casino (50% of real pot? )</h4>
										</div>
										<div class="timeline-body">
											<p></p>
										</div>
									</div>
								</li>
								<li>
									<div class="timeline-badge"><em class="glyphicon glyphicon-paperclip"></em></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
										</div>
										<div class="timeline-body">
											<p></p>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
	</div>
@endsection  
