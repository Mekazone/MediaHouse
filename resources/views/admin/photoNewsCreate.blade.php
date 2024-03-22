@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Photo News</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (\Session::has('success'))
                      <div class="alert alert-success">
                          <p>{{ \Session::get('success') }}</p>
                      </div><br />
                      @endif
                    
                    <a href="/admin/photonews/{{$id}}" class="btn btn-primary btn-sm">View</a> <a href="/admin/photonews" class="btn btn-primary btn-sm">Back to albums</a><br /><br />
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                    
                    <div>
                        <form action="{{action('Admin\PhotoNewsController@store')}}" method="post" enctype="multipart/form-data">
                        <input name="albumId" type="hidden" value="{{$id}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div><label for="title">Date <span class="glyphicon glyphicon-asterisk"></span></label></div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="day" class="form-control">
                            <option value="">Day</option>
                            @for($i=1;$i<=31;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="month" class="form-control">
                            <option value="">Month</option>
                            @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="year" class="form-control">
                            <option value="">Year</option>
                            @for($i=2010;$i<=2040;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div><br /><br />
                          </div>
                          
                          <div id="topImages">
                              <div class="form-group">
                                  <div id="topImagesContainer">
                                    <label for="topImages">Photo <span class="glyphicon glyphicon-asterisk"></span></label>
                                    <div class="uploadFile">
                                    <input type="file" class="form-control" name="photo">
                                <input type="hidden" name="fileTypeTop[]" value="1" /> 
                                  </div>
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="topCaption">Caption  <span class="glyphicon glyphicon-asterisk"></span></label>
                                <input type="text" class="form-control" name="caption" id="topCaption" placeholder="Enter file caption">
                              </div>
                          </div>
                          
                          <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                        </form>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
