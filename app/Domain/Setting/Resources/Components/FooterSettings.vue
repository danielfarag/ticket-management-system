<template>
    <div :class="{'active': tab == 'footer'}" class="tab-pane" id="footer">
        <div class="form-group row">
            <label for="footer_logo" class="col-sm-2 col-form-label">Footer Logo</label>
            <div class="col-sm-10">
                <input type="file" @change="setImage" :class="{'is-invalid':errors.footer_logo}" id="footer_logo">

                <img class="d-block" width="150" :src="settings?.footer_logo"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="footer_about" class="col-sm-2 col-form-label">About</label>
            <div class="col-sm-10">
                <textarea v-model="form.footer_about" :class="{'is-invalid':errors.footer_about}" class="form-control" id="footer_about" placeholder="About"/>
                <InputError :message="errors.footer_about"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="copyrights" class="col-sm-2 col-form-label">Copyrights</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" :class="{'is-invalid':errors.copyrights}" id="copyrights" @input="$emit('updated', form)" v-model="form.copyrights" placeholder="Copyrights"/>
                <InputError :message="errors.copyrights"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" :class="{'is-invalid':errors.address}" id="address" @input="$emit('updated', form)" v-model="form.address" placeholder="Address"/>
                <InputError :message="errors.address"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="show_address" class="col-sm-2 col-form-label">Show Address</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_address"  class="custom-control-input" id="show_address">
                    <label class="custom-control-label" for="show_address"></label>
                </div>
                <InputError :message="errors.show_address"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="show_quick_link" class="col-sm-2 col-form-label">Show Quick Links</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_quick_links"  class="custom-control-input" id="show_quick_links">
                    <label class="custom-control-label" for="show_quick_links"></label>
                </div>
                <InputError :message="errors.show_quick_links"/>
            </div>
        </div>


        <div class="form-group row">
            <label for="show_quick_link" class="col-sm-2 col-form-label">Show About</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_about"  class="custom-control-input" id="show_about">
                    <label class="custom-control-label" for="show_about"></label>
                </div>
                <InputError :message="errors.show_about"/>
            </div>
        </div>


        <div class="form-group row">
            <label for="show_quick_link" class="col-sm-2 col-form-label">Show Social Networks</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_social_networks"  class="custom-control-input" id="show_social_networks">
                    <label class="custom-control-label" for="show_social_networks"></label>
                </div>
                <InputError :message="errors.show_social_networks"/>
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
                footer_logo:null,
                copyrights:null,
                footer_about:null,
                address:null,
                show_address:false,
                show_quick_links:false,
                show_about:false,
                show_social_networks:false,
            }
        }
    },
    watch:{
        errors:function(value){
            if( value.copyrights  ==  undefined &&
                value.footer_about  ==  undefined &&
                value.address  ==  undefined &&
                value.show_address == undefined &&
                value.show_social_networks == undefined &&
                value.show_about == undefined &&
                value.show_quick_links == undefined){
                    this.$emit('onErrors', {key:'footer', value:false});
                }else{
                    this.$emit('onErrors', {key:'footer', value:true});
                }
        }
    },
    mounted(){
        this.form.copyrights = this.isUndefined(this.settings.copyrights);
        this.form.footer_about = this.isUndefined(this.settings.footer_about);
        this.form.address = this.isUndefined(this.settings.address);
        this.form.show_address = this.isUndefined(this.settings.show_address, false)  == true;
        this.form.show_quick_links = this.isUndefined(this.settings.show_quick_links, false)  == true;
        this.form.show_about = this.isUndefined(this.settings.show_about, false)  == true;
        this.form.show_social_networks = this.isUndefined(this.settings.show_social_networks, false)  == true;
        this.$emit('updated', this.form);
    },
    methods:{
        setImage(event){
            this.form.footer_logo = event.target.files[0];
            this.$emit('updated', this.form);
        }
    }

}
</script>