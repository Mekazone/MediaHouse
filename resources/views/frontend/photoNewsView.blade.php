@extends('layouts.content2')

@section('content')

<div class="row">
    <div class="col-lg-8" id="leftCol">
        @if($photoNews > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="row">                     
                    <h4 style="margin-left: 50px;color:#009933;">{{ $albumTitle->title }}</h4>
                    <div id="wowslider-container1">
                    <div class="ws_images"><ul>
                        @foreach($results as $result)                        
                    		<li><img src="/{{ $result->name }}" title="{{ $result->caption }}" id="wows1_0" class="img-thumbnail"/></li>
                      @endforeach
                    	</ul></div>
                    </div> 
                </div>                
                <!-- jquery script located in footer -->
            </div>
        </div> 
        @endif
    </div>
@endsection