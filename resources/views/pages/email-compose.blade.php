@extends('layout.default', [
	'appClass' => 'app-content-full-height',
	'appContentClass' => 'p-0'
])

@section('title', 'Compose')

@push('css')
	<link href="/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet">
	<link href="/assets/plugins/summernote/dist/summernote-lite.css" rel="stylesheet">
@endpush

@push('js')
	<script src="/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="/assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="/assets/plugins/summernote/dist/summernote-lite.min.js"></script>
	<script src="/assets/js/demo/email-compose.demo.js"></script>
@endpush

@section('content')
	<!-- BEGIN mailbox -->
	<div class="mailbox">
		<!-- BEGIN mailbox-toolbar -->
		<div class="mailbox-toolbar">
			<div class="mailbox-toolbar-item"><span class="mailbox-toolbar-text">New Message</span></div>
			<div class="mailbox-toolbar-item"><a href="#" class="mailbox-toolbar-link active">Send</a></div>
			<div class="mailbox-toolbar-item"><a href="#" class="mailbox-toolbar-link">Attachment</a></div>
			<div class="mailbox-toolbar-item"><a href="/email/inbox" class="mailbox-toolbar-link">Discard</a></div>
			<div class="mailbox-toolbar-item dropdown">
				<a href="#" class="mailbox-toolbar-link" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
				<div class="dropdown-menu ms-n1">
					<a href="#" class="dropdown-item">Save draft</a>
					<a href="#" class="dropdown-item">Show From</a>
					<a href="#" class="dropdown-item">Check names</a>
					<a href="#" class="dropdown-item">Set importance</a>
					<a href="#" class="dropdown-item">Switch to plain text</a>
					<a href="#" class="dropdown-item">Check for accessibility issues</a>
				</div>
			</div>
			<div class="mailbox-toolbar-item ms-auto"><a href="#" class="mailbox-toolbar-link"><i class="fa fa-redo fa-fw fs-12px me-1"></i> Undo</a></div>
			<div class="mailbox-toolbar-item"><a href="/email/inbox" class="mailbox-toolbar-link"><i class="fa fa-times fa-fw"></i> Cancel</a></div>
		</div>
		<!-- END mailbox-toolbar -->
		<!-- BEGIN mailbox-body -->
		<div class="mailbox-body">
			<div class="mailbox-content">
				<!-- BEGIN scrollbar -->
				<div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
					<div class="mailbox-form">
						<form action="#" method="POST" name="email_form">
							<div class="mailbox-form-header">
								<div class="row mb-2">
									<label class="col-form-label w-100px ps-2 pe-2 fw-500 text-end">To:</label>
									<div class="col">
										<ul id="email-to" class="form-control tagit">
											<li>admin@studio.com</li>
										</ul>
									</div>
								</div>
								<div class="row mb-2">
									<label class="col-form-label w-100px ps-2 pe-2 fw-500 text-end">Cc:</label>
									<div class="col">
										<ul id="email-cc" class="form-control tagit">
										</ul>
									</div>
								</div>
								<div class="row mb-2">
									<label class="col-form-label w-100px ps-2 pe-2 fw-500 text-end">Bcc:</label>
									<div class="col">
										<ul id="email-bcc" class="form-control tagit">
										</ul>
									</div>
								</div>
								<div class="row mb-0">
									<label class="col-form-label w-100px ps-2 pe-2 fw-500 text-end">Subject:</label>
									<div class="col">
										<input type="text" class="form-control" placeholder="Email subject">
									</div>
								</div>
							</div>
							<textarea name="text" class="summernote form-control" title="Contents"></textarea>
						</form>
					</div>
				</div>
				<!-- END scrollbar -->
			</div>
		</div>
		<!-- END mailbox-body -->
	</div>
	<!-- END mailbox -->
@endsection
