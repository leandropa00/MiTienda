<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => ['stock.store', $producto->id], 'id' => 'form']) !!}
            @include('layouts.ajax_errors')
            <div class="row form-group">
                <div class="col-sm">
                    {!! Form::label('cantidad', '*Cantidad:') !!}
                    {!! Form::text('cantidad', $producto->cantidad_minima, $inputNumeric) !!}
                </div>
                <div class="col-sm-4">
                    {!! Form::label(null, '&nbsp;') !!} <br>
                    <a type="button" class="btn btn-primary text-white float-right" onclick="$('#form').submit()">
                        Guardar
                    </a>
                    <a type="button" class="btn btn-secondary text-white float-right mr-2" onclick="$('#stock-form').empty()">
                        Cancelar
                    </a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#form').ajaxForm({
            beforeSubmit: () => {
                $.blockUI()
            }, success: (res) => {
                Swal.fire('Proceso exitoso', res, 'success').then(() => {
                    $('#stock-form').empty()
                    window.LaravelDataTables["StockTable"].draw(false)
                    window.LaravelDataTables["ProductosTable"].draw(false)
                })
            }, error: (res) => {
                res.status == 422 
                    ? mostrarErroresAjax(res)
                    : Swal.fire('Ocurrió un error', res.responseText, 'error')
            }, complete: () => {
                $.unblockUI()
            }
        })
    })
</script>