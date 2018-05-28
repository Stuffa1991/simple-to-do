<template>
    <div class="container tasks">
        <!-- MODAL -->
        <div class="modal" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="taskToEdit.name" id="name"
                                   placeholder="Name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="3" v-model="taskToEdit.description" id="description"
                                      placeholder="Description"></textarea required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="editTask()" type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button v-if="!showCreate" @click="showCreate = !showCreate" type="button" class="btn btn-primary">
                    Create new task
                </button>
                <div v-if="showCreate" class="create">
                    <CreateTask @close="showCreate = !showCreate" @newTask="newTask"></CreateTask>
                </div>
            </div>
        </div>
        <div class="spacer" style="height: 50px;"></div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">My Tasks</h1>
                        <p class="lead">This is an overview of your created tasks.</p>
                    </div>
                </div>

                <div class="delete-spacing">
                    <button v-show="tasksToDelete.length > 0" @click="deleteTask()" type="button"
                            class="btn btn-danger delete">
                        Delete selected
                    </button>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(task, index) in tasks">
                        <th>
                            <input type="checkbox" :id="task.id" :value="task.id" v-model="tasksToDelete">
                        </th>
                        <th>
                            {{ index + 1 }}
                        </th>
                        <td v-text="task.name"></td>
                        <td v-text="task.description"></td>
                        <td>
                            <EditTask :task="task" :modal="true" @openModal="openEditModal"></EditTask>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import CreateTask from "./CreateTask";
    import EditTask from "./EditTask";

    export default {
        components: { EditTask, CreateTask },
        data: function () {
            return {
                tasks: [],
                showCreate: false,
                showEdit: false,
                showEditModal: false,
                tasksToDelete: [],
                taskToEdit: {
                    name: '',
                    description: '',
                    id: null
                }
            }
        },
        methods: {
            getTasks: function () {
                var self = this;
                // Make a request for a user with a given ID
                axios.get('/api/tasks/all')
                    .then(function (response) {
                        self.tasks = response.data.tasks;
                    })
                    .catch(function (error) {

                    });
            },
            newTask: function (task) {
                this.tasks.push(task);
                this.showCreate = false;
            },
            openEditModal: function (task) {
                this.taskToEdit.name = task.name;
                this.taskToEdit.description = task.description;
                this.taskToEdit.id = task.id;
                $('#editModal').modal();
            },
            editTask: function () {
                var self = this;
                axios.post('/api/tasks/edit', {
                        name: self.taskToEdit.name,
                        description: self.taskToEdit.description,
                        id: self.taskToEdit.id
                    })
                    .then(function (response) {
                        $('#editModal').modal('hide');

                        var findIndex = self.tasks.findIndex(function (obj) {
                            return obj.id === self.taskToEdit.id
                        });

                        self.tasks[findIndex].name = self.taskToEdit.name;
                        self.tasks[findIndex].description = self.taskToEdit.description;
                    })
                    .catch(function (error) {
                        self.help = error.error;
                    });

            },
            deleteTask: function () {
                var self = this;
                axios.post('/api/tasks/delete', {
                        id: self.tasksToDelete,
                    })
                    .then(function (response) {
                        self.tasks = self.tasks.filter(function (obj) {
                            return self.tasksToDelete.indexOf(obj.id) === -1
                        });
                    })
                    .catch(function (error) {
                        self.help = error.error;
                    });
            }
        },
        created() {
            this.getTasks();
        },
        mounted() {
            console.log('Task Component mounted.');
        }
    }
</script>
