<template>
    <main class="main">
        <div class="container-fluid">
            <div class="card">
                <img v-bind:src="scr" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title" v-text="titulo"></h5>
                    <p class="card-text" v-text="contenido"></p>
                    <a v-bind:href="href" class="btn btn-primary">Conocer más</a>
                </div>
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