(function(){
    const btnRegistrar = document.querySelector("#crearCategoria")

    if(btnRegistrar){
        btnRegistrar.addEventListener('click', (e) =>{
            e.preventDefault()
            procesarDatos('new')
        })
    }

    async function procesarDatos(accion){
        const nombre = document.querySelector('#nombre')
        const estado = document.querySelector('#estado')

        if(!nombre.value || !estado.value){
            Swal.fire('Error', "Debe completar todos los datos", 'error')
            return
        }

        Swal.fire({
            title: "Procesando datos",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading()
            }
        })

        const datos = new FormData()
        datos.append("nombre", nombre.value)
        datos.append("estado", estado.value)
        datos.append("accion", accion)

        const url = "/api/categorias"
        try {
            const respuesta = await fetch(url, {
                method: "POST",
                body: datos
            })
            const resultado = await respuesta.json()
            if(resultado.estado){
                Swal.fire({
                    timer: 1000,
                    icon: 'success',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false
                }).then((result) => {
                    window.location = "/admin/categorias"
                })
            }
        } catch (error) {
            Swal.fire("Error", "Error al procesar los datos", 'error')
        }
    }
})()