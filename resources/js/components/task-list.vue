<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Create A Task</h3>

                <div class="form-group align-center">
                    <input class="form-control" v-model="newTask" name="text" placeholder="Add Task">
                    <br />
                </div>

                <div class="form-group align-center">
                    <label><h5>Estimated Time to Complete</h5></label>
                    <select class="form-control form-control-sm" v-model="mins" name="mins">
                        <option value="15"> 15mins</option>
                        <option value="30"> 30mins</option>
                        <option value="45mins"> 45mins</option>
                        <option value="60"> 1 hr</option>
                        <option value="75"> 1hr 15mins</option>
                        <option value="90"> 1hr 30 mins</option>
                        <option value="105"> 1hr 45mins</option>
                        <option value="120"> 2hrs</option>
                        <option value="135"> 2hrs 15mins</option>
                        <option value="150"> 2hrs 30mins</option>
                        <option value="165"> 2hrs 45mins</option>
                        <option value="180"> 3hrs</option>
                        <option value="195"> 3hrs 15mins</option>
                        <option value="210"> 3hrs 30mins</option>
                        <option value="225"> 3hrs 45mins</option>
                        <option value="240"> 4hrs</option>
                    </select>
                    <h5>minutes</h5>
                </div>


                <div class="form-group align-center">
                    <br />
                    <button class="btn btn-primary btn-block" @click="addTask" :disabled="newTask.length === 0">Add</button>
                </div>


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
                mins:''
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
            createTask(text, mins) {
                const t = this;

                axios.post('/tasks', {text: text, mins: mins, finished: false})
                    .then(({data}) => {
                        t.tasks.unshift(data);
                    });
            },
            addTask() {
                const t = this;

                if(t.newTask.length > 0) {
                  t.createTask(t.newTask, t.mins);
                  t.newTask = '';
                  t.mins = '';
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
