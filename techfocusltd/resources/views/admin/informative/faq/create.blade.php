@extends('admin.adminMasterLayout')

@section('breadcrumb')
			<li>
				<a href="#">Solution</a>
			</li>
			<li>
				<i class="icon-edit"></i>
				<a href="#">Add Solution</a>
			</li>
@endsection

@section('adminContent')
						
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Solution</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" enctype="multipart/form-data" action="{{url('/store-faq')}}" method="post">
                {{csrf_field()}}
                    <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="text">Faq Question</label>
                        <div class="controls">
                        <input type="text" class="input-xlarge" name="question">
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Answer</label>
                        <div class="controls">
                            <textarea class="cleditor" name="answer" rows="3"></textarea>
                        </div>
                    </div> 							
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div><!--/row-->
			
@endsection