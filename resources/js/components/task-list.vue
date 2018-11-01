<template>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Create A Task</h3>
            <div class="form-group align-center">
                <input class="form-control" v-model="newTask" @keyup.enter="addTask" placeholder="Add Task">
                <br />
                <h5>Estimated Time</h5>
                <div class="row">
                <div class="col">
                    <select class="form-control form-control-sm" id="time-hrs">
                        <option> 0</option>
                        <option> 1</option>
                        <option> 2</option>
                        <option> 3</option>
                        <option> 4</option>
                        <option> 5</option>
                        <option> 6</option>
                        <option> 7</option>
                        <option> 8</option>
                        <option> 9</option>
                        <option> 10</option>
                        <option> 11</option>
                        <option> 12</option>
                        <option> 13</option>
                        <option> 14</option>
                        <option> 15</option>
                    </select>
                    <h5>hours</h5>
                </div>
                <div class="col">
                    <select class="form-control form-control-sm" id="time-mins">
                        <option> 00</option>
                        <option> 15</option>
                        <option> 30</option>
                        <option> 45</option>
                    </select>
                    <h5>minutes</h5>
                </div>
            </div>
                <br />
                <button class="btn btn-primary btn-block" @click="addTask" :disabled="newTask.length === 0">Add</button>
            </div>
            <h2 class="text-center">Tasks</h2>
        </div>
        <div>
            <task-item v-for="(task, index) in tasks" :key="task.id" :task="task" :index="index"></task-item>
            <div v-if="tasks.length === 0">
                <p>There are no tasks</p>
            </div>
        </div>
    </div>
</template>

<script>
    import taskItem from './task-item'
    export default{
        data(){
            return{
                tasks: [],
                newTask: '',
            }
        },
        created() {
          this.getTasks();
          this.initListeners();
        },
        methods: {
            initListeners() {
                const t = this;

                bus.$on('update-task', function (details) {
                  t.updateTask(details);
                })

                bus.$on('remove-task', function (details) {
                  t.removeTask(details);
                })
            },
            getTasks() {
              const t = this;

              axios.get('/tasks')
                  .then(({data}) => {
                    t.tasks = data;
                  });
            },
            createTask(text) {
                const t = this;

                axios.post('/tasks', {text: text, finished: false})
                    .then(({data}) => {
                        t.tasks.unshift(data);
                    });
            },
            addTask() {
                const t = this;

                if(t.newTask.length > 0) {
                  t.createTask(t.newTask);
                  t.newTask = '';
                }
            },
            updateTask(details) {
                const t = this;

                axios.patch('/tasks/'+ details.id, details.data)
                  .then(({data}) => {
                    t.tasks.splice(details.index, 1, data)
                  })
                },
            removeTask(details) {
                const t = this;

                axios.delete('/tasks/'+ details.id)
                  .then(() => {
                    t.tasks.splice(details.index, 1)
                  })
                },
        },
        components: {
          taskItem
        }
    }
</script>
