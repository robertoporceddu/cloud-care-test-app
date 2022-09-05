<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head } from '@inertiajs/inertia-vue3';

    defineProps({
        token: String,
    })
    </script>

    <template>
        <Head title="Get API Token" />

        <BreezeAuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Get API Token
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 text-center">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                API Token
                            </h2>
                            <div class="mt-2">{{ token }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </BreezeAuthenticatedLayout>
    </template>
