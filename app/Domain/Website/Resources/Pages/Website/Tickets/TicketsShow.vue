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
                                    <td scope="row" class="tb-row text-right">Body</td>
                                    <td class="fw-bold">{{ ticket.body }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Category</td>
                                    <td class="fw-bold">{{ ticket.category.name }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">User</td>
                                    <td class="fw-bold">{{ ticket.user.name }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Severity</td>
                                    <td class="fw-bold">{{ ticket.severity.name }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Status</td>
                                    <td class="fw-bold">{{ ticket.status.name }}</td>
                                </tr>
                                <tr>
                                    <td scope="row" class="tb-row text-right">Attachments</td>
                                    <td class="fw-bold">
                                        <div v-if="ticket.attachments.length > 0">
                                            <a class="badge bg-primary mx-2" v-for="(url, index) in ticket.attachments" :key="index" :href="url" target="_blank"> File {{ index + 1 }}</a>
                                        </div>
                                        <div v-else>
                                            <span class="badge bg-secondary">No Attachments</span>
                                        </div>
                                    </td>
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
                    </div>
    
                    <div class="card-footer">
                        <Link :href="$route('website.tickets.edit', ticket.id)" class="btn btn-link">
                            Edit
                        </Link>

                        <button 
                        v-if="settings.user_can_delete_ticket != false"
                        type="button"
                        @click="deleteTicket" class="btn btn-danger mx-2">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <WebsiteTicketReplies :ticket="ticket" :errors="errors"/>
                
            </div>
        </div>
    </WebsiteProfileLayout>

</template>


<script>
import WebsiteProfileLayout from '@/Layouts/WebsiteProfile.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'
import WebsiteTicketReplies from '@/Components/WebsiteTicketReplies.vue'

export default {
    components: {
        Head,
        Link,
        WebsiteProfileLayout,
        InputError,
        WebsiteTicketReplies,
    },
    props:{
        ticket:Object,
        errors:Object,
    },
    computed:{
        settings(){
            return this.$page.props.settings;
        },
    },
    methods:{
        deleteTicket(){
            this.$inertia.delete(route('website.tickets.destroy', this.ticket.id))
        },
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