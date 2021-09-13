@extends('layouts.admin')

@section('breadcrumbhead')
    Site Info
    <small>Control panel</small>
@endsection

@section('breadcrumb')
    <li class="active">Site Info</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Site info</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>copyright</th>
                        <th>facebook</th>
                        <th>twitter</th>
                        <th>linkedin</th>
                        <th>googleplus</th>
                        @hasanyrole('super admin|Admin')
                        <th>
                            action
                            <a href="#" class="addInfo btn btn-success btn-sm">
                                <i class="fa fa-plus"></i>
                            </a>
                        </th>
                        @endhasanyrole
                    </tr>
                </thead>
                <tbody>
                @foreach($siteinfos as $siteinfo)
                    <tr id="info{{$siteinfo->id}}">
                        <td>{{$siteinfo->title}}</td>
                        <td>{{$siteinfo->copyright}}</td>
                        <td>{{$siteinfo->facebook}}</td>
                        <td>{{$siteinfo->twitter}}</td>
                        <td> {{$siteinfo->linkedin}} </td>
                        <td>{{$siteinfo->googleplus}}</td>
                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="show-info btn btn-info btn-sm" data-id="{{$siteinfo->id}}" data-title="{{$siteinfo->title}}" data-copyright="{{$siteinfo->copyright}}" data-facebook="{{$siteinfo->facebook}}" data-twitter="{{$siteinfo->twitter}}" data-linkedin="{{$siteinfo->linkedin}}" data-googleplus="{{$siteinfo->googleplus}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @hasanyrole('super admin|Admin')
                                  <a href="#" class="edit-info btn btn-warning btn-sm" data-id="{{$siteinfo->id}}" data-title="{{$siteinfo->title}}" data-copyright="{{$siteinfo->copyright}}" data-facebook="{{$siteinfo->facebook}}" data-twitter="{{$siteinfo->twitter}}" data-linkedin="{{$siteinfo->linkedin}}" data-googleplus="{{$siteinfo->googleplus}}">
                                      <i class="fa fa-edit"></i>
                                  </a>
                                  <a href="#" class="delete-info btn btn-danger btn-sm" data-id="{{$siteinfo->id}}">
                                      <i class="fa fa-trash"></i>
                                  </a>
                                @endhasanyrole
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

{{-- Modal Form Create Post --}}
<div id="create" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
		      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                </button>
		        <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
		      </div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="title">Title :</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" id="title" name="title"
		              placeholder="Title Here" required>
		              <p class="error title text-center alert alert-danger hidden"></p>
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="copyright">Copyright :</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" id="copyright" name="copyright"
		              placeholder="copyright Here" required>
		              <p class="error copyright text-center alert alert-danger hidden"></p>
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="facebook">Facebook :</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" id="facebook" name="facebook"
		              placeholder="facebook Here" required>
		              <p class="error facebook text-center alert alert-danger hidden"></p>
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="twitter">Twitter :</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" id="twitter" name="twitter"
		              placeholder="twitter Here" required>
		              <p class="error twitter text-center alert alert-danger hidden"></p>
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="linkedin">Linkedin :</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" id="linkedin" name="linkedin"
		              placeholder="linkedin Here" required>
		              <p class="error linkedin text-center alert alert-danger hidden"></p>
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="googleplus">Googleplus :</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" id="googleplus" name="googleplus"
		              placeholder="googleplus Here" required>
		              <p class="error googleplus text-center alert alert-danger hidden"></p>
		            </div>
		          </div>
		        </form>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<button class="btn btn-warning" type="submit" id="addInfo">
	              <span class="glyphicon glyphicon-plus"></span>Save Info
	            </button>
			</div>
		</div>
	</div>
</div>
	
<div class="clearfix"></div>

{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
  	  </div>
    <div class="modal-body">
	    <div class="form-group">
	      <label for="">ID :</label>
	      <b id="i"/>
	    </div>
	    <div class="form-group">
	      <label for="">Title :</label>
	      <b id="ti"/>
	    </div>
	    <div class="form-group">
	      <label for="">Copyright :</label>
	      <b id="by"/>
	    </div>
	    <div class="form-group">
	      <label for="">Facebook :</label>
	      <b id="fb"/>
	    </div>
	    <div class="form-group">
	      <label for="">Twitter :</label>
	      <b id="tw"/>
	    </div>
	    <div class="form-group">
	      <label for="">Linkedin :</label>
	      <b id="lk"/>
	    </div>
	    <div class="form-group">
	      <label for="">Googleplus :</label>
	      <b id="gp"/>
	    </div>
    </div>
    </div>
    </div>
  </div>
  </div>

<div class="clearfix"></div>

{{-- Modal Form Edit and Delete Post --}}
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
        <h2 class="modal-title" id="largeModalLabel">Large Modal</h2>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal">

          <div class="form-group">
            <label class="control-label col-sm-2" for="id">ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fid" disabled>
            </div>
          </div>
		  <div class="form-group">
            <label class="control-label col-sm-2" for="title">Title :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="etitle" name="title"
              placeholder="Title Here" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="copyright">Copyright :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ecopyright" name="copyright"
              placeholder="copyright Here" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="facebook">Facebook :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="efacebook" name="facebook"
              placeholder="facebook Here" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="twitter">Twitter :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="etwitter" name="twitter"
              placeholder="twitter Here" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="linkedin">Linkedin :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="elinkedin" name="linkedin"
              placeholder="linkedin Here" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="googleplus">Googleplus :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="egoogleplus" name="googleplus"
              placeholder="googleplus Here" required>
            </div>
          </div>
          <input type="hidden" name="_method1" value="PUT">
        </form>
        {{-- Form Delete Post --}}
        <input type="hidden" name="_method" value="DELETE">
        <div class="deleteContent">
          Are You sure want to delete this data?
          <span class="hidden id" style="display:none"></span>
        </div>

      </div>
      <div class="modal-footer">

        <button type="button" class="btn actionBtn" data-dismiss="modal">
          <span id="footer_action_button" class="glyphicon"></span>
        </button>

        <button type="button" class="btn btn-warning" data-dismiss="modal">
          <span class="glyphicon glyphicon"></span>close
        </button>

      </div>
    </div>
  </div>
</div>

@endsection