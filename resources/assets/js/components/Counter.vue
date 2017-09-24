<template>
    <div class="d-flex">
        <p class="lead">Online Now:</p>
        <p class="lead ml-2">{{ this.count }}</p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                count: 0
            }
        },
        mounted() {
            this.listen();
        },
        methods: {
            listen() {
                Echo.join('counter')
                    .here(users => this.count = users.length)
                    .joining(user => this.count++)
                    .leaving(user => this.count--);
            }
        }
    }
</script>
