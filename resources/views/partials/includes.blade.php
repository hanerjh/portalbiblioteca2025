   @push('css')
        <link rel="stylesheet" href="assets/extensions/summernote/summernote-lite.css">
        <link rel="stylesheet" href="assets/compiled/css/form-editor-summernote.css">

        <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
        <link rel="stylesheet" href="assets/compiled/css/table-datatable.css">
    @endpush


@push('script')
 
 <script>
    // Ejecutar inmediatamente si Livewire ya está disponible
    if (window.Livewire) {
        console.log('Livewire ya está cargado (ejecución directa)');

        Livewire.on('mostrarModalEdicion', data => {

            setTimeout(() => {
                $('#editor').summernote('focus');
               console.log('Recibido desde Livewire:', data);
              $('#editor').summernote('code', data.contenido);
               // Establece el valor del select
               if(data.destacado==true)
               {
                document.getElementById('activaSwitch').checked = true;
               }else{
                document.getElementById('activaSwitch').checked = false;
               }
               
            }, 1000);
        });

        Livewire.on('recargarPagina', () => {
            location.reload(); // 🔄 Recarga toda la página
        });
    }
</script>
<script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="assets/static/js/pages/simple-datatables.js"></script>
@endpush 