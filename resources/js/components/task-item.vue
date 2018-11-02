<template>
    <div class="card">
        <div v-show="state.edit === false">
            <div class="card-header bg-light">
                Progress:
                <div class="align-right">
                    <button class="btn btn-outline-info btn-sm" @click="remove(index)">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="remove(index)">X</button>
                </div>
            </div>

            <div class="card-body">
                <div class="align-left">
                    <input type="checkbox" v-model="data.finished" @click="updateTask">
                </div>
                <h5 class="text-center" @click="startEdit">{{task.text}}</h5>
                <div class="align-left">
                    Reward:
                </div>

                <div class="align-right"   >
                    <button class="btn btn-outline-warning btn-md">Spend Energy:</button>
                </div>

            </div>
            <div class="card-footer bg-light">
                <div class="align-left">
                    Due:
                </div>

                <div class="align-right">
                    <button class="btn btn-secondary btn-sm">Subtasks v</button>
                </div>
            </div>
        </div>


        <div v-show="state.edit === true">
            <div class="delete-task card-header">
                <button class="btn btn-outline-danger btn-sm" @click="remove(index)">X</button>
            </div>
            <div class="card-body text-center">
                <input  v-model="data.text" @keyup.enter="updateTask" placeholder="Update Task">
                <button class="btn btn-warning btn-sm" @click="updateTask" :disabled="data.text.length === 0">Update</button>
                <button class="btn btn-primary btn-sm" @click="cancelEdit">Cancel</button>
                <hr />
            </div>

        </div>
    </div>
</template>

<script>
  export default{
    props: ['task', 'index'],
    data(){
      return{
        state: {
          edit: false,
        },
        data: {
            text: '',
            mins: '',
            finished: false,

        }
      }
    },
    mounted() {
      const t = this;

      t.data.text = t.task.text;
      t.data.finished = t.task.finished;
      t.data.mins = t.task.mins;
    },
    methods: {
      updateTask() {
        const t = this;

        t.$nextTick(() => {
            bus.$emit('update-task', {data: t.data, index: t.index, id: t.task.id});
        })

        t.state.edit = false;
      },
      remove() {
        const t = this;

        bus.$emit('remove-task', {index: t.index, id: t.task.id});
      },
      startEdit() {
        const t = this;

        if(t.data.finished === false) {
            t.state.edit = true;
        }
      },
      cancelEdit() {
        const t = this;

        t.state.edit = false;
        t.data.text = t.task.text;
      }
    }
  }
</script>
