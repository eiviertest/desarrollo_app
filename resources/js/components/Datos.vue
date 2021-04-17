<template>
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4" v-for="dato in arrayDatos" :key="dato.id">
                    <Dato :scr="dato.url_imagen" :titulo="dato.titulo" :contenido="dato.contenido" :href="dato.url_mas_info"></Dato>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import Dato from './dato.vue';
export default {
    components: { Dato },
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
            estado: 1
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
    },
    mounted(){
        this.getDatos(1,0,1);
    }
}
</script>