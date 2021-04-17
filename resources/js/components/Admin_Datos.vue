<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="categoria">Categoría</label>
                            <select class="form-control col-md-3" v-model="categoria_id" @change="getDatos(1, categoria_id, estado)">
                                <option value="0">Seleccionar categoría</option>
                                <option v-for="categoria in arrayCategorias" :value="categoria.id" v-text="categoria.nombre" v-bind:key="categoria.id"></option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="estado">Estado</label>
                            <select class="form-control col-md-3" v-model="estado" @change="getDatos(1, categoria_id, estado)">
                                <option value="-1">Seleccionar estado</option>
                                <option value="0">Rechazado</option>
                                <option value="1">Aceptado</option>
                                <option value="2">En proceso</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Contenido</th>
                                <th>Categoria</th>
                                <th>Más info</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="dato in arrayDatos" :key="dato.id">
                                <td v-text="dato.titulo"></td>
                                <td v-text="dato.contenido"></td>
                                <td v-text="dato.categoria"></td>
                                <td>
                                    <a :href="dato.url_mas_info" v-text="dato.url_mas_info"></a>
                                </td>
                                <td>
                                    <div v-if="dato.estado === 0">
                                        <span class="badge badge-danger">Rechazado</span>
                                    </div>
                                    <div v-if="dato.estado === 1">
                                        <span class="badge badge-success">Aceptado</span>
                                    </div>
                                    <div v-if="dato.estado === 2">
                                        <span class="badge badge-warning">En proceso</span>
                                    </div>
                                </td>
                                <td>
                                    <template v-if="dato.estado === 0">
                                        <button type="button" class="btn btn-success btn-sm" @click="aceptarDato(dato.id)">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </template>
                                    <template v-if="dato.estado === 1">
                                        <button type="button" class="btn btn-danger btn-sm" @click="rechazarDato(dato.id)">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </template>
                                    <template v-if="dato.estado === 2">
                                        <button type="button" class="btn btn-danger btn-sm" @click="rechazarDato(dato.id)">
                                            <i class="fa fa-close"></i>
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" @click="aceptarDato(dato.id)">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Anterior</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click="cambiarPagina(pagination.current_page + 1)">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- ./Tabla Listado -->
        </div>
    </main>
</template>
<script>
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            pagination: {
                'total': 0, 
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
            offset: 2,
            arrayCategorias: [],
            arrayDatos: [],
            arrayErrores: [],
            modal: 0,
            nombre: "",
            categoria_id: 0,
            estado: -1
        }
    },
    computed: {
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function(){
            if(!this.pagination.to){
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }
            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        aceptarDato(id){
            Swal.fire({
            title: '¿Desea aceptar el dato?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`,
            denyButtonText: `No`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.put('datos_interesantes/aceptar', {id:  id}).then((response) => {
                    Swal.fire('Dato aceptado!', '', 'success');
                    this.getDatos(1, 0, -1);
                }).catch(function (error) {
                    Swal.fire('Error al aceptar el dato', '', 'info');
                })
            } else if (result.isDenied) {
                Swal.fire('Operación cancelada', '', 'info');
            }
            })
        },
        rechazarDato(id){
            Swal.fire({
            title: '¿Desea rechazar el dato?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`,
            denyButtonText: `No`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.put('datos_interesantes/rechazar', {id:  id}).then((response) => {
                    Swal.fire('Dato rechazado!', '', 'success');
                    this.getDatos(1, 0, -1);
                }).catch(function (error) {
                    Swal.fire('Error al rechar el dato', '', 'info');
                })
            } else if (result.isDenied) {
                Swal.fire('Operación cancelada', '', 'info');
            }
            })
        },
        getDatos(page, categoria, estado){
            let me = this;
            let url = 'datos_interesantes?page=' + page;
            axios.get(url, {params: { categoria : categoria, estado : estado}}).then(function (response) {
                me.arrayDatos = response.data.datos.data;
                me.pagination = response.data.pagination;
            }).catch(function (error) {
                me.arrayErrores = error.data;
            });
        },
        getCategorias(){
            let me = this;
            let url = 'categorias';
            axios.get(url).then(function (response) {
                me.arrayCategorias = response.data.categorias.data;
            }).catch(function (error) {
                me.arrayErrores = error.data;
            });
        },
        cambiarPagina(page){
            this.pagination.current_page = page;
            this.getDatos(page, 0, -1);
        },
    },
    mounted(){
        this.getDatos(1, 0, -1);
        this.getCategorias();
    }
}
</script>
<style>
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>