<template>
    <div class="container mx-auto">
        <form action="" class="flex flex-col">
            <select name="type" id="type" class="border border-gray-300 p-2" v-model="form.type">
                <option value=""></option>
                <option value="front">Front</option>
                <option value="back">Back</option>
            </select>
            <select name="status" id="status" class="border border-gray-300 p-2" v-model="form.status">
                <option value=""></option>
                <option value="Creado">Creado</option>
                <option value="Asignado">Asignado</option>
                <option value="Progreso">En Progreso</option>
                <option value="Finalizado">Finalizado</option>
            </select>
            <select name="priority" id="priority" class="border border-gray-300 p-2" v-model="form.priority">
                <option value=""></option>
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
            </select>
            <input type="text" name="message" id="message" class="border border-gray-300 p-2" v-model="form.message">
            <select name="user_id" id="user_id" class="border border-gray-300 p-2" v-model="form.user_id">
                <option value=""></option>
                <option value="1">John</option>
                <option value="2">Joe</option>
                <option value="3">Jane</option>
            </select>
            <button class="bg-blue-500 text-white p-2" @click="handleSave">{{ typeButon }}</button>
        </form>
    </div>
</template>
<script setup>
    import axios from "axios"
    import { onMounted, reactive, ref } from "vue"
    import { useRouter } from 'vue-router';

    const props = defineProps(['typeButon']);
    const router = useRouter();
    let errors = ref([])

    const editMode = ref([])

    onMounted(async() => {
        if(router.currentRoute._value.name === 'tickets.update'){
            editMode.value = true
            getTickets()
        }
    })

    const form = reactive({
        type: '',
        status: '',
        priority: '',
        message: ''
    })

    const handleSave = (values, actions) => {
        if(editMode.value){
            updateTicket(values, actions)
        }
        else {
            createTicket(values, actions)
        }
    }

    const getTickets = async () => {
        let response = await axios.get(`/api/tickets/${router.currentRoute._value.params.id}`)
        .then(response => {
            console.log(response.data.data)
            form.type = response.data.data.type
            form.status = response.data.data.status
            form.priority = response.data.data.priority
        })
        .catch((error) => {
            console.log(error)
            if(error.response.status === 422){
                errors = error.response.data.error
            }
        })
    }

    const createTicket = (values, actions) => {
        axios.post('/api/tickets', form)
            .then(response => {
                router.push({ path: '/tickets' });
                toast.fire({
                    icon: 'success',
                    title: 'Ticket created successfully'
                });
            })
            .catch((error) => {
                if(error.response.status === 422){
                    errors = error.response.data.error
                }
            })
    }

    const updateTicket = (values, actions) => {
        axios.put(`/api/tickets/${router.currentRoute._value.params.id}`, form)
        .then(response => {
            toast.fire({
                icon: 'success',
                title: 'Ticket updated successfully'
            });
            router.push('/tickets');
        })
        .catch((error) => {
            if(error.response.status === 422){
                errors = error.response.data.error
            }
        })
    }

</script>