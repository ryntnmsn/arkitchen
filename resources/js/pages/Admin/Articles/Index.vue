<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

type Article = { id: number; title: string; slug: string; updated_at: string; published_at: string | null };
defineProps<{ articles: { data: Article[]; links: { url: string | null; label: string; active: boolean }[] } }>();

function removeArticle(article: Article) {
    if (window.confirm(`Delete “${article.title}”?`)) router.delete(`/admin/articles/${article.id}`);
}
</script>

<template>
    <Head title="Articles · Admin" />
    <div class="mb-4 flex justify-end"><Link href="/admin/articles/create" class="rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-slate-700">New article</Link></div>
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
        <div v-if="articles.data.length" class="divide-y divide-slate-100">
            <div v-for="article in articles.data" :key="article.id" class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0"><p class="truncate font-medium">{{ article.title }}</p><p class="mt-1 text-sm text-slate-500">/{{ article.slug }} · {{ article.published_at ? 'Published' : 'Draft' }}</p></div>
                <div class="flex shrink-0 gap-2"><Link :href="`/admin/articles/${article.id}/edit`" class="rounded-lg border border-slate-200 px-3 py-2 text-sm hover:bg-slate-50">Edit</Link><button class="rounded-lg border border-red-200 px-3 py-2 text-sm text-red-700 hover:bg-red-50" @click="removeArticle(article)">Delete</button></div>
            </div>
        </div>
        <p v-else class="px-6 py-12 text-center text-sm text-slate-500">No articles yet. Create your first article to get started.</p>
        <div v-if="articles.links.length > 3" class="flex flex-wrap gap-2 border-t border-slate-100 px-5 py-4">
            <Link v-for="(link, index) in articles.links" :key="index" :href="link.url || '#'" :class="['rounded-lg px-3 py-2 text-sm', link.active ? 'bg-slate-900 text-white' : 'border border-slate-200 text-slate-600', !link.url && 'pointer-events-none opacity-40']" v-html="link.label" />
        </div>
    </div>
</template>
