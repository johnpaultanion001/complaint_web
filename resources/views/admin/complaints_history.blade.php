@extends('layouts.admin1')
@section('content')

    <div id="exchange_rates">
        <div class="col-lg-12">
            <div class="card">
                    <div class="card-header p-2">
                        <h4>
                            Complaint History
                        </h4>
                        <button type="button" id="create_record" class="text-uppercase h6 btn btn-primary">
                            Add Record
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush datatable-country display" width="100%" >
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Action</th>
                                        <th>Name Of Complainant</th>
                                        <th>Grade / Section</th>
                                        <th>Date of Complaint</th>
                                        <th>Name Of Complained</th>
                                        <th>Action Taken</th>
                                        <th>Complaint</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($complaints as $complaint)
                                        <tr>
                                            <td>
                                                <button type="button" name="edit" edit="{{  $complaint->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                                <button type="button" name="remove" remove="{{  $complaint->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                            <td>
                                                {{$complaint->name_of_complainant ?? ''}}
                                            </td>
                                            <td>
                                                {{$complaint->grade ?? ''}} /  {{$complaint->section ?? ''}}
                                            </td>
                                           
                                            <td>
                                                {{$complaint->date_of_complaint ?? ''}}
                                            </td>
                                            <td>
                                                {{$complaint->name_of_complained ?? ''}}
                                            </td>
                                            <td>
                                                {{$complaint->action_taken ?? ''}}
                                            </td>
                                            <td>
                                                {{$complaint->complaint ?? ''}}
                                            </td>
                                            <td>
                                                {{ $complaint->created_at->format('M j , Y h:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>



<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog  modal-xl  modal-dialog-centered ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">RECORD DETAILS</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase  h6" >Name Of Complainant <span class="text-danger">*</span></label>
                                <input type="text" name="name_of_complainant" id="name_of_complainant" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-name_of_complainant"></strong>
                                </span>
                            
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase  h6" >Grade <span class="text-danger">*</span></label>
                                <input type="text" name="grade" id="grade" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-grade"></strong>
                                </span>
                            
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase  h6" >Section <span class="text-danger">*</span></label>
                                <input type="text" name="section" id="section" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-section"></strong>
                                </span>
                            
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase  h6" >Date Of Complaint <span class="text-danger">*</span></label>
                                <input type="date" name="date_of_complaint" id="date_of_complaint" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-date_of_complaint"></strong>
                                </span>
                            
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase  h6" >Name Of Complained <span class="text-danger">*</span></label>
                                <input type="text" name="name_of_complained" id="name_of_complained" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-name_of_complained"></strong>
                                </span>
                            
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase  h6" >Action Taken <span class="text-danger">*</span></label>
                                <textarea name="action_taken" id="action_taken" class="form-control" ></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-action_taken"></strong>
                                </span>
                            
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase  h6" >Complaint <span class="text-danger">*</span></label>
                                <textarea name="complaint" id="complaint" class="form-control" ></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-complaint"></strong>
                                </span>
                            
                            </div>
                        </div>
                        
                       
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                    <input type="hidden" name="action" id="action" value="Add" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                        <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-success btn-wd" value="SUBMIT" />
                </div>
        
            </div>
        </div>
    </div>
</form>


@endsection
@section('scripts')
<script>

$(document).ready(function () {
    $('.table').DataTable({
        bDestroy: true,
        "bFilter": true,

        buttons: [
            { 
                extend: 'print',
                className: 'd-none',
            }
        ],
    });

    $('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.complaint_history.store') }}";
    var type = "POST";
    if($('#action').val() == 'Edit'){
        var id = $('#hidden_id').val();
        action_url = "/admin/complaint_history/" + id;
        type = "PUT";
    }
    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $('#create_record').attr('disabled', true);
        },
        success:function(data){
            $('#create_record').attr('disabled', false);
            if(data.errors){
                $.each(data.errors, function(key,value){
                   if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $.confirm({
                    title: data.success,
                    content: "",
                    type: 'green',
                    buttons: {
                        confirm: {
                            text: '',
                            btnClass: 'btn-green',
                            keys: ['enter', 'shift'],
                            action: function(){
                                location.reload();
                            }
                        },
                    }
                });
            }
           
        }
    });
});
$(document).on('click', '#create_record', function(){
    $('#myModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('#action').val('Add');
   
});
$(document).on('click', '.edit', function(){
    $('#myModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    var id = $(this).attr('edit');
    $.ajax({
        url :"/admin/complaint_history/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
            $("#action_button").attr("disabled", false);
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                }
            })
            $('#hidden_id').val(id);
            $('#action').val('Edit');
        }
    })
});
$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this record?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/complaint_history/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $(".remove").attr("disabled", true);
                      },
                      success:function(data){
                        $(".remove").attr("disabled", false);
                        
                          if(data.success){
                            $.confirm({
                              title: 'Confirmation',
                              content: data.success,
                              type: 'green',
                              buttons: {
                                      confirm: {
                                          text: 'confirm',
                                          btnClass: 'btn-blue',
                                          keys: ['enter', 'shift'],
                                          action: function(){
                                              location.reload();
                                          }
                                      },
                                      
                                  }
                              });
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });
});
    
});

</script>
@endsection