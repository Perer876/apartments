{{ $contract->amount}}
@if($contract->period == "years")  
    @if($contract->amount == 1)
        año
    @else
        años
    @endif
@else
    @if($contract->amount == 1)
        mes
    @else
        meses
    @endif
@endif