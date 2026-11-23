<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const title = computed(() => ({
    'Admin/Dashboard': 'Overview',
    'Admin/Articles/Index': 'Articles',
    'Admin/Articles/Form': page.props.article ? 'Edit article' : 'New article',
    'Admin/Newsletter/Index': 'Newsletter subscribers',
    'Admin/Leads/Quotes': 'Quote requests',
    'Admin/Leads/Designs': 'Design requests',
}[page.component] ?? 'Admin'));
const navItems = [
    { label: 'Overview', href: '/admin' },
    { label: 'Articles', href: '/admin/articles' },
    { label: 'Newsletter', href: '/admin/newsletter' },
    { label: 'Quote requests', href: '/admin/quote-requests' },
    { label: 'Design requests', href: '/admin/design-requests' },
];
</script>

<template>
    <Head :title="`${title} · Admin`" />
    <div class="min-h-screen bg-slate-50 text-slate-900">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <Link href="/admin" class="text-lg font-semibold tracking-tight">AR Kitchen <span class="text-slate-400">/ Admin</span></Link>
                <div class="flex items-center gap-4 text-sm">
                    <span class="hidden text-slate-500 sm:inline">{{ page.props.auth.user?.name }}</span>
                    <button class="rounded-lg border border-slate-200 px-3 py-2 font-medium hover:bg-slate-50" @click="router.post('/admin/logout')">Sign out</button>
                </div>
            </div>
        </header>
        <div class="mx-auto grid max-w-7xl gap-8 px-6 py-8 lg:grid-cols-[220px_1fr]">
            <aside>
                <nav class="flex gap-2 overflow-x-auto lg:flex-col">
                    <Link v-for="item in navItems" :key="item.href" :href="item.href" class="whitespace-nowrap rounded-lg px-4 py-3 text-sm font-medium" :class="$page.url === item.href || (item.href !== '/admin' && $page.url.startsWith(item.href)) ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-white'">{{ item.label }}</Link>
                </nav>
            </aside>
            <main class="min-w-0">
                <div v-if="page.props.flash?.success" class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ page.props.flash.success }}</div>
                <div class="mb-6">
                    <p class="text-xs font-semibold tracking-[0.18em] text-slate-400 uppercase">Administration</p>
                    <h1 class="mt-2 text-2xl font-semibold tracking-tight">{{ title }}</h1>
                </div>
                <slot />
            </main>
        </div>
    </div>
</template>
