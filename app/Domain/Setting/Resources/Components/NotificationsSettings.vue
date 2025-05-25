<template>
    <div :class="{'active': tab == 'notifications'}" class="tab-pane" id="notifications">
    
        <div class="form-group row">
            <label for="emails_notify" class="col-sm-2 col-form-label">Emails To notify once Ticket create/updated/deleted</label>
            <div class="col-sm-10">
                <Select2 class="grid" :settings="{..._settings, multiple: true, tags: true}" v-model="form.emails_notify" :options=form.emails_notify :class="{'is-invalid':errors.emails_notify}"/>
                <InputError :message="errors.emails_notify"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="sent_mail_ticket_created" class="col-sm-2 col-form-label">Send Mail to user once ticket is created.</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.sent_mail_ticket_created"  class="custom-control-input" id="sent_mail_ticket_created">
                    <label class="custom-control-label" for="sent_mail_ticket_created"></label>
                </div>
                <InputError :message="errors.sent_mail_ticket_created"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="user_can_delete_ticket" class="col-sm-2 col-form-label">Client can delete tickets.</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.user_can_delete_ticket"  class="custom-control-input" id="user_can_delete_ticket">
                    <label class="custom-control-label" for="user_can_delete_ticket"></label>
                </div>
                <InputError :message="errors.user_can_delete_ticket"/>
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
        errors:Object,
        tab:String,
    },
    data(){
        return {
            form:{
                emails_notify:null,
                sent_mail_ticket_created:false,
                user_can_delete_ticket:false,
            },     
            _settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }   
        }
    },
    watch:{
        errors:function(value){
            if( value.emails_notify  ==  undefined &&
                value.sent_mail_ticket_created  ==  undefined &&
                value.user_can_delete_ticket  ==  undefined){
                    this.$emit('onErrors', {key:'notifications', value:false});
                }else{
                    this.$emit('onErrors', {key:'notifications', value:true});
                }
        }
    },
    mounted(){
        this.form.emails_notify = this.isUndefined(this.settings.emails_notify, '').split('|');
        this.form.sent_mail_ticket_created = this.isUndefined(this.settings.sent_mail_ticket_created, false)  == true;
        this.form.user_can_delete_ticket = this.isUndefined(this.settings.user_can_delete_ticket, false)  == true;
        this.$emit('updated', this.form);
    },
}
</script>


<style scoped>
    .grid{
        width: 100%;
        display: grid;
    }
</style>