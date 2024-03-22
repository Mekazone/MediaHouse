@extends('layouts.content2')

@section('content')
<div class="row">
    <div class="col-lg-8" id="leftCol">
        <div class="row">
                <div class="col-md-9">
                    <div class="feedback">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
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
                    
                    <div data-form-alert="true">
                        <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Thanks for filling out form!</div>
                    </div>
                    
                    <p>We are constantly working on improving our services with the aim of providing you with the best experience. We value you opinion and welcome any suggestions.</p>
                    
                    <form action="feedback" method="POST" data-form-title="MESSAGE" id="formx">
                        <input type="hidden" value="asPhVKcCEFm4k4qJ1NxsZrt3fZHUOQK8guD5ZJcI6W8ph7tcjbatv7W4fkU3OIoJ2nJIQGVktecOPtmObucfBoxcVLpeF8fX9lNStBKTmxLMu7wjEb8+ts/AExEi8HkV" data-form-email="true">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-control-label" for="contacts5-5-name">Name
                                <span class="glyphicon glyphicon-asterisk"></span>
                            </label>
                            <input type="top-text" class="form-control input-inverse" name="name" required="" data-form-field="Name" id="contacts5-5-name">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="contacts5-5-email">Email
                                <span class="glyphicon glyphicon-asterisk"></span>
                            </label>
                            <input type="email" class="form-control input-inverse" name="email" required="" data-form-field="Email" id="contacts5-5-email">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="contacts5-5-message">Message</label>
                                <span class="glyphicon glyphicon-asterisk"></span>
                            <textarea class="form-control input-inverse" name="message" data-form-field="Message" rows="8" id="contacts5-5-message" required=""></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Submit</button>  <span id="loading"><img src="frontend_assets/loader.gif" style="height: 40px;width: auto;"></span>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
    </div>
@endsection