<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button v-if="!showCreate" @click="showCreate = !showCreate" type="button" class="btn btn-primary">Create new task</button>
                <button v-else @click="showCreate = !showCreate" type="button" class="btn btn-danger">Close</button>
                <div v-if="showCreate" class="create">
                    <div v-if="taskHelp !== ''" class="alert alert-danger" role="alert" v-text="taskHelp"></div>
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="taskName" id="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="3" v-model="taskDescription" id="description" placeholder="Description"></textarea required>
                        </div>
                        <button type="submit" v-on:click="createTask($event)" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="spacer" style="height: 50px;"></div>
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                tasks: [],
                showCreate: false,
                taskName: '',
                taskDescription: '',
                taskHelp: ''
            }
        },
        methods: {
            getTasks: function() {
                console.log('Fetched tasks');
                // TODO: Get tasks
            },
            createTask: function(event) {
                event.preventDefault();
                if (this.taskName === '' || this.taskDescription === '') {
                    this.taskHelp = this.taskName === '' ? 'You need a name for your task.' : 'You need a description for your task';
                } else {
                    this.taskHelp = '';
                }

                axios.post('/api/tasks/create', {
                        name: this.taskName,
                        description: this.taskDescription
                    })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
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
