<template>
    <main class="main">
        <div class="container-fluid">
            <form>
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input v-model="dato.titulo" type="text" class="form-control" placeholder="Ingrese el titulo">
                </div>
                <div class="form-group">
                    <label for="contenido">Contenido</label>
                    <textarea v-model="dato.contenido" class="form-control" rows="6"></textarea>
                </div>
                <div class="form-group">
                    <label for="url_mas_info">URL para más información</label>
                    <input v-model="dato.url_mas_info" type="text" class="form-control" placeholder="URL más información">
                </div>
                <div class="form-group">
                    <label for="url_imagen">URL para imagen</label>
                    <input v-model="dato.url_imagen" type="text" class="form-control" placeholder="URL para imagen">
                </div>
                <div class="form-group">
                    <select class="form-control" v-model="dato.categoria_key">
                        <option disabled value="0" selected>Seleccione una categoría</option>
                            <option v-for="categoria in arrayCategorias" :value="categoria.id" v-text="categoria.nombre" v-bind:key="categoria.id"></option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" @click="enviarDato()">Enviar</button>
            </form>
        </div>
    </main>
</template>
<script>
import Swal from 'sweetalert2';
export default {
    data(){
        return {
            dato: {
                'titulo': "",
                'contenido': "",
                'url_mas_info': "",
                'url_imagen': "",
                'url_imagen': "",
                'categoria_key': 0
            },
            arrayCategorias: [],
            arrayErrores: [],
        }
    },
    methods: {
        getCategorias(){
            let me = this;
            let url = 'categorias';
            axios.get(url).then(function (response) {
                me.arrayCategorias = response.data.categorias.data;
            }).catch(function (error) {
                me.arrayErrores = error.data;
            });
        },
        resetVariables(){
            this.dato = {
                'titulo': "",
                'contenido': "",
                'url_mas_info': "",
                'url_imagen': "",
                'url_imagen': "",
                'categoria_key': 0
            };
        },
        enviarDato(){
            let me = this;
            axios.post('datos_interesantes/store',{
                'dato': me.dato
            }).then(function (response) {
                me.resetVariables();
                Swal.fire(
                    'Buen trabajo!',
                    'Dato enviado correctamente',
                    'success'
                    )
            }).catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo salió mal!',
                    })
                me.arrayErrores = error.data;
            });
        },
    },
    mounted(){
        this.getCategorias();
    }
}
</script>