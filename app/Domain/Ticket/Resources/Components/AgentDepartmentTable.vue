<template>
    <table class="table table-hovered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="agent in agents" :key="agent.id">
                <td>{{ agent.id }}</td>
                <td>{{ agent.name }}</td>
                <td>{{ agent.email }}</td>
                <td>
                    <span v-if="agent.status == 'active'" class="badge badge-success">Active</span>
                    <span v-else class="badge badge-danger">Inactive</span>
                </td>
                <td>{{ moment(agent.created_at) }}</td>
                <td>{{ moment(agent.updated_at) }}</td>
                <td>
                    <AgentDatatableActions @deassignAgent="deassignAgent" :entity="agent" show_url="users.show" delete_url="departments.deassign_agents"/>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import AgentDatatableActions from '@/Components/AgentDatatableActions.vue'

export default {
    props:{
        agents:Array
    },
    components:{
        AgentDatatableActions
    },
    methods:{
        deassignAgent(agent){
            this.$emit('deassignAgent', agent)
        }
    }
}
</script>