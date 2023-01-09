@extends('layouts.admin1')
@section('content')

    <div id="exchange_rates">
        <div class="col-lg-12">
            <div class="card">
                    <div class="card-header p-2">
                        <h4>
                            Complaint
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush datatable-country display" width="100%" >
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Status</th>
                                        <th>Name Of Complainant</th>
                                        <th>Grade / Section</th>
                                        <th>Action Taken</th>
                                        <th>Date / Time</th>
                                        <th>Name Of Complained</th>
                                        <th>Grade / Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($complaints as $complaint)
                                        <tr>
                                            <td>
                                                <button class="btn status {{$complaint->status == 'PENDING' ? 'btn-warning':'btn-success'}}  btn-wd btn-sm " status="{{$complaint->id ?? ''}}">
                                                    {{$complaint->status ?? ''}}
                                                </button>
                                            </td>
                                            <td>
                                                {{$complaint->user->name ?? ''}}
                                            </td>
                                            <td>
                                                {{$complaint->user->grade ?? ''}} /  {{$complaint->user->section ?? ''}}
                                            </td>
                                            <td>
                                                {{$complaint->complaint ?? ''}}
                                            </td>
                                            <td>
                                                {{ $complaint->created_at->format('M j , Y h:i A') }}
                                            </td>
                                            <td>
                                                {{$complaint->complained_name ?? ''}}
                                            </td>
                                            <td>
                                                {{$complaint->grade ?? ''}} /  {{$complaint->section ?? ''}}
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
                    <p class="modal-title  text-uppercase font-weight-bold">CHANGE STATUS</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label text-uppercase h6" >Select a status:</label>
                            <select name="status" id="status" class="form-control ">
                                <option value="PENDING">PENDING</option>
                                <option value="APPROVED">APPROVED</option>
                                <option value="COMPLETED">COMPLETED</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Message:</label>
                                <textarea name="msg" id="msg" class="form-control font-weight-bold"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-msg"></strong>
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
    var complait_id = null;
    $(document).on('click', '.status', function(){
        $('#myModal').modal('show');
        $('#myForm')[0].reset();
        $('.form-control').removeClass('is-invalid');
        complait_id = $(this).attr('status');

        $.ajax({
            url :"/admin/complaints/"+id,
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
            }
        })
    });

    $('#myForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var action_url = '/admin/complaints/'+complait_id+'/change_status';
        var type = "get";

        $.ajax({
            url: action_url,
            method:type,
            data:$(this).serialize(),
            dataType:"json",
            beforeSend:function(){
                $("#action_button").attr("disabled", true);
                $("#action_button").val("LOADING..");
            },
            success:function(data){
                $("#action_button").attr("disabled", false);
                $("#action_button").val("SUBMIT");

             
                if(data.success){
                    $('.form-control').removeClass('is-invalid')
                    $('#myForm')[0].reset();
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
                    $('#formModal').modal('hide');
                }
                
            }
        });
    });
});

</script>
@endsection