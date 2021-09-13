@extends('layouts.admin')

@section('breadcrumbhead')
    Faq & Help
    <small>Control panel</small>
@endsection

@section('breadcrumb')
    <li class="active">Faq & Help</li>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Faq & Help</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    @hasanyrole('super admin|Admin')
                    <th>
                        action
                        <a href="#" class="addFaq btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                    @endhasanyrole
                </tr>
                </thead>
                <tbody>
                @foreach($faqs as $faq)
                    <tr id="faq{{$faq->id}}">
                        <td>{{$faq->question}}</td>
                        <td>{!! html_entity_decode($faq->answer) !!}</td>
                        <td>
                            <div class="table-data-feature">
                                <a href="#" class="show-faq btn btn-info btn-sm" data-id="{{$faq->id}}" data-question="{{$faq->question}}" data-answer="{{strip_tags($faq->answer)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="#" class="edit-faq btn btn-warning btn-sm" data-id="{{$faq->id}}" data-question="{{$faq->question}}" data-answer="{{strip_tags($faq->answer)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="delete-faq btn btn-danger btn-sm" data-id="{{$faq->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
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
                    <form class="form-horizontal" role="form" id="insertFaq">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="question">Question :</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="question" id="question">
                                <p class="error question text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="answer">Answer :</label>
                            <div class="col-sm-10">
                                <textarea id="answer" name="answer" rows="10" cols="80"></textarea>
                                <p class="error answer text-center alert alert-danger hidden"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('#answer').summernote({
                                            placeholder: 'answer',
                                            tabsize: 2,
                                            height: 100
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <button class="btn btn-warning" type="submit" id="addFaq">
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
                        <b id="faqId"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="question">Question :</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" name="question" id="shquestion" disabled>
                            <p class="error shquestion text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Answer :</label>
                        <b id="faqAnswer"/>
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
                            <label class="control-label col-sm-2" for="question">Question :</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="question" id="equestion">
                                <p class="error equestion text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="answer">Answer :</label>
                            <div class="col-sm-10">
                                <textarea id="eanswer" name="answer" rows="10" cols="80"></textarea>
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