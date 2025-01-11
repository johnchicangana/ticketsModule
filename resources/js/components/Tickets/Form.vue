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
        if(router.currentRoute.value.params.name === 'tickets.update'){
            editMode.value = true
            // getTickets()
            let response = await axios.get(`/api/tickets/update/${router.currentRoute.value.params.id}`)
            .then(response => {
                form.type = response.data.data.data.type
            })
            .catch((error) => {
                console.log('no carga')
                if(error.response.status === 422){
                    errors = error.response.data.error
                }
            })
        }
    })

    const form = reactive({
        type: '',
        status: '',
        priority: '',
        message: ''
    })

    const handleSave = () => {
        axios.post('/api/tickets', form)
            .then(response => {
                toast.fire({
                    icon: 'success',
                    title: 'Ticket created successfully'
                });
                router.push({ path: '/tickets' });
            })
            .catch((error) => {
                if(error.response.status === 422){
                    errors = error.response.data.error
                }
            })
    }

    const getTickets = async () => {
        console.log('entra al get');
        let response = await axios.get(`/api/tickets/update/${router.currentRoute.value.params.id}`)
        .then(response => {
            form.type = response.data.data.data.type
        })
        .catch((error) => {
            console.log('no carga')
            if(error.response.status === 422){
                errors = error.response.data.error
            }
        })

    }

</script>