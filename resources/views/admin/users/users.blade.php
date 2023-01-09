@extends('layouts.admin1')
@section('content')

    <div id="exchange_rates">
        <div class="col-lg-12">
            <div class="card">
                    <div class="card-header p-2">
                        <h4>
                            Users
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush datatable-country display" cellspacing="0" width="100%">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            LRN
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email/Username
                                        </th>
                                        <th>
                                            Grade/Section
                                        </th>
                                        <th>
                                            Contact Number
                                        </th>
                                        <th>
                                            Guardian Name
                                        </th>
                                        <th>
                                            Guardian Contact Number
                                        </th>
                                        <th>
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $account)
                                        <tr>
                                            <td>
                                                <button type="button" status="{{  $account->user->id ?? '' }}" class="status btn {{  $account->user->isApproved == '1' ? 'btn-success' : 'btn-warning'}}  btn-sm">
                                                {{  $account->user->isApproved == '1' ? 'APPROVED' : 'PENDING'}}
                                                </button>
                                            </td>
                                            <td>
                                                {{  $account->user->lrn ?? '' }} 
                                            </td>
                                            <td>
                                                {{  $account->user->name ?? '' }}
                                            </td>
                                            <td>
                                                {{  $account->user->email ?? '' }}
                                            </td>
                                            <td>
                                                {{  $account->user->grade ?? '' }} / {{  $account->user->section ?? '' }}
                                            </td>
                                            <td>
                                                {{  $account->user->contact_number ?? '' }}
                                            </td>
                                            <td>
                                                {{  $account->user->guardian_name ?? '' }}
                                            </td>
                                            <td>
                                                {{  $account->user->guardian_contact_number ?? '' }}
                                            </td>
                                            <td>
                                                {{ $account->user->created_at->format('M j , Y h:i A') }}
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

    $(document).on('click', '.status', function(){
    var id = $(this).attr('status');

    $.ajax({
        url :"/admin/users/"+id,
        dataType:"json",
        beforeSend:function(){
            $(".status").attr("disabled", true);
        },
        success:function(data){
            $(".status").attr("disabled", false);
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
    });

});

</script>
@endsection