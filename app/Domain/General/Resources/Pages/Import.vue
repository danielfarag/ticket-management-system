<template>
    <Head :title="'Dashboard - Import - ' + request.type" />

    <AuthenticatedLayout>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <p class="h5 m-0">Import <span class="uppercase">{{ request.type }}</span></p>
                </div>
                <div class="card-tools">
                    <a :href="$route('export', {type: request.type, dummy: true})" class="btn btn-tool text-primary">
                        Export Dummy
                    </a>
                </div>
            </div>

            <div class="card-body">
                <InputError :message="errors.type"/>

                <div class="form-group">
                    <label for="file" class="d-block">Excel File: </label>
                    <input type="file" @change="form.file = $event.target.files[0]" :class="{'is-invalid':errors.file}" id="file">
                
                    <InputError :message="errors.file"/>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" @click="upload" class="btn btn-primary">Submit</button>
            </div>
            
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        InputError
    },
    props:{
        errors: Object,
        request: Object
    },
    data(){
        return {
            form:{
                type:null,
                file:null,
            },
        }
    },
    mounted(){
        this.form.type = this.request.type
    },
    methods:{
        upload(){
            this.$inertia.post(route('import.upload', {entity: this.request.entity, redirect: this.request.redirect}), this.form)
        }
    }
}
</script>
