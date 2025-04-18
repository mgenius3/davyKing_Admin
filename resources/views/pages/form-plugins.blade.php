@extends('layout.default')

@section('title', 'Form Plugins')

@push('css')
	<link href="/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet">
	<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="/assets/plugins/bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
	<link href="/assets/plugins/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet">
	<link href="/assets/plugins/summernote/dist/summernote-lite.css" rel="stylesheet">
	<link href="/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet">
	<link href="/assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet">
	<link href="/assets/plugins/jquery-typeahead/dist/jquery.typeahead.min.css" rel="stylesheet">
@endpush

@push('js')
	<script src="/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="/assets/plugins/moment/min/moment.min.js"></script>
	<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="/assets/plugins/bootstrap-slider/dist/bootstrap-slider.min.js"></script>
	<script src="/assets/plugins/jquery-typeahead/dist/jquery.typeahead.min.js"></script>
	<script src="/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="/assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
	<script src="/assets/plugins/blueimp-tmpl/js/tmpl.min.js"></script>
	<script src="/assets/plugins/blueimp-load-image/js/load-image.all.min.js"></script>
	<script src="/assets/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.min.js"></script>
	<script src="/assets/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/jquery.iframe-transport.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-process.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-image.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-audio.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-video.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-validate.js"></script>
	<script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-ui.js"></script>
	<script src="/assets/plugins/summernote/dist/summernote-lite.min.js"></script>
	<script src="/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js"></script>
	<script src="/assets/plugins/select-picker/dist/picker.min.js"></script>
	<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="/assets/js/demo/highlightjs.demo.js"></script>
	<script src="/assets/js/demo/form-plugins.demo.js"></script>
	<script src="/assets/js/demo/sidebar-scrollspy.demo.js"></script>
@endpush

