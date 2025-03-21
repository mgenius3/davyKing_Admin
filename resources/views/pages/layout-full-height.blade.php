@extends('layout.default', ['appClass' => 'app-content-full-height'])

@section('title', 'Full Height')

@push('js')
	<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="/assets/js/demo/highlightjs.demo.js"></script>
@endpush

@section('content')
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">LAYOUT</a></li>
		<li class="breadcrumb-item active">FULL HEIGHT</li>
	</ul>
	
	<h1 class="page-header">
		Full Height <small>page header description goes here...</small>
	</h1>
	
	<hr class="mb-4">
	
	<p>
		Add the following page variable for full height page setting.
	</p>
	
	<div class="card mb-3">
		<div class="hljs-container rounded">
			<pre><code data-url="/assets/data/layout-full-height/code-1.json"></code></pre>
		</div>
	</div>
	
	<div>
		Content Area with scrollbar. Try to scroll down. <i class="fa fa-arrow-down text-primary"></i>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		You got the bottom
	</div>
@endsection
