@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inspirational Personalities</div>

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
                    
                    <a href="/admin/inspirational" class="btn btn-primary btn-sm">View</a><br /><br />
                    
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
                        <form action="{{action('Admin\InspirationController@store')}}" method="post" enctype="multipart/form-data" id="post_form">
                        <input name="slug" type="hidden" value="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div><label for="title">Date <span class="glyphicon glyphicon-asterisk"></span></label></div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="day" class="form-control" required="">
                            <option value="">Day</option>
                            @for($i=1;$i<=31;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="month" class="form-control" required="">
                            <option value="">Month</option>
                            @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="year" class="form-control" required="">
                            <option value="">Year</option>
                            @for($i=2010;$i<=2040;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            </div><br /><br />
                          </div>
                          
                          <div class="form-group">
                            <label for="title">Title <span class="glyphicon glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required="">
                          </div>
                          
                          <div id="topImages">
                              <div class="form-group">
                                  <div id="topImagesContainer">
                                    <label for="topImages">Top Image</label>
                                    <div class="uploadFile">
                                    <input type="file" class="form-control" name="topAttachment">
                                <input type="hidden" name="fileTypeTop[]" value="1" /> 
                                  </div>
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="topCaption">File Caption</label>
                                <input type="text" class="form-control" name="topCaption" id="topCaption" placeholder="Enter file caption">
                              </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="mytextarea">Body <span class="glyphicon glyphicon-asterisk"></span></label>
                            <textarea class="form-control" name="body" id="mytextarea" rows="8"></textarea>
                          </div>
                          
                          <div class="form-group">
                            <label for="keywords">Keywords <span class="glyphicon glyphicon-asterisk"></span></label>
                            <input type="text" class="form-control" name="keywords" id="keywords" required="" placeholder="Enter keywords, each seperated with a comma">
                            </div>
                          
                          <div class="form-group" style="margin-top: 10px;">
                              <div id="bottomImagesContainer">
                                <label for="bottomImages">Bottom Attachment(s)</label>
                                <div class="uploadFile" id="bottomImages">
                                <input type="file" class="form-control" name="bottomAttachments[]">
                                <div class="form-group" style="margin-top: 10px;">
                            <label for="bottomCaption">File Caption</label>
                            <input type="text" class="form-control" name="bottomCaption[]" id="bottomCaption" placeholder="Enter file caption">
                          </div>
                          
                              <div class="fileType"><label>File Type (choose one option)</label></div>
                            <span class="fileTypeValues"><input type="checkbox" name="fileTypeBottom[]" value="1" /> Image </span>
                            <span class="fileTypeValues"><input type="checkbox" name="fileTypeBottom[]" value="2" /> Document </span>         
                            </div>
                              </div>
                              <div style="margin: 10px 0;"><button id="extraUpload2" class="btn btn-danger btn-sm" type="button" style="font-weight: bold;">Add more</button></div>
                          </div>
                          
                          <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-primary" /><span class="status" style="font-weight: bold;color:red;margin-left:10px;"></span>
                        </form>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
