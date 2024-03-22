@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Videos</div>

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
                    
                    <a href="/admin/videos" class="btn btn-primary btn-sm">View</a><br /><br />
                    
                    <p id="video_notif">*If YouTube video URL is https://youtube.com/watch?v=oAvsTrsM, for example, enter video link as https://youtube.com/embed/oAvsTrsM</p>
                    
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
                        <form action="{{action('Admin\VideosController@store')}}" method="post">
                        <input name="slug" type="hidden" value="">
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
                          
                          <div class="form-group">
                            <label for="title">Title <span class="glyphicon glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                          </div>
                          
                          <div class="form-group">
                            <label for="video">Video link <span class="glyphicon glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="video" id="video" placeholder="Enter YouTube video link">
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
