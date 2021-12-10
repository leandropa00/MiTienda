@extends('layouts.app_modal')

@section('header')
    Creando una factura
@endsection

@section('content')
    <div class="row form-group">
        <div class="col-sm-3 offset-sm-3">
            {!! Form::label(null, 'Número factura') !!}
            {!! Form::text(null, $consecutivo, $input + ['disabled']) !!}
        </div>
        <div class="col-sm-3">
            {!! Form::label(null, 'Fecha') !!}
            {!! Form::text(null, date('d/m/Y g:i A'), $input + ['disabled']) !!}
        </div>
    </div>
    <h4 class="text-center text-bold mt-4 mb-2">
        Adicionar productos
    </h4>
    <div class="row form-group">
        <div class="col-sm-5 offset-sm-2">
            {!! Form::label('producto', '*Insumo:') !!}
            <select name="producto" id="producto" class='form-control selectpicker bordered' data-style='form-control' data-live-search='true' title='Seleccione'>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" data-stock={{ $producto->stock }} data-precio={{ $producto->precio }} data-subtext="(x{{ $producto->stock }}) ${{ number_format($producto->precio) }}">
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            {!! Form::label('cantidad', '*Cantidad:', []) !!}
            {!! Form::text('cantidad', 1, $inputNumeric) !!}
        </div>
        <div class="col-sm-1">
            {!! Form::label('', '&nbsp;', []) !!} <br>
            <a onclick="agregarProducto()" class="btn btn-block btn-success text-white">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="no-products">
                    <tr>
                        <td colspan=5 class="text-center">No hay productos aún</td>
                    </tr>
                </tbody>
                <tbody id="productos"></tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        const FORMATTER = new Intl.NumberFormat()
        $(document).ready(function () {
            $('.selectpicker').selectpicker()  
        })

        agregarProducto = () => {
            if ($('#producto').val()) {
                var id = $('#producto').val(),
                    option = $('#producto').find('option:selected'),
                    stock = option.data('stock'),
                    producto = option.text(),
                    cantidad = parseFloat($('#cantidad').val() || 1),
                    precio = option.data('precio'),
                    subtotal = precio * cantidad
                if (cantidad > stock) {
                    Swal.fire('Cantidad inválida', 'La cantidad ingresada supera el stock', 'error')
                    return
                }
                $('#productos').append(`
                    <tr class="producto" data-id="${id}" data-cantidad=${cantidad} data-precio=${precio} data-subtotal=${subtotal}>
                        <td class="text-center" style="width: 55px;">
                            <a onclick="removerProducto(this)" class="btn btn-sm btn-danger text-white">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        <td>${producto}</td>
                        <td class="text-right" style="width: 50px">${cantidad}</td>
                        <td class="text-right">$${FORMATTER.format(precio)}</td>
                        <td class="text-right">$${FORMATTER.format(subtotal)}</td>
                    </tr>
                `)
                $('#cantidad').val(1)
                $('#producto').selectpicker('val', '')
                ocultarNoProducts()
            }            
        }

        removerProducto = (selector) => {
            $(selector).closest('tr.producto').remove()
            ocultarNoProducts()
        }

        ocultarNoProducts = () => {
            $('.producto').length 
                ? $('#no-products').addClass('d-none') 
                : $('#no-products').removeClass('d-none')            
        }
    </script>
@endpush