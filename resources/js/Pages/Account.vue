<template>
    <Head title="Hesap"/>

    <h3 class="mb-4"><span class="fw-normal">Esenlikler,</span> {{ auth.user.name }}<span class="fw-normal">.</span></h3>

    <div class="row">
        <div class="mb-4 col-6">
            <div class="card shadow-sm py-2">
                <div class="card-body">
                    <div class="text-dark fw-normal fs-4 mb-1">Bakiyeniz;</div>
                    <div class="mb-0 fw-bold fs-3" v-bind:class="{ 'text-danger': balance < 0 }">{{ balance.toFixed(2) }}₺</div>
                </div>
            </div>
        </div>

        <div class="mb-4 col-6">
            <div class="card shadow-sm py-2">
                <div class="card-body">
                    <div class="text-dark fw-normal fs-4 mb-1">Toplam İşlem;</div>
                    <div class="mb-0 fw-bold fs-3">{{ transactions.length }}</div>
                </div>
            </div>
        </div>
    </div>

    <h3>İşlemler</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">                  
                    <div class="input-group">
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="0" v-model="form.amount">
                            <button class="btn btn-dark" type="button" @click="withdraw()">Çek</button>
                            <button class="btn btn-dark" type="button" @click="deposit()">Yatır</button>
                        </div>
                    </div>

                    <div class="text-danger" v-if="form.errors.amount">{{ form.errors.amount }}</div>
                </div>
            </div>

            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>Tarih</th>
                                <th>İşlem</th>
                                <th>Miktar</th>
                                <th>İşlem Ücreti</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(transaction, index) in transactions" v-bind:key="index">
                                <td>{{ new Date(transaction.created_at).toLocaleDateString() }}</td>
                                <td>{{ transaction.type === 'deposit' ? 'Para Yatırma' : 'Para Çekme' }}</td>
                                <td v-bind:class="transaction.amount > 0 ? 'text-success' : 'text-danger'">{{ transaction.amount.toFixed(2) }}₺</td>
                                <td class="text-secondary">{{ (transaction.fee.toFixed(2) === 0) ? '-' : transaction.fee.toFixed(2) + '₺' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/Main.vue'

export default
{
    layout: MainLayout,

    props: {
        auth: Object,
        balance: Number,
        transactions: Array,
    },

    components: {
        Head,
    },

    data()
    {
        return {
            form: useForm({
                amount: '',
            }),
        };
    },

    methods:
    {
        withdraw()
        {
            if(confirm(`${this.form.amount}₺ çekmek istediğinize emin misiniz?`))
            {
                this.form.post('/account/withdraw',
                {
                    onSuccess: () => {
                        alert(`Hesabınızdan ${this.form.amount}₺ çekildi.`);
                        this.form.reset();
                    },
                });
            }
        },

        deposit()
        {
            if(confirm(`${this.form.amount}₺ yatırmak istediğinize emin misiniz?`))
            {
                this.form.post('/account/deposit',
                {
                    onSuccess: () => {
                        alert(`Hesabınıza ${this.form.amount}₺ yatırıldı.`);
                        this.form.reset();
                    },
                });
            }
        },
    },
}
</script>
