@extends('layouts.admin')
@section('page-title')
    {{__('Outgoing Mail Details')}}
@endsection

@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Outgoing Mail Details')}}</li>
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
                                <th>{{ __('Destination') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $outgoingMail->mail_no }}</td>
                                    <td>{{ $outgoingMail->subject }}</td>
                                    <td>{{ $outgoingMail->date }}</td>
                                    <td>{{ $outgoingMail->destination }}</td>
                                    <td>{{ $outgoingMail->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

