@extends('admin.layouts.app')


@section('content')
  {{-- 13678c --}}
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.translation') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">{{ trans('admin/main.dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ trans('admin/main.translation') }}</div>
            </div>
        </div>

        <div class="section-body">
            {{-- <h2 class="section-title">{{ trans('admin/main.overview') }}</h2>
            <p class="section-lead">
                {{ trans('admin/main.overview_hint') }} <br/>
            </p> --}}

            <div class="row">
                @can('admin_settings_customization')
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="card-body">
                                {{-- <h4>Translation Data Sync</h4> --}}
                                <a href="{{ route('translation_data_sync') }}" class="btn btn-info">Translation Data Sync</a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </section>
@endsection
