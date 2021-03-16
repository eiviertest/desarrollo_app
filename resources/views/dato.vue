<template>
    <main class="main">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title" v-text="titulo"></h5>
                <p class="card-text" v-text="contenido">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary" v-bind="link">Conocer màs</a>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
    components: {
    },
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
    methods:{
    },
    mounted() {
        }
    }
</script>