@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-home"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total kandang</h4>
                </div>
                <div class="card-body">
                    {{ $jml_kandang }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Karyawan</h4>
                </div>
                <div class="card-body">
                    {{ $jml_karyawan }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Distributor</h4>
                </div>
                <div class="card-body">
                    {{ $jml_distributor }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection