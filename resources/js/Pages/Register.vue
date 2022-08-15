<template>
    <Head title="Kayıt Ol"/>

    <div class="row justify-content-center mt-5">
        <div class="col-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="mb-3">Kayıt Ol</h1>

                    <form class="user has-validation" @submit.prevent="submit">
                        <div class="mb-3">
                            <label class="form-label">Adınız</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="John Doe"
                                v-model="form.name"
                                autofocus
                                required
                            />
                        </div>

                        <div
                            v-bind:class="{ 'd-block': form.errors.name }"
                            class="invalid-feedback mb-3"
                        >
                            <span v-text="form.errors.name"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-posta Adresiniz</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="isim@ornek.com"
                                v-model="form.email"
                                required
                            />
                        </div>

                        <div
                            v-bind:class="{ 'd-block': form.errors.email }"
                            class="invalid-feedback mb-3"
                        >
                            <span v-text="form.errors.email"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Parolanız</label>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="Parola"
                                v-model="form.password"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Parola Tekrardan</label>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="Parola Tekrardan"
                                v-model="form.password_confirmation"
                                required
                            />
                        </div>

                        <div
                            v-bind:class="{ 'd-block': form.errors.password }"
                            class="invalid-feedback mb-3"
                        >
                            <span v-text="form.errors.password"></span>
                        </div>

                        <input type="submit" class="btn btn-dark btn-user btn-block" value="Giriş yap">
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
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }),
        };
    },

    methods:
    {
        submit()
        {
            this.form.post(route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        },
    },
};
</script>
