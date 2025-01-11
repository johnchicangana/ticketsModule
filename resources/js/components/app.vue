<template>
    <!-- <h1 class="mx-auto text-3xl text-center">Este es un componente para validar el proceso de tickets</h1> -->
    <nav class="flex justify-center bg-cyan-600 p-8 text-white">
        <router-link class="px-4 hover:bg-cyan-900 text-xl active:bg-cyan-950" to="/">Home</router-link>
        <router-link class="px-4 hover:bg-cyan-900 text-xl" to="/tickets">Tickets</router-link>
    </nav>
    <main class="container mx-auto">
        <router-view></router-view>
    </main>
</template>