<template>
    <button @click="openModal" type="button" class="btn btn-info">Edit</button>
</template>

<script>
    export default {
        name: "EditTask",
        props: ['task'],
        data: function () {
            return {
                help: ''
            }
        },
        methods: {
            openModal: function () {
                this.$emit('openModal', this.task);
            },
        },
        mounted() {
            console.log('Edit Component mounted.');
        }
    }
</script>
