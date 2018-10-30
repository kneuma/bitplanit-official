<template>
    <div>
        <div>
            <h1>Todo List</h1>
            <div>
                <input v-model="newTask" @keyup.enter="addTask" placeholder="Add Task">
                <button @click="addTask" :disabled="newTask.length === 0">Add</button>
            </div>
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
