<template>
    <Head title="Hoşgeldin"/>

    <h1 class="mb-3">BankNet'e Hoşgeldiniz!</h1>
    <p>
        BankNet'e hoşgeldiniz. BankNet sayesinde hemen hesabınızı oluşturup para yatırabilir veya çekebilirsiniz.
    </p>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/Main.vue'

export default
{
    layout: MainLayout,

    props: {
        canLogin: {
            type: Boolean,
            default: false,
        },

        canRegister: {
            type: Boolean,
            default: false,
        },
    },

    components: {
        Head,
    },

    methods:
    {
        isActive(route)
        {
            return this.$page.url.startsWith(route);
        },
    },
}
</script>