@section('content')
	<!-- BEGIN container -->
	<div class="container">
		<!-- BEGIN row -->
		<div class="row justify-content-center">
			<!-- BEGIN col-10 -->
			<div class="col-xl-10">
				<!-- BEGIN row -->
				<div class="row">
					<!-- BEGIN col-9 -->
					<div class="col-xl-9">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">FORMS</a></li>
							<li class="breadcrumb-item active">FORM PLUGINS</li>
						</ul>
						
						<h1 class="page-header">
							Form Plugins <small>page header description goes here...</small>
						</h1>
						
						<hr class="mb-4">
						
						<!-- BEGIN #bootstrapDatepicker -->
						<div id="bootstrapDatepicker" class="mb-5">
							<h4>Bootstrap datepicker</h4>
							<p>Bootstrap datepicker provides a flexible datepicker widget in the Bootstrap style. Please read the <a href="https://bootstrap-datepicker.readthedocs.io/en/latest/index.html" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-2">
									<form>
										<div class="row">
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Default <span class="text-danger">*</span></label>
													<input type="text" class="form-control" id="datepicker-default" placeholder="dd/mm/yyyy">
												</div>
											</div>
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Component <span class="text-danger">*</span></label>
													<div class="input-group">
														<input type="text" class="form-control" id="datepicker-component" placeholder="with input group addon">
														<label class="input-group-text" for="datepicker-component"><i class="fa fa-calendar"></i></label>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Range <span class="text-danger">*</span></label>
													<div class="input-group input-daterange" id="datepicker-range">
														<input type="text" class="form-control" name="start" placeholder="start date">
														<span class="input-group-text">to</span>
														<input type="text" class="form-control" name="end" placeholder="end date">
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-1.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #bootstrapDatepicker -->
						
						<!-- BEGIN #bootstrapDaterangepicker -->
						<div id="bootstrapDaterangepicker" class="mb-5">
							<h4>Bootstrap daterangepicker</h4>
							<p>Bootstrap daterangepicker provides a component for choosing date ranges, dates and times. Please read the <a href="http://www.daterangepicker.com/" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-2">
									<form>
										<div class="row">
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Default Date Ranges</label>
													<div class="input-group" id="default-daterange">
														<input type="text" name="default-daterange" class="form-control" value="" placeholder="click to select the date range">
														<label class="input-group-text"><i class="fa fa-calendar"></i></label>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Advance Date Ranges</label>
													<div id="advance-daterange" class="btn btn-theme d-flex align-items-center text-start">
														<span class="text-truncate">&nbsp;</span>
														<i class="fa fa-caret-down ms-auto"></i>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-2.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #bootstrapDaterangepicker -->
						
						<!-- BEGIN #bootstrapTimepicker -->
						<div id="bootstrapTimepicker" class="mb-5">
							<h4>Bootstrap timepicker</h4>
							<p>Bootstrap timepicker provide an easy way to select a time for a text input using your mouse or keyboards arrow keys. Please read the <a href="https://jdewit.github.io/bootstrap-timepicker/" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-2">
									<form>
										<div class="row">
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Default <span class="text-danger">*</span></label>
													<div class="input-group bootstrap-timepicker timepicker">
														<input id="timepicker-default" type="text" class="form-control">
														<span class="input-group-addon input-group-text">
															<i class="fa fa-clock"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">24hr mode and seconds enabled <span class="text-danger">*</span></label>
													<div class="bootstrap-timepicker timepicker">
														<input id="timepicker-seconds" type="text" class="form-control" value="1:00:00">
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Minute Step 5 <span class="text-danger">*</span></label>
													<div class="bootstrap-timepicker timepicker">
														<input type="text" data-provide="timepicker" data-minute-step="5" data-template="false" class="form-control" value="7:00:00" data-show-meridian="false" data-show-seconds="true">
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-3.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #bootstrapTimepicker -->
						
						<!-- BEGIN #bootstrapSlider -->
						<div id="bootstrapSlider" class="mb-5">
							<h4>Bootstrap slider</h4>
							<p>Bootstrap slider provides single handle that can be moved with the mouse or by using the arrow keys. Please read the <a href="https://seiyria.com/bootstrap-slider/" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-2">
									<form>
										<div class="row">
											<div class="col-md-9">
												<div class="mb-3">
													<label class="form-label">Default <span class="text-danger">*</span></label>
													<div>
														<input id="slider-default" class="form-control" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14">
													</div>
												</div>
												<div class="mb-3">
													<label class="form-label">Range <span class="text-danger">*</span></label>
													<div>
														<div class="clearfix">
															<b class="pull-right">€ 1000</b>
															<b>€ 10</b>
														</div>
														<input id="slider-range" class="form-control" type="text" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]">
													</div>
												</div>
												<div class="mb-3">
													<label class="form-label">Tooltip (always show) <span class="text-danger">*</span></label>
													<div>
														<input id="slider-tooltip" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14">
													</div>
												</div>
												<div class="form-group m-b-5">
													<label class="form-label">Disabled <span class="text-danger">*</span></label>
													<div>
														<input id="slider-disabled" class="form-control" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="5" data-slider-enabled="false">
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="mb-3">
													<label>Vertical <span class="text-danger">*</span></label>
													<div>
														<input id="slider-vertical" class="form-control" type="text" data-slider-min="-5" data-slider-max="20" data-slider-step="1" data-slider-value="-3" data-slider-orientation="vertical">
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-4.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #bootstrapSlider -->
						
						<!-- BEGIN #jqueryTypeahead -->
						<div id="jQueryTypeahead" class="mb-5">
							<h4>jQuery typeahead</h4>
							<p>The jQuery Typeahead Search is a simple plugin that suggest search results from the character(s) that were typed in the search bar using JavaScript. Please read the <a href="http://www.runningcoder.org/jquerytypeahead/documentation/" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<form>
										<div class="row">
											<div class="col-xl-8">
												<div class="typeahead__container mb-1">
													<label class="form-label">Default <span class="text-danger">*</span></label>
													<div class="typeahead__field">
														<div class="typeahead__query input-group">
															<span class="input-group-text"><i class="fa fa-search"></i></span>
															<input class="form-control" name="country_v1[query]" id="typeahead" placeholder="Type 'af'" autocomplete="off">
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-5.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #jqueryTypeahead -->
						
						<!-- BEGIN #jQueryTagIt -->
						<div id="jQueryTagIt" class="mb-5">
							<h4>jQuery Tag It</h4>
							<p>jQuery Tag It is a jQuery plugin providing a Simple and configurable tag editing widget with autocomplete support. Please read the <a href="http://aehlke.github.io/tag-it/" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<form>
										<div class="mb-2">
											<label class="form-label">Default <span class="text-danger">*</span></label>
											<ul id="jquery-tagit" class="tagit form-control">
												<li>fancy</li>
												<li>new</li>
												<li>tag</li>
												<li>demo</li>
											</ul>
										</div>
										<p class="form-text mb-0">
											You may enter the text (c++, java, php, javascript, ruby, python) for autocomplete preview
										</p>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-6.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #jQueryTagIt -->
						
						<!-- BEGIN #jQueryMarksedInput -->
						<div id="jQueryMarksedInput" class="mb-5">
							<h4>jQuery masked input</h4>
							<p>jQuery masked input allows a user to more easily enter fixed width input where you would like them to enter the data in a certain format. Please read the <a href="https://github.com/excellalabs/jquery.maskedinput#readme" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-2">
									<form>
										<div class="row">
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Date <span class="text-danger">*</span></label>
													<input type="text" id="masked-input-date" class="form-control" placeholder="mm/dd/yyyy">
												</div>
											</div>
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Phone <span class="text-danger">*</span></label>
													<input type="text" id="masked-input-phone" class="form-control" placeholder="(999) 999-9999">
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-7.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #jQueryMarksedInput -->
						
						<!-- BEGIN #jQueryFileUpload -->
						<div id="jQueryFileUpload" class="mb-5">
							<h4>jQuery file upload</h4>
							<p>File Upload widget with multiple file selection, drag&drop support, progress bars, validation and preview images, audio and video for jQuery. Please read the <a href="https://blueimp.github.io/jQuery-File-Upload/" target="_blank">official documentation</a> for the full list of options.</p>
							<form id="fileupload" action="//jquery-file-upload.appspot.com/" name="file_upload_form" method="POST" enctype="multipart/form-data">
								<div class="card">
									<div class="card-body pb-2">
										<div class="fileupload-buttonbar mb-2">
											<div class="d-block d-lg-flex align-items-center">
												<span class="btn btn-theme fileinput-button me-2 mb-1">
													<i class="fa fa-fw fa-plus"></i>
													<span>Add files...</span>
													<input type="file" name="files[]" multiple>
												</span>
												<button type="submit" class="btn btn-outline-default me-2 mb-1 start">
													<i class="fa fa-fw fa-upload"></i>
													<span>Start upload</span>
												</button>
												<button type="reset" class="btn btn-outline-default me-2 mb-1 cancel">
													<i class="fa fa-fw fa-ban"></i>
													<span>Cancel upload</span>
												</button>
												<button type="button" class="btn btn-outline-default me-2 mb-1 delete">
													<i class="fa fa-fw fa-trash"></i>
													<span>Delete</span>
												</button>
												<div class="form-check ms-2 mb-1">
													<input type="checkbox" id="toggle-delete" class="form-check-input toggle">
													<label for="toggle-delete" class="form-check-label">Select Files</label>
												</div>
											</div>
										</div>
										<div id="error-msg"></div>
									</div>
									<table class="table table-card mb-0 fs-13px">
										<thead>
											<tr class="fs-12px">
												<th class="pt-2 pb-2 w-25">PREVIEW</th>
												<th class="pt-2 pb-2 w-25">FILENAME</th>
												<th class="pt-2 pb-2 w-25">SIZE</th>
												<th class="pt-2 pb-2 w-25">ACTION</th>
											</tr>
										</thead>
										<tbody class="files">
											<tr class="empty-row">
												<td colspan="4" class="text-center p-3">
													<div class="text-inverse text-opacity-30 mb-2"><i class="fa fa-file-archive fa-3x"></i></div> 
													No file uploaded
												</td>
											</tr>
										</tbody>
									</table>
									<div class="hljs-container rounded-bottom">
										<pre><code class="xml" data-url="/assets/data/form-plugins/code-8.json"></code></pre>
									</div>
								</div>
							</form>
						</div>
						<!-- END #jQueryFileUpload -->
						
						<!-- BEGIN #summernote -->
						<div id="summernote" class="mb-5">
							<h4>Summernote</h4>
							<p>Summernote is a super simple WYSIWYG Editor on Bootstrap. It allows you to edit the HTML tag and preview it. Please read the <a href="https://summernote.org/" target="_blank">official documentation</a> for the full list of options.</p>
							
							<div class="card">
								<form>
									<textarea name="text" class="summernote" id="contents" title="Contents">
