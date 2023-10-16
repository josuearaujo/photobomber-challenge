<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Create and list your <span class="text-accent">photobomber</span> albums here!
                    </div>

                    <div class="p-5">
                        <form @submit.prevent="submit" class="flex flex-col w-.5">
                            <input type="file" @input="form.photo = $event.target.files[0]" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/vue3';

import { useForm } from '@inertiajs/vue3'

const form = useForm({
  photo: null,
})

function submit() {
  form.post('/photos')
}
</script>
