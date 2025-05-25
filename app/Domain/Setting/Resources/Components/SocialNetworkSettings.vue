<template>
    <div :class="{'active': tab == 'social_network'}" class="tab-pane" id="social_network">
        <div class="form-group row">
            <label for="facebook_url" class="col-sm-2 col-form-label">Facebook Url</label>
            <div class="col-sm-10">
                <input type="text" :class="{'is-invalid':errors.facebook_url}" class="form-control" id="facebook_url" @input="$emit('updated', form)" v-model="form.facebook_url" placeholder="Facebook Url"/>
                <InputError :message="errors.facebook_url"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="twitter_url" class="col-sm-2 col-form-label">Twitter Url</label>
            <div class="col-sm-10">
                <input type="text" :class="{'is-invalid':errors.twitter_url}" class="form-control" id="twitter_url" @input="$emit('updated', form)" v-model="form.twitter_url" placeholder="Twitter Url"/>
                <InputError :message="errors.twitter_url"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="linkedin_url" class="col-sm-2 col-form-label">Linkedin Url</label>
            <div class="col-sm-10">
                <input type="text" :class="{'is-invalid':errors.linkedin_url}" class="form-control" id="linkedin_url" @input="$emit('updated', form)" v-model="form.linkedin_url" placeholder="Linkedin Url"/>
                <InputError :message="errors.linkedin_url"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="instagram_url" class="col-sm-2 col-form-label">Instagram Url</label>
            <div class="col-sm-10">
                <input type="text" :class="{'is-invalid':errors.instagram_url}" class="form-control" id="instagram_url" @input="$emit('updated', form)" v-model="form.instagram_url" placeholder="Instagram Url"/>
                <InputError :message="errors.instagram_url"/>
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
                facebook_url:null,
                twitter_url:null,
                linkedin_url:null,
                instagram_url:null,
            }
        }
    },
    watch:{
        errors:function(value){
            if(value.facebook_url  ==  undefined &&
                value.twitter_url  ==  undefined &&
                value.linkedin_url  ==  undefined &&
                value.instagram_url == undefined){
                    this.$emit('onErrors', {key:'social_network', value:false});
                }else{
                    this.$emit('onErrors', {key:'social_network', value:true});
                }
        }
    },
    mounted(){
        this.form.facebook_url = this.isUndefined(this.settings.facebook_url);
        this.form.twitter_url = this.isUndefined(this.settings.twitter_url);
        this.form.linkedin_url = this.isUndefined(this.settings.linkedin_url);
        this.form.instagram_url = this.isUndefined(this.settings.instagram_url);
        this.$emit('updated', this.form);
    },
}
</script>