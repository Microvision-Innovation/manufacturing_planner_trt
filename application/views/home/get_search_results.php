<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);	
$url=base_url()."transactions/employee_loans/";
$num=0;										
	
?>


	<div class="col-md-12 col-sm-12 col-xs-12">
		<table class="table table-hover">
			<thead>
				<tr>													
					<th>Payroll#</th>
					<th>Employee Names</th>
					<th>Department</th>
					<th>Basic Pay</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($search_results as $results): ?>
					<tr>
						<td><a href="<?php echo base_url()."maintenance/employees/employee_details/".$results->id;?>"> <?php echo $results->employee_no;?></a></td>
						<td><a href="<?php echo base_url()."maintenance/employees/employee_details/".$results->id;?>"> <?php echo $results->surname." ".$results->other_names;?></a></td>
						<td> <?php echo $results->department;?></td>
						<td>Ksh <?php echo number_format($results->basic_pay);?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>		
		</table>		
	</div>

