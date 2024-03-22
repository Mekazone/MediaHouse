@extends('layouts.content2')

@section('content')

<div class="row">
    <div class="col-lg-8" id="leftCol">
        @if($albums > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="row">                    
                    @foreach($photos as $result)
                    <div class="col-md-4"><a href="photonews/{{ $result->id }}"><img src="{{ $result['photo'] }}" style="width:100%" class="img img-thumbnail" /><p style="text-align: center;">{{ $result->title }}</p></a></div>
                    @endforeach  
                </div>
                
                <div class="col-lg-12"><div class="paginate">{{ $results->links("pagination::bootstrap-4") }}</div></div>                
                <!-- jquery script located in footer -->
            </div>
        </div> 
        @endif
    </div>
@endsection