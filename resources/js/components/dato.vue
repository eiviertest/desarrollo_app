<template>
    <main class="main">
        <div class="card" style="width: 18rem;">
            <img src="src" v-html="scr" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title" v-text="titulo"></h5>
                <p class="card-text" v-text="contenido">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" v-html="href" class="btn btn-primary" v-bind="link">Conocer màs</a>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        components: {
        },
        props: {
            scr: {
                type: String,
                default: 'www.google.com'
            },
            titulo: {
                type: String,
                default: 'Dato interesante 1'
            },
            contenido: {
                type: String,
                default: 'Dato interesante 2'
            },
            href: {
                type: String,
                default: 'www.google.com'
            },
        }
    }
</script>