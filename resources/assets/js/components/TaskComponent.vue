<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">My Tasks</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                tasks: []
            }
        },
        methods: {
            getTasks: function() {
                console.log('Fetched tasks');
                // TODO: Get tasks
                // axios.get('/getTasks')
                //     .then(function (response) {
                //         console.log(response);
                //     })
                //     .catch(function (error) {
                //         console.log(error);
                //     });
            }
        },
        created() {
            this.getTasks();
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