<div class="clearfix pt-3 pb-3">
<img src="/assets/img/gallery/gallery-1.jpg" alt="" width="283" class="rounded float-start me-3 mb-3">
<div>
<h3 class="mt-0">Summernote</h3>
<p class="mb-0">
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu sollicitudin est. Cras et feugiat magna. Fusce sit amet euismod sem, pellentesque pellentesque risus. Quisque id lobortis quam. Nulla non magna vel ipsum volutpat malesuada dapibus sit amet elit. Quisque iaculis placerat lorem vel vestibulum. Maecenas nisi lacus, finibus vel massa vitae, hendrerit aliquet urna.
	Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam egestas commodo varius. Aliquam enim ante, pharetra eu augue sed, dignissim semper mauris. Mauris fringilla arcu libero. Proin maximus enim quis diam condimentum, vel feugiat sapien sodales. Aliquam erat volutpat. Sed lorem nunc, commodo molestie ante ac, varius elementum neque. Nunc sem erat, varius vel sapien a, ultrices condimentum dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
</p>
</div>
</div>
<hr>
<div class="clearfix pt-3 pb-3">
<img src="/assets/img/gallery/gallery-2.jpg" alt="" width="283" class="rounded float-end ms-3 mb-3">
<div>
<h2 class="mt-0">Easy to Install</h2>
<p class="mb-0">
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu sollicitudin est. Cras et feugiat magna. Fusce sit amet euismod sem, pellentesque pellentesque risus. Quisque id lobortis quam. Nulla non magna vel ipsum volutpat malesuada dapibus sit amet elit. Quisque iaculis placerat lorem vel vestibulum. Maecenas nisi lacus, finibus vel massa vitae, hendrerit aliquet urna.
	Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam egestas commodo varius. Aliquam enim ante, pharetra eu augue sed, dignissim semper mauris. Mauris fringilla arcu libero. Proin maximus enim quis diam condimentum, vel feugiat sapien sodales. Aliquam erat volutpat. Sed lorem nunc, commodo molestie ante ac, varius elementum neque. Nunc sem erat, varius vel sapien a, ultrices condimentum dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
