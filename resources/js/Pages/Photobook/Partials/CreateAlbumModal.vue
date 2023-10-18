<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-10" @close="open = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Create album</DialogTitle>
                                <div class="container mx-auto p-6">
                                    <form @submit="submitForm">
                                        <div class="mb-4">
                                            <label for="title" class="block text-gray-600">Title</label>
                                            <input
                                                v-model="formData.title"
                                                type="text"
                                                id="title"
                                                name="title"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md"

                                                maxlength="50"
                                            />
                                        </div>

                                        <div class="mb-4">
                                            <label for="description" class="block text-gray-600">Description</label>
                                            <textarea
                                                v-model="formData.description"
                                                id="description"
                                                name="description"
                                                rows="3"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                                maxlength="255"
                                            ></textarea>
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-gray-600">Layout (Photos per page)</label>
                                            <div class="space-x-4">
                                                <label class="inline-flex items-center">
                                                    <input
                                                        v-model="formData.layout"
                                                        type="radio"
                                                        value="1"
                                                        name="layout"
                                                        class="form-radio text-indigo-600"
                                                    />
                                                    <span class="ml-2">1</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input
                                                        v-model="formData.layout"
                                                        type="radio"
                                                        value="2"
                                                        name="layout"
                                                        class="form-radio text-indigo-600"
                                                    />
                                                    <span class="ml-2">2</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input
                                                        v-model="formData.layout"
                                                        type="radio"
                                                        value="4"
                                                        name="layout"
                                                        class="form-radio text-indigo-600"
                                                    />
                                                    <span class="ml-2">4</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div>
                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
<!--                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">-->
<!--                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto" @click="open = false">-->
<!--                                    Create-->
<!--                                </button>-->
<!--                                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="open = false" ref="cancelButtonRef">Cancel</button>-->
<!--                            </div>-->
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { useForm } from '@inertiajs/vue3';
import {ref} from "vue";

const open = ref(true);

const formData = useForm({
    title: '',
    description: '',
    layout: '',
});

const submitForm = async () => {
    const response = await formData.post('/photobooks');
    console.log('Finalizou!', response);
};
</script>
