@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Ad</div>

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
                    
                    <a href="/admin/ads" class="btn btn-primary btn-sm">View</a><br /><br />
                    
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
                        <form action="{{action('Admin\AdsController@store')}}" method="post" enctype="multipart/form-data">
                        <input name="slug" type="hidden" value="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div><label for="title">From <span class="glyphicon glyphicon-asterisk"></span></label></div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="start_day" class="form-control">
                            <option value="">Day</option>
                            @for($i=1;$i<=31;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="start_month" class="form-control">
                            <option value="">Month</option>
                            @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="start_year" class="form-control">
                            <option value="">Year</option>
                            @for($i=2010;$i<=2040;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div><br /><br />
                          </div>
                          
                          <div class="form-group">
                            <div><label for="title">To <span class="glyphicon glyphicon-asterisk"></span></label></div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="end_day" class="form-control">
                            <option value="">Day</option>
                            @for($i=1;$i<=31;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="end_month" class="form-control">
                            <option value="">Month</option>
                            @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="end_year" class="form-control">
                            <option value="">Year</option>
                            @for($i=2010;$i<=2040;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div><br /><br />
                          </div>
                          
                          <div class="form-group">
                            <label for="title">Title <span class="glyphicon glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                          </div>
                          
                          <div class="form-group">
                            <label for="image">Ad Image <span class="glyphicon glyphicon-asterisk"></span></label>
                            <div class="uploadFile">
                                <input type="file" class="form-control" name="image" /> 
                            </div>
                          </div>
                              
                          <div class="form-group">
                                <label for="dimension">Ad Type <span class="glyphicon glyphicon-asterisk"></span></label>
                                <select class="form-control" name="dimension" id="dimension">
                                    <option value="">Select option</option>
                                    <option value="Front Page (750x180 pixels)">Front Page (750x180 pixels)</option>
                                    <option value="Inside News Centre (750x180 pixels)">Inside News Centre (750x180 pixels)</option>
                                    <option value="Inside News Sidebar Large (500x800 pixels)">Inside News Sidebar Large (500x800 pixels)</option>
                                    <option value="Inside News Sidebar Small (500x300 pixels)">Inside News Sidebar Small (500x300 pixels)</option>
                                    <option value="Sponsored Post">Sponsored Post</option>
                                </select>
                          </div>
                          
                          <div class="form-group">
                            <label for="url">Ad URL</span></label>
                            <input type="text" class="form-control" name="url" id="" placeholder="Prefix URL with http://">
                          </div>                                                    

                          
                          <input type="submit" name="submit" value="Submit" class="btn btn-primary" onclick="return confirm('Are you sure? Changes cannot be made after submission.')" />
                        </form>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
