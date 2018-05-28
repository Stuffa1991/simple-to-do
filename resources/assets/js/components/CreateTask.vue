<template>
    <div class="create-task">
        <div v-if="help !== ''" class="alert alert-danger" role="alert" v-text="help"></div>
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" v-model="name" id="name" placeholder="Name"
                       required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="3" v-model="description" id="description"
                          placeholder="Description"></textarea required>
            </div>
            <button type="submit" v-on:click="createTask($event)" class="btn btn-primary">Submit</button>
            <button v-on:click="$emit('close')" type="button" class="btn btn-danger">
                Close
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CreateTask",
        data: function () {
            return {
                name: '',
                description: '',
                help: ''
            }
        },
        methods: {
            createTask: function (event) {
                event.preventDefault();
                if (this.taskName === '' || this.taskDescription === '') {
                    this.taskHelp = this.taskName === '' ? 'You need a name for your task.' : 'You need a description for your task.';
                }
                var self = this;

                axios.post('/api/tasks/create', {
                        name: self.name,
                        description: self.description
                    })
                    .then(function (response) {
                        self.help = '';
                        self.name = '';
                        self.description = '';
                        console.log(response);
                        self.$emit('newTask', response.data.task);
                    })
                    .catch(function (error) {
                        self.help = error.error;
                    });
            },
        },
        mounted() {
            console.log('Create Component mounted.')
        }
    }

</script>
