{!! Form::open(['route' => ['productos.destroy', $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        <a onclick="editarProducto({{ $id }})" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Editar">
            <i class="fa fa-pencil"></i>
        </a>
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'class' => 'btn btn-danger btn-sm eliminar',
            'title' => 'Eliminar',
            'onclick' => "confirmarEliminacion(this.form, true, () => { window.LaravelDataTables['ProductosTable'].draw() }); return false;"
        ]) !!}
    </div>
{!! Form::close() !!}
