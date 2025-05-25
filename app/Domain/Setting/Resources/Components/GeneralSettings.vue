<template>
    <div :class="{'active': tab == 'general'}" class="tab-pane" id="general">
        <div class="form-group row">
            <label for="logo" class="col-sm-2 col-form-label">Logo</label>
            <div class="col-sm-10">
                <input type="file" @change="setImage" :class="{'is-invalid':errors.logo}" id="logo">

                <img class="d-block" width="150" :src="settings?.logo"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="websiteName" class="col-sm-2 col-form-label">Website Name</label>
            <div class="col-sm-10">
                <input type="text" :class="{'is-invalid':errors.name}" class="form-control" id="websiteName" @input="$emit('updated', form)" v-model="form.name" placeholder="Website Name">
                <InputError :message="errors.name"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="websiteEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" :class="{'is-invalid':errors.email}" class="form-control" id="websiteEmail" @input="$emit('updated', form)" v-model="form.email" placeholder="Email">
                <InputError :message="errors.email"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="phoneNumber" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
                <input type="text" :class="{'is-invalid':errors.phone_number}" class="form-control" id="phoneNumber" @input="$emit('updated', form)" v-model="form.phone_number" placeholder="Phone Number">
                <InputError :message="errors.phone_number"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="workingHours" class="col-sm-2 col-form-label">Working Hours</label>
            <div class="col-sm-10">
                <input type="text" :class="{'is-invalid':errors.working_hours}" class="form-control" id="workingHours" @input="$emit('updated', form)" v-model="form.working_hours" placeholder="working Hours">
                <InputError :message="errors.working_hours"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="keywords" class="col-sm-2 col-form-label">Keywords</label>
            <div class="col-sm-10">
                <Select2 :settings="{..._settings, multiple: true, tags: true}" v-model="form.keywords" :options=form.keywords :class="{'is-invalid':errors.keywords}"/>
                <InputError :message="errors.keywords"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea v-model="form.description" @input="$emit('updated', form)" :class="{'is-invalid':errors.description}" id="description" class="form-control" placeholder="Description"></textarea>
                <InputError :message="errors.description"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="default_status" class="col-sm-2 col-form-label">Default Status</label>
            <div class="col-sm-10">
                <Select2 class="grid" :settings="_settings" v-model="form.default_status" :class="{'is-invalid':errors.default_status}" :options="_statuses"/>
                <InputError :message="errors.default_status"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="default_severity" class="col-sm-2 col-form-label">Default Severity</label>
            <div class="col-sm-10">
                <Select2 class="grid" :settings="_settings" v-model="form.default_severity" :class="{'is-invalid':errors.default_severity}" :options="_severities"/>
                <InputError :message="errors.default_severity"/>
            </div>
        </div>
    </div>
</template>

<script>
import InputError from '@/Components/InputError.vue';
export default {
    components:{
        InputError,
    },
    props:{
        settings:Object,
        statuses:Object,
        severities:Object,
        errors:Object,
        tab:String,
    },
    computed:{
        _statuses:function(){
            return this.statuses.map(status=>({id:status.id, text:status.name}))
        },
        _severities:function(){
            return this.severities.map(severity=>({id:severity.id, text:severity.name}))
        },
    },
    data(){
        return {
            form:{
                logo:null,
                name:null,
                email:null,
                phone_number:null,
                working_hours:null,
                keywords:null,
                description:null,
                default_status:null,
                default_severity:null,
            },     
            _settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    watch:{
        errors:function(value){
            if(value.name  ==  undefined &&
                value.email  ==  undefined &&
                value.phone_number  ==  undefined &&
                value.working_hours  ==  undefined &&
                value.keywords == undefined &&
                value.description == undefined &&
                value.default_status == undefined &&
                value.default_severity == undefined){
                    this.$emit('onErrors', {key:'general', value:false});
                }else{
                    this.$emit('onErrors', {key:'general', value:true});
                }
        }
    },
    mounted(){
        this.form.name = this.isUndefined(this.settings.name);
        this.form.email = this.isUndefined(this.settings.email);
        this.form.phone_number = this.isUndefined(this.settings.phone_number);
        this.form.working_hours = this.isUndefined(this.settings.working_hours);
        this.form.keywords = this.isUndefined(this.settings.keywords, '').split('|');
        this.form.description = this.isUndefined(this.settings.description);
        this.form.default_status = this.isUndefined(this.settings.default_status);
        this.form.default_severity = this.isUndefined(this.settings.default_severity);
        this.$emit('updated', this.form);
    },
    methods:{
        setImage(event){
            this.form.logo = event.target.files[0];
            this.$emit('updated', this.form);
        }
    }
}
</script>



<style scoped>
    .grid{
        width: 100%;
        display: grid;
    }
</style>