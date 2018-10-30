<template>
    <div>
        <div class="flex items-center" v-show="state.edit === false">
            <input type="checkbox" v-model="data.finished" @click="updateTask">
            <p :class="data.finished ? 'line-through text-green' : 'text-grey-darkest cursor-pointer hover:text-black hover:font-bold'" @click="startEdit">{{task.text}}</p>
            <button class="btn btn-outline-warning" @click="remove(index)">Remove</button>
        </div>
        <div class="flex items-center" v-show="state.edit === true">
            <input  v-model="data.text" @keyup.enter="updateTask" placeholder="Update Task">
            <button @click="updateTask" :disabled="data.text.length === 0">Update</button>
            <button @click="cancelEdit">Cancel</button>
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
            finished: false,
        }
      }
    },
    mounted() {
      const t = this;

      t.data.text = t.task.text;
      t.data.finished = t.task.finished;
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
