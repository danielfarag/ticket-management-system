<template>
    <Datatable :settings="settings">
        <template #column_status="slider">
            <span v-if="slider.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_link="slider">
            <a :href="slider.link" target="_blank">Link</a>
        </template>

        <template #column_created_at="slider">
            {{ moment(slider.created_at) }}
        </template>

        <template #column_updated_at="slider">
            {{ moment(slider.updated_at) }}
        </template>

    </Datatable>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import Datatable from '@/Components/Datatable.vue'

export default {
    components:{
        Pagination,
        Datatable
    },
    props:{
        sliders:Object
    },
    computed:{
        settings(){
            return {
                collection:this.sliders,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Sliders',
                    create: 'Create Slider',
                    export: 'Export Sliders',
                    import: 'Import Sliders',
                },
                routes:{
                    bind: 'slider',
                    index: 'sliders.index',
                    create: 'sliders.create',
                    show: 'sliders.show',
                    edit: 'sliders.edit',
                    destroy: 'sliders.destroy',
                    import: 'sliders'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'title',
                        key: 'title',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Subtitle',
                        key: 'subtitle',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Button',
                        key: 'button',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Link',
                        key: 'link',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Status',
                        key: 'status',
                        searchable: {
                            type:'select',
                            options:[
                                {
                                    id:'active',
                                    text:'Active'
                                },{
                                    id:'inactive',
                                    text:'Inactive',
                                }
                            ]
                        },
                        sortable: true,
                    },
                    {
                        name: 'Created At',
                        key: 'created_at',
                        searchable: {
                            type: "date-range"
                        },
                        sortable: true,
                    },
                    {
                        name: 'Updated At',
                        key: 'updated_at',
                        searchable: {
                            type: "date"
                        },
                        sortable: true,
                    }
                ]
            }
        }
    },
}
</script>