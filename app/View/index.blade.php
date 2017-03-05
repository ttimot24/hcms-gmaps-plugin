@extends('layout')

@section('content')
<section class='container'>

<div class='row'>
<h1>Google Maps</h1><br>
</div>


<div class='col-md-8'>

  <!-- Nav tabs -->
  <div class='well'>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{trans('plugin::nav.home')}}</a></li>
    <li role="presentation"><a href="#new_location" aria-controls="nre_location" role="tab" data-toggle="tab">{{trans('plugin::nav.add_location')}}</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">{{trans('plugin::nav.settings')}}</a></li>
  </ul>
  </div>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">@include('plugin::list')</div>
    <div role="tabpanel" class="tab-pane" id="new_location">@include('plugin::create_location')</div>
    <div role="tabpanel" class="tab-pane" id="settings">@include('plugin::settings')</div>
  </div>


</div>

<div class='col-md-4' style='text-align:right;'>
	<img src='plugins/GoogleMaps/resources/image/gml.png'>
</div>


 </section>
 @endsection