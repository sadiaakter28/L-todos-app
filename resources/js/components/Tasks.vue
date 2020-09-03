<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="pannel-heading">Task</div>

                    <div class="pannel-body">
                        <div class="input-group">
                            <input
                                type="text" class="form-control"
                                v-model="task.title"
                                @keydown.enter="create"
                            >
                            <span class="input-group-btn">
                                    <button class="btn btn-success" @click="create">Add</button>
                                </span>
                        </div>
                        <div class="tasks-list">
                            <ul class="li-unstyled">
                                <li v-for="task in tasks" :key="task.id" :class="{ done: task.completed}">
                                    <div class="checkbox">
                                        <lebel>
                                            <input type="checkbox" v-model="task.completed" @click="done(task)"> {{task.title}}
                                        </lebel>
                                        <div class="pull-right">
                                            <a href="#" @click.prevent="remove(task)">x</a>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "tasks",
        mounted() {
            this.fetchData()
        },
        data () {
            return {
                tasks: [],
                task: {
                    title: ''
                }
            }
        },
        methods: {
            fetchData () {
                // console.log('hi');
                axios.get('/api/tasks')
                    .then((res)=> {
                        this.tasks = res.data
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },

            create () {
                // console.log('hi');
                axios.post('/api/tasks', this.task)
                    .then((res)=> {
                        this.tasks.unshift(res.data);
                        this.task.title = ''
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },
            done (task){
                axios.put('/api/tasks/${task.id}' , {
                    completed: !task.completed
                })
                    .then((res)=> {
                        console.log('task updated')
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },

            remove (task){
                axios.delete('/api/tasks/${task.id}')
                    .then((res)=> {
                       const taskIndex = this.tasks.indexOf(task); 
                        this.tasks.splice(taskIndex, 1)
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            }
        }
    }
</script>
<style>
    body, .tasks-list{
        padding-top: 20px;
    }
    .done lebel {
        text-decoration: line-through;
    }
</style>
