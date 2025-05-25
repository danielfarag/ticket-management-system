<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="ip_address">Ip Address</label>
                    <input type="text" v-model="form.ip_address" :class="{'is-invalid':errors.ip_address}" class="form-control"  id="ip_address" placeholder="Enter Ip Address"/>
                  
                    <InputError :message="errors.ip_address"/>
                </div>
                <div class="form-group">
                    <label for="reason">Reason</label>
                    <editor v-model="form.reason" :class="{'is-invalid':errors.reason}" id="reason" :api-key="editorApiKey" placeholder="Enter Reason"/>

                    <InputError :message="errors.reason"/>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" @click="store" class="btn btn-primary">Submit</button>
            </div>
            
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        InputError,
    },
    props:{
        errors: Object,
        blockIp:Object
    },
    data(){
        return {
            form:{
                ip_address:null,
                reason:null,
            },
        }
    },
    computed:{
        cardTitle(){
            return this.blockIp ? 'Edit Block IP' : 'Create New Block IP';
        }
    },
    mounted(){
        if(this.blockIp){
            this.form.ip_address = this.blockIp.ip_address;
            this.form.reason = this.blockIp.reason;
        }
    },
    methods:{
        store(){
            if(this.blockIp){
                this.$inertia.put(route('block_ips.update', this.blockIp.id), {...this.form, id:this.blockIp.id})
            }else{
                this.$inertia.post(route('block_ips.store'), this.form)
            }
        }
    }
}
</script>
