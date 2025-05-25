<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>
        <div class="card card-primary">

            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" v-model="form.subject" :class="{'is-invalid':errors.subject}" class="form-control"  id="subject" placeholder="Enter Subject">
                  
                    <InputError :message="errors.subject"/>
                </div>

                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea type="text" v-model="form.body" :class="{'is-invalid':errors.body}" class="form-control"  id="body" placeholder="Enter Body"></textarea>
                  
                    <InputError :message="errors.body"/>
                </div>

                <div class="form-group">
                    <label for="priority">Priority</label>
                    <Select2 :settings="settings" v-model="form.priority" :class="{'is-invalid':errors.priority}" :options="priorities"/>

                    <InputError :message="errors.priority"/>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <Select2 :settings="settings" v-model="form.status" :class="{'is-invalid':errors.status}" :options="statuses"/>

                    <InputError :message="errors.status"/>
                </div>

                <div class="form-group" v-if="user.type == 'admin'">
                    <label for="agent_id">Agent</label>
                    <Select2 :settings="settings" v-model="form.agent_id" :class="{'is-invalid':errors.agent_id}" :options="_agents"/>

                    <InputError :message="errors.agent_id"/>
                </div>

                <div class="form-group">
                    <label for="due_at">Due Date</label>
                    <Datepicker v-model="form.due_at" :class="{'is-invalid':errors.due_at}" id="due_at"  placeholder="Due Date" ></Datepicker>

                    <InputError :message="errors.due_at"/>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" @click="store" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        InputError,
    },
    props:{
        errors: Object,
        todo: Object,
        agents: Array,
    },
    computed:{
        _agents:function(){
            return this.agents.map(user=>({id:user.id, text:user.name}))
        },
        user:function(){
            return this.$page.props.auth.user;
        },
        cardTitle(){
            return this.todo ? 'Edit Todo' : 'Create New Todo';
        }
    },
    data(){
        return {
            form:{
                subject: null,
                body: null,
                priority: 'low',
                status: 'todo',
                agent_id: null,
                due_at: null,
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            },
            priorities: ['low', 'high', 'medium'],
            statuses: ['done', 'idle', 'todo', 'in_progress', 'urget'],
        }
    },
    mounted(){
        if(this.todo){
            this.form.subject = this.todo.subject;
            this.form.body = this.todo.body;
            this.form.priority = this.todo.priority;
            this.form.status = this.todo.status;
            this.form.agent_id = this.todo.agent_id;
            this.form.due_at = this.todo.due_at;
        }
    },
    methods:{
        store(){
            if(this.todo){
                this.$inertia.put(route('todos.update', this.todo.id), {...this.form, id:this.todo.id})
            }else{
                this.$inertia.post(route('todos.store'), this.form)
            }
        }
    }
}
</script>
