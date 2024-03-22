@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">News</div>

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
                        <form action="{{action('Admin\VideosController@update', $id)}}" method="post">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group">
                            <div><label for="title">Date <span class="glyphicon glyphicon-asterisk"></span></label></div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="day" class="form-control">
                            <option value="">Day</option>
                            @for($i=1;$i<=31;$i++)
                            <option value="{{ $i }}"
                                @if($i == $day)
                                selected="selected"
                                @endif
                            
                            >{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="month" class="form-control">
                            <option value="">Month</option>
                            @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}"
                                @if($i == $month)
                                selected="selected"
                                @endif
                            >{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="year" class="form-control">
                            <option value="">Year</option>
                            @for($i=2010;$i<=2040;$i++)
                            <option value="{{ $i }}"
                                @if($i == $year)
                                selected="selected"
                                @endif
                            >{{ $i }}</option>
                            @endfor
                            </select>
                            </div><br /><br />
                          </div>
                          
                          <div class="form-group">
                            <label for="title">Title <span class="glyphicon glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="title" value="{{ $results->title }}" id="title" placeholder="Enter title">
                          </div>
                          
                          <div class="form-group">
                            <label for="video">Video link <span class="glyphicon glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="video" value="{{ urldecode($results->link) }}" id="video" placeholder="Enter YouTube video link">
                          </div>
                          
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
