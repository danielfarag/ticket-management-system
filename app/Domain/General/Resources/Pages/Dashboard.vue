<template>
    <Head title="Dashboard - Index" />

    <AuthenticatedLayout>
        <div class="row">
            <div class="col">
                <CardBox icon="bag" :number="users.active + users.inactive" text="Users" color="primary" :url="$route('users.index')"/>
            </div>
            <div class="col">
                <CardBox icon="stats-bars" :number="ticketsSolved" text="Tickets Solved" color="secondary" percentage :url="$route('tickets.index')"/>
            </div>
            <div class="col">
                <CardBox icon="person-add" :number="agents.active + agents.inactive" text="Agents" color="success" :url="$route('users.index')"/>
            </div>
            <div class="col">
                <CardBox icon="pie-graph" :number="escalations.pending + escalations.in_progress" text="Escalations" color="danger" :url="$route('escalations.index')"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <CardBox icon="bag" :number="services.active + services.inactive" text="Services" color="warning" :url="$route('services.index')"/>
            </div>
            <div class="col">
                <CardBox icon="stats-bars" :number="departments.active + departments.inactive" text="Departments" color="info" :url="$route('departments.index')"/>
            </div>
            <div class="col">
                <CardBox icon="person-add" :number="articles.active + articles.inactive" text="Articles" color="dark" :url="$route('articles.index')"/>
            </div>
            <div class="col">
                <CardBox icon="pie-graph" :number="faqs.active + faqs.inactive" text="Faqs" color="light" :url="$route('faqs.index')"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <CardBox icon="bag" :number="todosCount" text="Todos" color="success" :url="$route('todos.index')"/>
            </div>
            <div class="col">
                <CardBox icon="stats-bars" :number="surveys" text="Surveys" color="danger" :url="$route('surveys.index')"/>
            </div>
            <div class="col">
                <CardBox icon="person-add" :number="contacts" text="Contacts" color="secondary" :url="$route('contacts.index')"/>
            </div>
            <div class="col">
                <CardBox icon="pie-graph" :number="members" text="Members" color="primary" :url="$route('members.index')"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-xl-3 col-xs-12">
                <SurveyStatusPie :statuses="survey_by_statuses"/>
            </div>
            <div class="col-md-3 col-xl-3 col-xs-12">
                <TicketStatusPie :statuses="ticket_by_statuses"/>
            </div>
            <div class="col-md-3 col-xl-3 col-xs-12">
                <UserStatusPie :statuses="users"/>
            </div>
            <div class="col-md-3 col-xl-3 col-xs-12">
                <TodoStatusPie :todos="todos"/>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import CardBox from '@/Components/CardBox.vue'
import UserStatusPie from '@/Components/UserStatusPie.vue'
import TodoStatusPie from '@/Components/TodoStatusPie.vue'
import TicketStatusPie from '@/Components/TicketStatusPie.vue'
import SurveyStatusPie from '@/Components/SurveyStatusPie.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        CardBox,
        UserStatusPie,
        TodoStatusPie,
        TicketStatusPie,
        SurveyStatusPie,
    },
    props:{
        users: Object,
        agents: Object,
        departments: Object,
        articles: Object,
        faqs: Object,
        escalations: Object,
        services: Object,
        tickets: Object,
        ticket_by_statuses: Object,
        survey_by_statuses: Object,
        todos: Object,
        surveys: Number,
        contacts: Number,
        members: Number,
    },
    computed:{
        ticketsSolved(){
            if(this.totalTickets == 0){
                return 100;
            }else{
                return ((this.tickets.yes / this.totalTickets ) * 100).toFixed(2);
            }
        },
        totalTickets(){
            return this.tickets.yes + this.tickets.no;
        },
        todosCount(){
            return this.todos.idle + this.todos.todo + this.todos.in_progress + this.todos.urget;
        }
    }
}
</script>
