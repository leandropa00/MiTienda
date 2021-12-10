@push('css')
    @include('layouts.datatables_css')
@endpush

<div class="table-responsive">
    {!! $dataTable->table(['width' => '100%']) !!}
</div>

@include('layouts.datatables_js')
{!! $dataTable->scripts() !!}
