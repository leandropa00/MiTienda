{!! Form::open(['route' => ['productos.destroy', $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        <a onclick="editarProducto({{ $id }})" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Editar">
            <i class="fa fa-pencil"></i>
        </a>
        <a onclick="verStock({{ $id }})" class="btn btn-primary btn-sm text-white" data-toggle="tooltip" title="Stock">
            <i class="fas fa-truck-loading"></i>
        </a>
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'class' => 'btn btn-danger btn-sm eliminar',
            'title' => 'Eliminar',
            'onclick' => "confirmarEliminacion(this.form, true, () => { window.LaravelDataTables['ProductosTable'].draw(false) }); return false;"
        ]) !!}
    </div>
{!! Form::close() !!}
