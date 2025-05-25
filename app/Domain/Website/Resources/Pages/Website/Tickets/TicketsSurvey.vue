<template>

    <Head title="Profile Page" />

    <WebsiteProfileLayout>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Ticket: <strong>{{ ticket.subject }}</strong></h3>
                    </div>
    
                    <div class="card-body">
                        <table class="table p-4">
                            <tbody>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Id</td>
                                    <td class="fw-bold">{{ ticket.id }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Subject</td>
                                    <td class="fw-bold">{{ ticket.subject }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Category</td>
                                    <td class="fw-bold">{{ ticket.category.name }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Created At</td>
                                    <td class="fw-bold">{{ moment(ticket.created_at) }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Updated At</td>
                                    <td class="fw-bold">{{ moment(ticket.updated_at) }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="container">
                            <div class="row text-center">
                                <div class="col">
                                    <p class="h3 fw-bold">Have we <u class="fw-bolder uppercase">resolved</u> your problem ?</p>
                                    <a @click="setResolved('yes')" :class="{'btn-success':form.resolved == 'yes', 'btn-dark': form.resolved == null || form.resolved == 'no'}"  class="btn h5 px-5 mr-3"> Yes </a>    
                                    <a @click="setResolved('no')" :class="{'btn-danger':form.resolved == 'no', 'btn-dark': form.resolved == null || form.resolved == 'yes'}" class="btn h5 px-5"> No </a>    
                                </div> 
                                <InputError :message="errors.resolved"/>
                            </div> 
                            <div class="row mt-3">
                                <div class="col">
                                    <textarea v-model="form.comment" class="form-control" placeholder="Leave Your Comment ..."></textarea>
                                    <button class="btn btn-primary mt-3" @click="rateTicket"> Submit </button>    
                                    <InputError :message="errors.comment"/>
                                </div> 
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </WebsiteProfileLayout>

</template>


<script>
import WebsiteProfileLayout from '@/Layouts/WebsiteProfile.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        Head,
        Link,
        WebsiteProfileLayout,
        InputError,
    },
    props:{
        ticket:Object,
        errors:Object,
    },
    data(){
        return {
            form:{
                resolved: null,
                comment: null
            }
        }
    },
    methods:{
        rateTicket(){
            this.$inertia.post(route('website.tickets.rate_ticket', this.ticket.id), this.form,{
                preserveScroll: true,
            });
        },
        setResolved(resolved){
            if(this.form.resolved == resolved){
                this.form.resolved = null;
            }else{
                this.form.resolved = resolved;
            }
        }
    }
}
</script>

<style scoped>
.comment-desc{
    font-size: 15px;
    font-family: revert;
    font-style: oblique;
}
.tb-row{
    width:40%;
}
</style>