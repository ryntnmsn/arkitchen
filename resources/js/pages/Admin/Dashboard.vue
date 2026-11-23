<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{ articleCount: number; publishedArticleCount: number; subscriberCount: number; quoteRequestCount: number; designRequestCount: number }>();
</script>

<template>
    <Head title="Overview · Admin" />
    <div class="grid gap-4 sm:grid-cols-3">
        <Link href="/admin/articles" class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-slate-400">
            <p class="text-sm text-slate-500">All articles</p><p class="mt-3 text-3xl font-semibold">{{ articleCount }}</p>
        </Link>
        <Link href="/admin/articles" class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-slate-400">
            <p class="text-sm text-slate-500">Published</p><p class="mt-3 text-3xl font-semibold">{{ publishedArticleCount }}</p>
        </Link>
        <Link href="/admin/newsletter" class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-slate-400">
            <p class="text-sm text-slate-500">Newsletter subscribers</p><p class="mt-3 text-3xl font-semibold">{{ subscriberCount }}</p>
        </Link>
        <Link href="/admin/quote-requests" class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-slate-400">
            <p class="text-sm text-slate-500">Quote requests</p><p class="mt-3 text-3xl font-semibold">{{ quoteRequestCount }}</p>
        </Link>
        <Link href="/admin/design-requests" class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-slate-400">
            <p class="text-sm text-slate-500">Design briefs</p><p class="mt-3 text-3xl font-semibold">{{ designRequestCount }}</p>
        </Link>
    </div>
    <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-6">
        <h2 class="font-semibold">Quick actions</h2>
        <div class="mt-4 flex flex-wrap gap-3">
            <Link href="/admin/articles/create" class="rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-slate-700">Write an article</Link>
            <Link href="/admin/newsletter" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-medium hover:bg-slate-50">View subscribers</Link>
        </div>
    </section>
</template>
