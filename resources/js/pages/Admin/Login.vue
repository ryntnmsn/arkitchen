<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ email: '', password: '', remember: false });
</script>

<template>
    <Head title="Admin login" />
    <main class="flex min-h-screen items-center justify-center bg-slate-950 px-5 py-12">
        <section class="w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl shadow-black/20 sm:p-10">
            <p class="text-xs font-semibold tracking-[0.2em] text-slate-400 uppercase">AR Kitchen</p>
            <h1 class="mt-3 text-3xl font-semibold tracking-tight text-slate-900">Admin sign in</h1>
            <p class="mt-2 text-sm text-slate-500">Sign in to manage articles and newsletter subscribers.</p>
            <form class="mt-8 space-y-5" @submit.prevent="form.post('/admin/login')">
                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                    <input id="email" v-model="form.email" type="email" autocomplete="username" required class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                    <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                </div>
                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
                    <input id="password" v-model="form.password" type="password" autocomplete="current-password" required class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                    <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}</p>
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600"><input v-model="form.remember" type="checkbox" class="rounded border-slate-300"> Remember me</label>
                <button :disabled="form.processing" class="w-full rounded-xl bg-slate-900 px-4 py-3 font-medium text-white hover:bg-slate-700 disabled:opacity-60">{{ form.processing ? 'Signing in…' : 'Sign in' }}</button>
            </form>
        </section>
    </main>
</template>
