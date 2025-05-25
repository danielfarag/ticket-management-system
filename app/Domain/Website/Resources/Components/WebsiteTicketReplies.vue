<template>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Replies: </h3>
        </div>

        <div class="card-body">

            <div v-for="comment in ticket.comments" :key="comment.id" class="comment">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="https://picsum.photos/id/50/50" alt="">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <span class="comment-desc h5">{{ comment.user.name }}</span> 

                        <span v-if="comment.user.type == 'agent'" class="comment-desc badge bg-success mx-1">Agent</span> 
                        <span v-else class="comment-desc badge bg-primary mx-1">User</span> 
                        Says: 
                        <a class="float-right text-danger btn" @click="deleteComment(comment.id)">X</a>
                        <p class="h4">
                            {{ comment.comment }}
                        </p>
                        <div v-if="comment.attachments.length > 0">
                            <a class="badge bg-primary mx-2" v-for="(url, index) in comment.attachments" :key="index" :href="url" target="_blank"> File {{ index + 1 }}</a>
                        </div>
                    </div>
                </div>
                <hr class="my-3"/>
            </div>

            <code v-if="ticket.comments.length == 0">No Replies Are Available</code>

        </div>

        <div class="card-footer">
            <div class="form-group">
                <textarea v-model="form.comment" :class="{'is-invalid':errors.comment}" class="form-control" id="comment" placeholder="Enter Comment"></textarea>
                <InputError :message="errors.comment"/>
            </div>
            <div class="form-group mt-1">
                <label for="attachments">Attachments</label>
                <input type="file" @change="form.attachments = $event.target.files" multiple :class="{'is-invalid':errors.attachments}" class="form-control"  id="attachments">
                
                <InputError :message="errors.attachments"/>
            </div>

            <button type="button" @click="createComment" class="btn btn-primary mt-2">Submit</button>
        </div>
    </div>

</template>

<script>
export default {
    props:{
        ticket: Object,
        errors: Object,
    },
    data(){
        return {
            form:{
                comment: null,
                attachments: [],
            }
        }
    },
    methods:{
        createComment(){
            this.$inertia.post(route('website.tickets.create_comment', this.ticket.id), this.form,{
                preserveScroll: true,
            });
            this.form.comment = null
        },
        deleteComment(id){
            this.$inertia.delete(route('website.tickets.delete_comment', id),{
                preserveScroll: true,
            });
        },
    }
}
</script>