<!-- --------------------------------------------------- -->
<!--  Form Details Start -->
<!-- --------------------------------------------------- -->
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
	<div class="card-body px-4 py-3">
		<div class="row align-items-center">
			<div class="col-9">
				<h4 class="fw-semibold mb-8">Form Detail</h4>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="./index.html">Dashboard</a></li>
						<li class="breadcrumb-item" aria-current="page">Form-Detail</li>
					</ol>
				</nav>
			</div>
			<div class="col-3">
				<div class="text-center mb-n5">
					<?=$this->Html->image('/template/images/breadcrumb/ChatBc.png', array('alt' => '', 'class' => 'img-fluiid mb-n4'));?>
				</div>
			</div>
		</div>
	</div>
</div>
<section>
	<!-- Row -->

	<?php
		echo $this->ModernizeComponent->get_table_set(array(
			'id' => 'system_settings',
			'title' => 'Designations',
			'class' => 'table-bordered table-hover',
			'column-headers' => array(
				$this->Paginator->sort('Designation.name', 'Designation Name', array('class' => 'table-header-links')) => array('500px'),
				$this->Paginator->sort('Designation.lock_flag_name', 'Locked', array('class' => 'table-header-links')) => array('100px', 'center'),
				$this->Paginator->sort('Designation.status_name', 'Status', array('class' => 'table-header-links')) => array('100px', 'center')
			),
			'table-settings' => array(
				'model' => 'Designation',
				'controller' => 'designations',
				'prefix' => 'mis',
				'action' => 'designation',
			),
			'table-data' => array(array('test','1','2')),
		));
	?>

	<div class="row">
		<div class="col-lg-12">
			<!-- ---------------------
				start Form with view only
				---------------- -->
			<div class="card">
				<div class="card-header bg-primary">
					<h5 class="mb-0 text-white">Form with view only</h5>
				</div>
				<form class="form-horizontal">
					<div class="form-body">
						<div class="card-body">
							<h5 class="card-title mb-0">Person Info</h5>
						</div>
						<hr class="mt-0 mb-5" />
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>First Name:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">John</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>Last Name:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">Doe</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>Gender:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">Male</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>Date of Birth:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">11/06/1987</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>Category:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">Category1</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>Membership:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">Free</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<h5 class="mb-0">Address</h5>
						</div>
						<hr class="mt-0 mb-5" />
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>Address:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">
												E104, Dharti-2, Near silverstar mall
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>City:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">Bhavnagar</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>State:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">Gujarat</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>Post Code:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">457890</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group row">
										<label class="control-label text-end col-md-3"
											>Country:</label
											>
										<div class="col-md-9">
											<p class="form-control-static">India</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
						</div>
						<hr />
						<div class="form-actions">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn btn-primary">
												<i class="ti ti-edit fs-5"></i>
												Edit
												</button>
												<button type="button" class="btn btn-danger">
												Cancel
												</button>
											</div>
										</div>
									</div>
									<div class="col-md-6"></div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- ---------------------
				start Form with view only
				---------------- -->
		</div>
	</div>
	<!-- Row -->
</section>
<!-- --------------------------------------------------- -->
<!--  Form Details End -->
<!-- --------------------------------------------------- -->