@extends('layouts.admin')

@section('page-title')
    {{ __('E-Procurement Status') }}
@endsection

@push('css-page')
    <style>
        .step-timeline {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
        }

        .step {
            text-align: center;
            width: 150px;
        }

        .circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            font-size: 14px;
            font-weight: bold;
        }

        .step.completed .circle {
            background-color: #51459d; /*Purple*/
            color: white;
        }

        .step.active .circle {
            border: 3px solid #51459d; /*Purple border*/
        }

        .line {
            flex: 1;
            height: 2px;
            background-color: #ddd;
        }

        .step.completed~.line {
            background-color: #51459d; /*Purple*/
        }
        /* text */
        .text-primary{
            color:black !important
        }
    </style>
@endpush

@section('content')
    <div class="container">

        <div class="step-timeline">
            @foreach($history as $index => $step)
                <div class="step {{ $index < count($history) ? 'completed' : ($index == count($history) ? 'active' : '') }}">
                    <div class="circle">
                        {{ $index + 1 }}
                    </div>
                    <div>
                        {{ $step->status }}
                    </div>
                </div>
                @if(!$loop->last)
                    <div class="line {{ $index < count($history) - 1 ? 'completed' : '' }}"></div>
                @endif
            @endforeach
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __('Procurement History') }}</h5>
                <ul>
                    @foreach($history as $history)
                        <li>
                            {{ $history->created_at->format('Y-m-d H:i:s') }} -
                            {{ __('Status:') }} {{ $history->status }} -
                            {{ __('Note:') }} {{ $history->note }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection