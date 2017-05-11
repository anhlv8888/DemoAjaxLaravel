@extends("admin.layout.main")
@section("page-content")

    <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    Widget settings form goes here
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue">Save changes</button>
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Category</h1>
        </div>
        <!-- END PAGE TITLE -->

    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-edit"></i>Category Table
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{!! url('admin/contact/create') !!}" class="btn green">
                                        Add New <i class="fa fa-plus"></i></a>

                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <form class="navbar-right navbar-form" action="{{route('contact.table')}}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control " placeholder="Search..."
                                               name="search">
                                        <span class="input-group-btn">
                                         <button class="btn btn-info" type="submit">
                                             <i class="fa fa-search"></i>
                                         </button>
                                    </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if(session('notification'))
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            {{session('notification')}}
                        </div>
                    @endif

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th>
                                Contact_ID
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Company
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Edit
                            </th>
                            <th>
                                Delete
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contact  as $value)

                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->company}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->phone}}</td>
                                <td><a href="{{url("admin/contact/update",['id'=>$value->id])}}" class=""><i
                                                class="fa fa-pencil"/> Edit </a></td>
                                <td><a href="{{url("admin/contact/delete",['id'=>$value->id])}}" class=""><i
                                                class="fa fa-trash"/> Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-9">
                            {!! $contact->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop