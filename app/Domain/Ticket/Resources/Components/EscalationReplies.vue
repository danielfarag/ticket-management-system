<template>
    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Replies </h3>
        </div>

        <div class="card-body">

            <div v-for="comment in escalation.comments" :key="comment.id" class="comment">
                <div class="media">
                    <div class="media-body">
                        <p class="mt-0"><span class="h5">{{ comment.user.name }}</span> 
                            <span v-if="comment.user.type == 'agent'" class="badge badge-success">Agent</span> 
                            <span v-else class="badge badge-primary">User</span> 
                            Says: 
                            <a class="float-right text-danger btn" @click="deleteComment(comment.id)">X</a>
                        </p>
                        <p>
                            {{ comment.comment }}
                        </p>
                        <div v-if="comment.attachments.length > 0">
                            <a class="badge badge-primary mx-2" v-for="(url, index) in comment.attachments" :key="index" :href="url" target="_blank"> File {{ index + 1 }}</a>
                        </div>
                    </div>
                </div>
                <hr class="my-3"/>
            </div>

            <span class="badge" v-if="escalation.comments.length == 0">No Replies Are Available</span>

        </div>

        <div class="card-footer">
            <div class="form-group">
                <textarea class="form-control" v-model="form.comment" :class="{'is-invalid':errors.comment}" id="comment" placeholder="Enter Comment"></textarea>
                <InputError :message="errors.comment"/>
            </div>

            <div class="form-group">
                <label for="attachments">Attachments</label>
                <input type="file" @change="form.attachments = $event.target.files" multiple :class="{'is-invalid':errors.attachments}" class="form-control"  id="attachments">
                
                <InputError :message="errors.attachments"/>
            </div>


            <button type="button" @click="createComment" class="btn btn-primary">Submit</button>
        </div>
    </div>
</template>

<script>
import InputError from '@/Components/InputError.vue'

export default {
    components:{
        InputError
    },
    props:{
        escalation:Object,
        errors:Object,
    },
    data(){
        return {
            form:{
                comment: null,
                attachments:[],
            }
        }
    },
    methods:{
        createComment(){
            this.$inertia.post(route('escalations.create_comment', this.escalation.id), this.form,{
                preserveScroll: true,
            });
            this.form.comment = null
        },
        deleteComment(id){
            this.$inertia.delete(route('escalations.delete_comment', id),{
                preserveScroll: true,
            });
        },
    }
}
</script>