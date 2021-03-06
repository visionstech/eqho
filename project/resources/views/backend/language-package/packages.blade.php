@extends('backend.app')
@section('title')
	Language Packages
@endsection
@section('content')
    <section class="content-header">
      <h1>
        Manage Language Packages
        <small>Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="{{ url('/language-management') }}">Languages Overview</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            @if(Session::has('success')) 
                <div class="alert alert-success"> 
                    {{Session::get('success')}} 
                </div> 
            @endif
            @if(Session::has('error')) 
                <div class="alert alert-danger"> 
                    {{Session::get('error')}} 
                </div> 
            @endif
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><a href="{{ url('/language-package/add-package') }}">Add Language Package</a></h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>Package Name</th>
                                <th>Package Price</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($languagePackages as $languagePackage)
                                <tr>
                                    <td>{{ $languagePackage->name }}</td>
                                     <td>{{ $languagePackage->price_per_word }}</td>
                                    <td>{{ $languagePackage->created_at }}</td>
                                    <td>{{ $languagePackage->status }}</td>
                                   <td>
                                    <?php if($languagePackage->status != 'Deleted'){ ?>
                                            <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="{{ encrypt($languagePackage->id) }}" data-status="Deleted" data-statusDiv="Delete">Delete</a>
                                    <?php }else{ ?>
                                            <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="{{ encrypt($languagePackage->id) }}" data-status="Active" data-statusDiv="Active">Active</a>
                                    <?php } ?>
                                    <a class="btn btn-primary actionedit" href="{{ url('/language-package/add-package/'.encrypt($languagePackage->id)) }}">Edit</a>
                                   </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     </div>
                </div>
                
            </div>
        </div>
    </section>
<!-- Popup Model For Delete action -->

<div class="modal fade bs-example-modal-dm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">   <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"><span class="statusDiv"></span> Language</h4>
            </div>
            <div class="modal-body">
                <h4></h4>
                <p>Are you sure you want to <span class="statusDiv"></span> this language ? </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="LanguageId" class="LanguageId" />
                <input type="hidden" name="status" class="status" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary delete_confirm"><span class="statusDiv"></span></button>
            </div>
        </div>
    </div>
</div>
<!-- End Popup Model -->
@endsection
@section('js')
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#example1").dataTable();
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var LanguageId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            var statusDiv=$(this).attr('data-statusDiv');
            $('.status').val(status);
            $('.statusDiv').html(statusDiv);
            $('.LanguageId').val(LanguageId);
        });
        
        $('.delete_confirm').click(function(){
            var LanguageId=$('.LanguageId').val();
            var Status=$('.status').val();
            window.location.href=baseUrl+'/language-package/delete-package/'+LanguageId+'/'+Status;
        });        
    });
</script>
@endsection
 

