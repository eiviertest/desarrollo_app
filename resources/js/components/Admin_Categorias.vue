<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <button @click="abrirModal()" type="button" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nueva
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="categoria in arrayCategorias" :key="categoria.id">
                                <td v-text="categoria.nombre"></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" @click="deleteCategoria(categoria.id)">
                                        <i class="fa fa-trash"></i>
                                    </button>
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
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar categoría</h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input v-model="nombre" type="text" class="form-control" placeholder="Nombre de categoría">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="saveCategoria()">Guardar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
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
            arrayErrores: [],
            modal: 0,
            nombre: ""
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
        deleteCategoria(id){
            Swal.fire({
            title: '¿Desea eliminar la categoría?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Si`,
            denyButtonText: `No`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.delete('categorias/delete', {params: {id:  id} }).then((response) => {
                    Swal.fire('Categoría eliminada!', '', 'success');
                    this.getCategorias(1);
                }).catch(function (error) {
                    Swal.fire('Error al eliminar', '', 'info');
                })
            } else if (result.isDenied) {
                Swal.fire('Operación cancelada', '', 'info');
            }
            })
        },
        cerrarModal(){
            this.modal = 0;
            this.nombre = '';
        },
        saveCategoria(){
            let me = this;
            axios.post('categorias/save', {
                'nombre' : this.nombre
            }).then(function (response){
                me.cerrarModal();
                me.getCategorias(1);
            }).catch(function (error) {
                me.arrayErrores = error.data;
            });
        },
        abrirModal(){
            this.modal = 1;
            this.nombre = "";
            console.log("Abrir modal");
        },
        getCategorias(page){
            let me = this;
            let url = 'categorias?page=' + page;
            axios.get(url).then(function (response) {
                me.arrayCategorias = response.data.categorias.data;
                me.pagination = response.data.pagination;
            }).catch(function (error) {
                me.arrayErrores = error.data;
            });
        },
        cambiarPagina(page){
            this.pagination.current_page = page;
            this.getCategorias(page);
        },
    },
    mounted(){
        this.getCategorias(1);
    }
}
</script>
<style>
    .modal-content{
        margin: 5% !important;
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>