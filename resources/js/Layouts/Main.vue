<template>
    <div class="container pt-4">
        <div class="row">

            <nav class="navbar navbar-expand-lg mb-3">
                <div class="container-fluid">
                    <Link href="/" class="navbar-brand m-0">
                        <h3 class="m-0 bg-dark text-white">BankNet</h3>
                    </Link>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <Link
                                v-bind:class="{ active: isActiveExact('/') }"
                                href="/"
                                class="nav-link"
                            >
                                <span>Anasayfa</span>
                            </Link>
                        </li>

                        <template
                            v-if="!auth.user"
                        >
                            <li class="nav-item">
                                <Link
                                    v-bind:class="{ active: isActiveExact('/login') }"
                                    href="/login"
                                    class="nav-link"
                                >
                                    <span>Giriş Yap</span>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link
                                    v-bind:class="{ active: isActiveExact('/register') }"
                                    href="/register"
                                    class="nav-link"
                                >
                                    <span>Kayıt Ol</span>
                                </Link>
                            </li>    
                        </template>

                        <template
                            v-if="auth.user"
                        >
                            <li class="nav-item">
                                <Link
                                    v-bind:class="{ active: isActiveExact('/account') }"
                                    href="/account"
                                    class="nav-link"
                                >
                                    <span>Hesap</span>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link
                                    v-bind:class="{ active: isActiveExact('/logout') }"
                                    href="/logout"
                                    class="nav-link"
                                    method="POST"
                                >
                                    <span>Çıkış</span>
                                </Link>
                            </li>
                        </template>
                    </ul>
                </div>
            </nav>

            <hr>

            <div class="container-fluid">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default
{
    props: {
        auth: {
            type: Object,
        },
    },

    components: {
        Link,
    },

    methods:
    {
        isActive(route)
        {
            return this.$page.url.includes(route);
        },

        isActiveExact(route)
        {
            return this.$page.url === route;
        },
    },
}
</script>
