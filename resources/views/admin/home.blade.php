@extends('layouts.admin1')
@section('content')
<div class="col-xl-12">
    <div class="row mt-5">
        <div class="col-sm-6">
            <div class="card bg-success">
                <div class="card-body">
                    <h5 class="card-title text-white font-wieght-bold">Total Complaint</h5>
                    <h5 class=" text-white font-wieght-bold">{{$complaints}}</h5>
                    <a href="/admin/complaints" class="btn btn-primary">View Complaint</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card  bg-warning">
            <div class="card-body">
                <h5 class="card-title text-white font-wieght-bold">Total Users</h5>
                <h5 class="card-text text-white font-wieght-bold">{{$users}}</h5>
                <a href="/admin/users" class="btn btn-primary">View Users</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6 mx-auto">
            <div class="card  bg-danger">
            <div class="card-body">
                <h5 class="card-title text-white font-wieght-bold">Total History Complaint</h5>
                <h5 class="card-text text-white font-wieght-bold">{{$complaints_history}}</h5>
                <a href="/admin/complaint_history" class="btn btn-primary">View Complaint History</a>
            </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>



</script>
@endsection