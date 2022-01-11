@extends('layout')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5>Hello {{ auth()->user()->name }}</h5>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
            <div class="alert alert-info">
            	Jika Anda merasa kebingungan mengoperasikan website ini, silahkan hubungi Administrator lewat :
            	<ul class="mb-0 mt-2">
            		<li>Email : <a href="mailto:ertha.setiyawan@gmail.com">ertha.setiyawan@gmail.com</a></li>
            		<li>Telp/WhatsApp : <a href="tel:082229205456">082229205456</a></li>
            	</ul>
            </div>			
		</div>
	</div>
</div>

@endsection