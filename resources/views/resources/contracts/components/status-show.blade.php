@isset($contract)
    @if($contract->cancelled_at)
        <span class="badge bg-light-danger">Cancelado</span>
    @else
        @if(today() < $contract->start_at)
            <span class="badge bg-light-primary">Próximo</span>
        @elseif($contract->end_at <= today())
            <span class="badge bg-light-warning">Concluido</span>
        @else
            <span class="badge bg-light-success">Activo</span>
        @endif
    @endif
@else
    <span class="badge bg-light-secondary">Sin contrato</span>
@endisset