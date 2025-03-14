@extends('layout.empty')

@section('title', 'Kitchen Order')

@push('js')
	<script src="/assets/js/demo/pos-kitchen-order.demo.js"></script>
@endpush

@section('content')
  <!-- BEGIN pos -->
	<div class="pos pos-vertical pos-with-header" id="pos">
		<!-- BEGIN pos-container -->
		<div class="pos-container">
			<!-- BEGIN pos-header -->
			<div class="pos-header">
				<div class="logo">
					<a href="/pos/counter-checkout">
						<div class="logo-img"><i class="fa fa-bowl-rice" style="font-size: 1.5rem;"></i></div>
						<div class="logo-text">Pine & Dine</div>
					</a>
				</div>
				<div class="time" id="time">00:00</div>
				<div class="nav">
					<div class="nav-item">
						<a href="/pos/kitchen-order" class="nav-link">
							<i class="far fa-clock nav-icon"></i>
						</a>
					</div>
					<div class="nav-item">
						<a href="/pos/table-booking" class="nav-link">
							<i class="far fa-calendar-check nav-icon"></i>
						</a>
					</div>
					<div class="nav-item">
						<a href="/pos/menu-stock" class="nav-link">
							<i class="fa fa-chart-pie nav-icon"></i>
						</a>
					</div>
				</div>
			</div>
			<!-- END pos-header -->
		
			<!-- BEGIN pos-content -->
			<div class="pos-content">
				<div class="pos-content-container p-0">
					<div class="pos-task">
						<div class="pos-task-info">
							<div class="h3 mb-1">Table 05</div>
							<div class="mb-3">Order No: #9049</div>
							<div class="mb-2">
								<span class="badge bg-theme text-theme-color fs-14px rounded-1">Dine-in</span>
							</div>
							<div>07:13 time</div>
						</div>
						<div class="pos-task-body">
							<div class="fs-16px mb-3">
								Completed: (1/3)
							</div>
							<div class="row gx-4">
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-2.jpg);"></div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Pork Burger</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- large size<br>
													- extra cheese
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold">Complete</a>
											<a href="#" class="btn btn-default fw-semibold">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-14.jpg);"></div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Macarons</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- serve after dishes
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold">Complete</a>
											<a href="#" class="btn btn-default fw-semibold">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-8.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Vita C Detox Juice</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- large size<br>
													- less ice<br>
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="pos-task">
						<div class="pos-task-info">
							<div class="h3 mb-1">Table 14</div>
							<div class="mb-3">Order No: #9047</div>
							<div class="mb-2">
								<span class="badge bg-theme text-theme-color rounded-1 fs-14px">Dine-in</span>
							</div>
							<div><span class="text-danger">12:13</span> time</div>
						</div>
						<div class="pos-task-body">
							<div class="fs-16px mb-3">
								Completed: (3/4)
							</div>
							<div class="row gx-4">
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-11.jpg);"></div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Baked chicken wing</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- 6 pieces<br>
													- honey source<br>
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold">Complete</a>
											<a href="#" class="btn btn-default fw-semibold">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-12.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Veggie Spaghetti</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- size: large <br>
													- spicy level: light
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-7.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Coffee Latte</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- no sugar<br>
													- more cream
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-1.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Grill Chicken Chop</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- ala carte
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="pos-task">
						<div class="pos-task-info">
							<div class="h3 mb-1">Table 17</div>
							<div class="mb-3">Order No: #9046</div>
							<div class="mb-2">
								<span class="badge text-bg-secondary rounded-1 fs-14px">Dine-in</span>
							</div>
							<div>All dish served<br>12:30 total time</div>
						</div>
						<div class="pos-task-body">
							<div class="fs-16px mb-3">
								Completed: (3/3)
							</div>
							<div class="row gx-4">
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-2.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Pork Burger</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- large size<br>
													- extra cheese<br>
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-10.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Mushroom soup</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- ala carte<br>
													- more cheese<br>
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-8.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Vita C Detox Juice</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- large size<br>
													- less ice<br>
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="pos-task">
						<div class="pos-task-info">
							<div class="h3 mb-1">Table 18</div>
							<div class="mb-3">Order No: #9043</div>
							<div class="mb-2">
								<span class="badge text-bg-secondary rounded-1 fs-14px">Dine-in</span>
							</div>
							<div>All dish served<br>12:30 total time</div>
						</div>
						<div class="pos-task-body">
							<div class="fs-16px mb-3">
								Completed: (2/2)
							</div>
							<div class="row gx-4">
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-13.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Vanilla Ice Cream</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- ala carte
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-9.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Pancake</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- ala carte
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="pos-task">
						<div class="pos-task-info">
							<div class="h3 mb-1">Table 02</div>
							<div class="mb-3">Order No: #9045</div>
							<div class="mb-2">
								<span class="badge text-bg-secondary rounded-1 fs-14px">Take Away</span>
							</div>
							<div>All dish served<br>22:28 total time</div>
						</div>
						<div class="pos-task-body">
							<div class="fs-16px mb-3">
								Completed: (3/3)
							</div>
							<div class="row gx-4">
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-4.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Vegan Salad Bowl&reg;</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- ala carte
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-6.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Avocado Shake</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- ala carte
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
									<div class="pos-task-product completed">
										<div class="pos-task-product-img">
											<div class="cover" style="background-image: url(/assets/img/pos/product-5.jpg);"></div>
											<div class="caption">
												<div>Completed</div>
											</div>
										</div>
										<div class="pos-task-product-info">
											<div class="flex-1">
												<div class="d-flex mb-1">
													<div class="fs-5 mb-0 fw-semibold flex-1 fw-semibold">Hawaiian Pizza&reg;</div>
													<div class="fs-5 mb-0 fw-semibold">x1</div>
												</div>
												<div class="text-body text-opacity-75">
													- ala carte
												</div>
											</div>
										</div>
										<div class="pos-task-product-action">
											<a href="#" class="btn btn-theme fw-semibold disabled">Complete</a>
											<a href="#" class="btn btn-default fw-semibold disabled">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END pos-content -->
		</div>
		<!-- END pos-container -->
	</div>
	<!-- END pos -->
@endsection
