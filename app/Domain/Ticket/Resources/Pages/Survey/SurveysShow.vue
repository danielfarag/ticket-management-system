<template>
    <Head :title="'Dashboard - Survey - ' + survey.ticket?.subject" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_ticket="survey">
                <Link :href="$route('tickets.show', survey.ticket?.id)">
                    <span class="badge badge-primary mx-2">{{ survey.ticket?.subject }}</span>
                </Link>
            </template>
        </EntityShow>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import EntityShow from '@/Components/EntityShow.vue';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        EntityShow,
    },
    props:{
        survey:Object
    },
    computed:{
        settings(){
            return {
                entity: this.survey,
                lang: {
                    entity: 'Survey',
                },
                routes:{
                    bind: 'survey',
                    destroy: 'surveys.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Ticket',
                        key:'ticket'
                    },
                    { 
                        label:'Resolved',
                        key:'resolved'
                    },
                    { 
                        label:'Comment',
                        key:'comment'
                    },
                    { 
                        label:'Created At',
                        key:'created_at'
                    },
                    { 
                        label:'Updated At',
                        key:'updated_at'
                    },
                ]
            }
        }
    },
}
</script>
