@extends('layout.empty')

@section('title', 'Menu Stock')

@push('js')
  <script src="/assets/js/demo/pos-menu-stock.demo.js"></script>
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
				<div class="pos-content-container p-3">
					<div class="row gx-3">
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-1.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Grill Chicken Chop&reg;</div>
									<div class="desc text-truncate">chicken, egg, mushroom, salad</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="20">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product1" checked value="1">
												<label class="form-check-label" for="product1"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-2.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Grill Pork Chop&reg;</div>
									<div class="desc text-truncate">pork, egg, mushroom, salad</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="30">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product2" checked value="1">
												<label class="form-check-label" for="product2"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-3.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Capellini Tomato Sauce&reg;</div>
									<div class="desc text-truncate">spaghetti, tomato, mushroom</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="15">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product3" checked value="1">
												<label class="form-check-label" for="product3"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-4.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Vegan Salad Bowl&reg;</div>
									<div class="desc text-truncate">apple, carrot, tomato</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="10">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product4" checked value="1">
												<label class="form-check-label" for="product4"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-5.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Hawaiian Pizza&reg;</div>
									<div class="desc text-truncate">pizza, crab meat, pineapple</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="10">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product5" checked value="1">
												<label class="form-check-label" for="product5"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-6.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Avocado Shake</div>
									<div class="desc text-truncate">avocado, milk, vanilla</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="0">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product6" value="1">
												<label class="form-check-label" for="product6"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-7.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Coffee Latte</div>
									<div class="desc text-truncate">espresso, milk</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="50">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product7" checked value="1">
												<label class="form-check-label" for="product7"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-8.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Vita C Detox Juice</div>
									<div class="desc text-truncate">apricot, apple, carrot and ginger juice</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="50">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product8" checked value="1">
												<label class="form-check-label" for="product8"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-9.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Pancake</div>
									<div class="desc text-truncate">Non dairy, egg, baking soda, sugar, all purpose flour</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="13">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product9" checked value="1">
												<label class="form-check-label" for="product9"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-10.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Mushroom soup</div>
									<div class="desc text-truncate">Evaporated milk, marsala wine, beef cubes, chicken broth, butter</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="30">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product10" checked value="1">
												<label class="form-check-label" for="product10"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-11.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Baked chicken wing</div>
									<div class="desc text-truncate">Chicken wings, a1 steak sauce, honey, cayenne pepper</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="32">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product11" checked value="1">
												<label class="form-check-label" for="product11"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-12.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Veggie Spaghetti</div>
									<div class="desc text-truncate">Yellow squash, pasta, roasted red peppers, zucchini</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="7">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product12" checked value="1">
												<label class="form-check-label" for="product12"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-13.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Vanilla Ice Cream</div>
									<div class="desc text-truncate">Heavy whipping cream, white sugar, vanilla extract</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="50">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product13" checked value="1">
												<label class="form-check-label" for="product13"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-14.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Perfect Yeast Doughnuts</div>
									<div class="desc text-truncate">Chocolate hazelnut spread, bread flour, doughnuts, quick rise yeast, butter</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="10">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product14" checked value="1">
												<label class="form-check-label" for="product14"></label>
											</div>
											</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-15.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Macarons</div>
									<div class="desc text-truncate">Almond flour, egg whites, heavy cream, food coloring, powdered sugar</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="20">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product15" checked value="1">
												<label class="form-check-label" for="product15"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3">
							<div class="pos-product">
								<div class="img" style="background-image: url(/assets/img/pos/product-16.jpg)"></div>
								<div class="info">
									<div class="title text-truncate">Perfect Vanilla Cupcake</div>
									<div class="desc text-truncate">Baking powder, all purpose flour, plain kefir, vanilla extract</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Stock:</div>
										<div class="flex-1">
											<input type="text" class="form-control" value="16">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<div class="w-100px">Availability:</div>
										<div class="flex-1">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="qty" id="product16" checked value="1">
												<label class="form-check-label" for="product16"></label>
											</div>
										</div>
									</div>
									<div>
										<a href="#" class="btn btn-theme fw-semibold d-block mb-2">Update</a>
										<a href="#" class="btn btn-default fw-semibold d-block">Cancel</a>
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