</p>
</div>
</div>
									</textarea>
								</form>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-9.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #summernote -->
						
						<!-- BEGIN #selectPicker -->
						<div id="selectPicker" class="mb-5">
							<h4>Select picker</h4>
							<p>Select picker is jQuery plugin for multiselect tag-like picker. Please read the <a href="https://picker.uhlir.dev/" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-2">
									<form>
										<div class="row">
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Default <span class="text-danger">*</span></label>
													<select class="form-control" id="ex-basic">
														<option>Mustard</option>
														<option>Ketchup</option>
														<option>Relish</option>
													</select>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Multiple SelectBox <span class="text-danger">*</span></label>
													<select class="selectpicker form-control" id="ex-multiselect" multiple>
														<optgroup label="Picnic">
															<option>Mustard</option>
															<option>Ketchup</option>
															<option>Relish</option>
														</optgroup>
														<optgroup label="Camping">
															<option>Tent</option>
															<option>Flashlight</option>
															<option>Toilet Paper</option>
														</optgroup>
													</select>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Live Search <span class="text-danger">*</span></label>
													<select class="selectpicker form-control" id="ex-search" multiple>
														<option value="1">Mustard</option>
														<option value="2">Ketchup</option>
														<option value="3">Relish</option>
														<option value="4">Tent</option>
														<option value="5">Flashlight</option>
														<option value="6">Toilet Paper</option>
													</select>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-10.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #bootstrapSelect -->
						
						<!-- BEGIN #spectrumColorpicker -->
						<div id="spectrumColorpicker" class="mb-5">
							<h4>Spectrum colorpicker</h4>
							<p>Spectrum is a jQuery plugin for colorpicker. Please read the <a href="https://seballot.github.io/spectrum/" target="_blank">official documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-2">
									<form>
										<div class="row">
											<div class="col-xl-6">
												<div class="mb-3">
													<label class="form-label">Default <span class="text-danger">*</span></label>
													<input type="text" value="#007aff" class="form-control" id="colorpicker-default">
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-plugins/code-11.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #spectrumColorpicker -->
					</div>
					<!-- END col-9-->
					<!-- BEGIN col-3 -->
					<div class="col-xl-3">
						<!-- BEGIN #sidebar-bootstrap -->
						<nav id="sidebar-bootstrap" class="navbar navbar-sticky d-none d-xl-block">
							<nav class="nav text-nowrap">
								<a class="nav-link" href="#bootstrapDatepicker" data-toggle="scroll-to">Bootstrap datepicker</a>
								<a class="nav-link text-nowrap" href="#bootstrapDaterangepicker" data-toggle="scroll-to">Bootstrap daterangepicker</a>
								<a class="nav-link" href="#bootstrapTimepicker" data-toggle="scroll-to">Bootstrap timepicker</a>
								<a class="nav-link" href="#bootstrapSlider" data-toggle="scroll-to">Bootstrap slider</a>
								<a class="nav-link" href="#jQueryTypeahead" data-toggle="scroll-to">jQuery Typeahead</a>
								<a class="nav-link" href="#jQueryTagIt" data-toggle="scroll-to">jQuery Tag-it</a>
								<a class="nav-link" href="#jQueryMarksedInput" data-toggle="scroll-to">jQuery masked input</a>
								<a class="nav-link" href="#jQueryFileUpload" data-toggle="scroll-to">jQuery file upload</a>
								<a class="nav-link" href="#summernote" data-toggle="scroll-to">Summernote</a>
								<a class="nav-link" href="#selectPicker" data-toggle="scroll-to">Select picker</a>
								<a class="nav-link" href="#spectrumColorpicker" data-toggle="scroll-to">Spectrum colorpicker</a>
							</nav>
						</nav>
						<!-- END #sidebar-bootstrap -->
					</div>
					<!-- END col-3 -->
				</div>
				<!-- END row -->
			</div>
			<!-- END col-10 -->
		</div>
		<!-- END row -->
	</div>
	<!-- END container -->
	
	<!-- BEGIN template-upload -->
	<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload">
			<td>
				<span class="preview d-flex justify-content-center flex-align-center" style="height: 80px"></span>
			</td>
			<td>
				<p class="name mb-1">{%=file.name%}</p>
				<strong class="error text-danger"></strong>
			</td>
			<td>
				<p class="size mb-2">Processing...</p>
				<div class="progress progress-sm mb-0 h-10px progress-striped active"><div class="progress-bar progress-bar-primary" style="min-width: 2em; width:0%;"></div></div>
			</td>
			<td nowrap>
				{% if (!i && !o.options.autoUpload) { %}
					<button class="btn btn-theme btn-sm d-block w-100 start" disabled>
						<span>Start</span>
					</button>
				{% } %}
				{% if (!i) { %}
					<button class="btn btn-default btn-sm d-block w-100 cancel mt-2">
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>
	<!-- END template-upload -->
	
	<!-- BEGIN template-download -->
	<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download">
			<td>
				<span class="preview d-flex justify-content-center flex-align-center" style="height: 80px">
					{% if (file.thumbnailUrl) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
					{% } %}
				</span>
			</td>
			<td>
				<p class="name">
					{% if (file.url) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
					{% } else { %}
						<span>{%=file.name%}</span>
					{% } %}
				</p>
				{% if (file.error) { %}
					<div><span class="label label-danger">Error</span> {%=file.error%}</div>
				{% } %}
			</td>
			<td>
				<span class="size">{%=o.formatFileSize(file.size)%}</span>
			</td>
			<td nowrap>
				{% if (file.deleteUrl) { %}
					<button class="btn btn-danger btn-sm btn-block delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
						<span>Delete</span>
					</button>
					<div class="form-check mt-2">
						<input type="checkbox" id="{%=file.deleteUrl%}" name="delete" value="1" class="form-check-input toggle">
						<label for="{%=file.deleteUrl%}" class="form-check-label"></label>
					</div>
				{% } else { %}
					<button class="btn btn-default btn-sm d-block w-100 cancel">
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>
	<!-- END template-download -->
@endsection
