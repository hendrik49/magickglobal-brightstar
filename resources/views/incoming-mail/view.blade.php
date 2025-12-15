@extends('layouts.admin')
@section('page-title')
    {{__('Incoming Mail Details')}}
@endsection

@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Incoming Mail Details')}}</li>
@endsection
@section('action-btn')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">

                            <thead>
                            <tr>
                                <th>{{ __('Mail No') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Source') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $incomingMail->mail_no }}</td>
                                    <td>{{ $incomingMail->subject }}</td>
                                    <td>{{ $incomingMail->date }}</td>
                                    <td>{{ $incomingMail->source }}</td>
                                    <td>{{ $incomingMail->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

