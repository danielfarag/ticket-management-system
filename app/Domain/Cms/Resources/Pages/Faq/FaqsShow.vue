<template>
    <Head :title="'Dashboard - Faq - ' + faq.question" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_department="faq">
                {{ faq.department?.name }}
            </template>
            <template #column_value_article="faq">
                {{ faq.article_id ? faq.article.title.substr(0,50) : 'N/A' }}
            </template>
        </EntityShow>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import EntityShow from '@/Components/EntityShow.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        EntityShow,
    },
    props:{
        faq:Object
    },
    computed:{
        settings(){
            return {
                entity: this.faq,
                lang: {
                    entity: 'Faq',
                    title: 'question',
                },
                routes:{
                    bind: 'faq',
                    edit: 'faqs.edit',
                    destroy: 'faqs.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Question',
                        key:'question'
                    },
                    { 
                        label:'Answer',
                        key:'answer'
                    },
                    { 
                        label:'Department',
                        key:'department'
                    },
                    { 
                        label:'Article',
                        key:'article'
                    },
                    { 
                        label:'Status',
                        key:'status'
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
