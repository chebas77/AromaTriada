<h1>Crear Producto</h1>
<form action="{{ route('admin.guardarProducto') }}" method="POST">
    @csrf
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion"></textarea>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" required step="0.01">

    <button type="submit">Guardar</button>
</form>
