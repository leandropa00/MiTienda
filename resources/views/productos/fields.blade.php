@include('layouts.ajax_errors')

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('imagen', '*Imagen:') !!} <br>
        <div class="img-thumbnail">
            <img onclick="$('#imagen').click()" src="{{ asset($producto->ruta_imagen ?? 'default_product.png') }}" class="w-100" id="imgPrev">
        </div>
        {!! Form::file('imagen', ['onchange' => 'validarArchivo(this)', 'id' => 'imagen', 'class' => 'd-none', 'accept' => 'image/*']) !!}
    </div>
    <div class="col-sm-8">
        <div class="row form-group">
            <div class="col-sm">
                {!! Form::label('nombre', '*Nombre:') !!}
                {!! Form::text('nombre', null, $input) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                {!! Form::label('descripcion', '*Descripción:') !!}
                {!! Form::textarea('descripcion', null, $textarea) !!}
            </div>
            <div class="col-sm-6">
                <div class="row form-group">
                    <div class="col-sm">
                        {!! Form::label('precio', '*Precio:') !!}
                        {!! Form::text('precio', null, $moneda) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        {!! Form::label('cantidad_minima', '*Cantidad mínima:') !!}
                        {!! Form::text('cantidad_minima', null, $inputNumeric) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>

@section('footer')
    <a class="btn btn-dark text-white" onclick="cerrarModal()">
        Cancelar
    </a>
    <a class="btn btn-primary text-white" onclick="$('#form').submit()">
        Guardar
    </a>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#form').ajaxForm({
                beforeSubmit: () => {
                    $.blockUI()
                }, success: (res) => {
                    Swal.fire('Proceso exitoso', res, 'success').then(() => {
                        window.LaravelDataTables['ProductosTable'].draw()
                        cerrarModal()
                    })
                }, error: (res) => {
                    res.status == 422
                        ? mostrarErroresAjax(res)
                        : Swal.fire('Ocurrió un error', res.responseText, 'error')
                }, complete: () => {
                    $.unblockUI()
                }
            })
            $('.maskmoney').maskMoney({
                prefix    : '$',
                thousands :'.',
                decimal   :'',
                allowZero : true,
                precision : 0
            })
        })

        validarArchivo = (archivo) => {
            var permitidas = ['.jpg', '.jpeg', '.png', '.PNG', '.JPG', '.JPEG'],
                ruta = archivo.value,
                punto = archivo.value.lastIndexOf("."),
                ext = ruta.slice(punto, ruta.length)
            if (permitidas.indexOf(ext) == -1) {
                Swal.fire('Formato inválido', 'El archivo debe estar en formato de imagen (jpg, jpeg, png).', 'error')
                $('#imagen').val('')
                $('#imgPrev').prop('src', '{{ asset($producto->ruta_imagen ?? 'default_product.png') }}')
                return
            } else
                $('#imgPrev').prop('src', URL.createObjectURL(archivo.files[0]))
        }
    </script>
@endpush