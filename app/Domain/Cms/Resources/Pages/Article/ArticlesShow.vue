<template>
    <Head :title="'Dashboard - Article - ' + article.title" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_author="article">
                {{ article.author?.name }}
            </template>
            <template #column_value_image="article">
                <img width="150" :src="article.image"/>
            </template>
            <template #column_value_category="article">
                {{ article.category?.name }}
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
        article:Object
    },
    computed:{
        settings(){
            return {
                entity: this.article,
                lang: {
                    entity: 'Article',
                    title: 'title',
                },
                routes:{
                    bind: 'article',
                    edit: 'articles.edit',
                    destroy: 'articles.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Title',
                        key:'title'
                    },
                    { 
                        label:'Body',
                        key:'body'
                    },
                    { 
                        label:'Category',
                        key:'category'
                    },
                    { 
                        label:'Author',
                        key:'author'
                    },
                    { 
                        label:'Status',
                        key:'status'
                    },
                    { 
                        label:'Image',
                        key:'image'
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
