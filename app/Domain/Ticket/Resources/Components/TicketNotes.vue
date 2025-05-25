<template>
    
    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Notes </h3>
        </div>

        <div class="card-body">
            <div v-if="ticket.isEscalated" class="note text-danger">
                <div class="media">
                    <div class="media-body">
                        <p class="mt-0">
                            <span class="h5">{{ ticket.escalation.agent.name }}</span> Says: 
                        </p>
                        Client issued an escalation on this ticket.
                        <br> 
                        <Link :href="$route('escalations.show', ticket.escalation.id)" class="text-primary">
                            Link
                        </Link>
                    </div>
                </div>
                <hr class="my-3"/>
            </div>

            <div v-for="note in ticket.notes" :key="note.id" class="note">
                <div class="media">
                    <div class="media-body">
                        <p class="mt-0"><span class="h5">{{ note.agent.name }}</span> Says: 
                            <button v-if="$page.props.auth.user.id == note.agent_id" class="float-right text-danger btn" @click="deleteNote(note.id)">X</button>
                        </p>
                        {{ note.note }}
                    </div>
                </div>
                <hr class="my-3"/>
            </div>

            <span class="badge" v-if="ticket.notes.length == 0">No Notes Are Available</span>

        </div>

        <div class="card-footer">
            <div class="form-group">
                <textarea  class="form-control" v-model="form.note" :class="{'is-invalid':errors.note}" id="note" placeholder="Enter Note"></textarea>
                <InputError :message="errors.note"/>
            </div>
            <button type="button" @click="createNote" class="btn btn-primary">Submit</button>
        </div>
    </div>
</template>

<script>
import InputError from '@/Components/InputError.vue'

export default {
    components:{
        InputError,
    },
    props:{
        ticket:Object,
        errors:Object,
    },
    data(){
        return {
            form:{
                note: null,
            }
        }
    },
    methods:{
        createNote(){
            this.$inertia.post(route('tickets.create_note', this.ticket.id), this.form,{
                preserveScroll: true,
            });
            this.form.note = null
        },
        deleteNote(id){
            this.$inertia.delete(route('tickets.delete_note', id),{
                preserveScroll: true,
            });
        },
    }
}
</script>

<style scoped>
    .color{
        display: inline-block;
        height: 30px;
        width: 110px;
    }
</style>