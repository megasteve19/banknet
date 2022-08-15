
<template>
    <Head title="Giriş Yap"/>

    <div class="row justify-content-center mt-5">
        <div class="col-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="mb-3">Giriş Yap</h1>

                    <form class="user has-validation" @submit.prevent="submit">
                        <div class="mb-3">
                            <label class="form-label">E-posta Adresiniz</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="isim@ornek.com"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Parolanız</label>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="Parola"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" v-model="form.remember">
                            <label class="form-check-label">Beni hatırla</label>
                        </div>

                        <input type="submit" class="btn btn-dark btn-user btn-block" value="Giriş yap">

                        <div
                            v-bind:class="{ 'd-block': form.errors.email }"
                            class="invalid-feedback"
                        >
                            <span v-text="form.errors.email"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/Main.vue'

export default
{
    layout: MainLayout,

    components: {
        Head,
        Link,
    },

    data()
    {
        return {
            form: useForm({
                email: '',
                password: '',
                remember: false
            }),
        };
    },

    methods:
    {
        submit()
        {
            this.form.post(route('login'),
            {
                onFinish: () => this.form.reset('password'),
            });
        },
    },
}
</script>