<template>
    <a href="#" class="ml-3" data-toggle="modal" data-target="#changeAgent">
        <i class="far fa-edit"></i>
    </a>

    <div class="modal fade" data-backdrop="static" data-keyboard="false"  id="changeAgent" tabindex="-1" role="dialog" aria-labelledby="changeAgentLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg text-dark" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agents</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="agents">Agents</label>
                        <Select2 :settings="{...settings, multiple:true}" v-model="form.agents" :class="{'is-invalid':errors.agents}" class="grid" :options="_agents"/>

                        <InputError :message="errors.agents"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="resetAgents" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="assignAgents" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        agents:Array,
        errors:Object,
        ticket:Object,
    },
    data(){
        return {
            form:{
                agents: [],
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    computed:{
        _agents:function(){
            return this.agents.map(agent=>({id:agent.id, text:agent.name}))
        },
    },
    mounted(){
        this.form.agents = this.ticket.agents.map((agent)=>(agent.id))
    },
    methods:{
        resetAgents(){
            this.form.agents = this._agents;
        },
        assignAgents(){
            this.$emit("updateAgents", this.form.agents)
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